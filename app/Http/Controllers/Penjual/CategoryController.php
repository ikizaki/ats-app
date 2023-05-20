<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('penjual.category.index');
    }

    public function create()
    {
        return view('penjual.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if($request->hasFile('image')){
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/',$filename);
            $category->image = 'uploads/category/'.$filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status == true ? '1' : '0';
        $category->save();

        return redirect('penjual/category')->with('message', 'Category added successfully');
    }

    public function edit(Category $category)
    {
        return view('penjual.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        
        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if($request->hasFile('image')){
            $path = 'uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/',$filename);
            $category->image = 'uploads/category/'.$filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status == true ? '1' : '0';
        $category->update();

        return redirect('penjual/category')->with('message', 'Category updated successfully');
    }

}
