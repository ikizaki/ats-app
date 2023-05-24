<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role_as == '1') {
            return redirect('penjual/dashboard')->with('status', 'Selamat Datang!');
        } else {
            $sliders = Slider::where('status', '0')->get();
            return view('home', compact('sliders'));
        }
    }

    public function allProducts()
    {
        $products = Product::all()->sortByDesc('id');
        return view('pembeli.view', compact('products'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('pembeli.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            return view('pembeli.collections.products.index', compact('category'));
        } else {
            return redirect()->back()->with('message', 'Category page doesnt exist');
        }
    }

    public function productView($category_slug, $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {

            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if($product){
                return view('pembeli.collections.products.view', compact('category', 'product'));
            } else {
                return redirect()->back()->with('message', 'Product page doesnt exist');
            }
            
        } else {
            return redirect()->back()->with('message', 'Category page doesnt exist');
        }
    }
}
