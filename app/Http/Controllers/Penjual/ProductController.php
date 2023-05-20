<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('users_id', Auth::getUser()->id)->get();
        return view('penjual.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('penjual.products.create', compact('categories'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'users_id' => Auth::getUser()->id,
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        if ($request->hasFile('image')) {
            $path = 'uploads/products/';

            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $imageFile->move($path, $filename);
                $finalImagePathName = $path . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        return redirect('/penjual/products')->with('message', 'Product added successfully');
    }

    public function edit(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        return view('penjual.products.edit', compact('product', 'categories'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])->products()->where('id', $product_id)->first();

        if ($product) {
            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? '1' : '0',
                'status' => $request->status == true ? '1' : '0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            if ($request->hasFile('image')) {
                $path = 'uploads/products/';

                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extension;
                    $imageFile->move($path, $filename);
                    $finalImagePathName = $path . $filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }

            return redirect('penjual/products')->with('message', 'Product updated successfully');
        } else {
            return redirect('penjual/products')->with('message', 'No Such Product Id');
        }
    }

    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);

        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }

        $productImage->delete();
        return redirect()->back()->with('message', 'Image deleted successfully');
    }

    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($product->productImages()) {
            foreach ($product->productImages() as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();

        return redirect()->back()->with('message', 'Product and images deleted successfully');
    }
}
