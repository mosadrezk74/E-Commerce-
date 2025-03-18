<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;


class FrontController extends Controller
{
    public function shop()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();
        return view('Website.shop', compact('products', 'categories'));
    }

    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::where('status', 1)->get();
        $latest_products = Product::with('category')->latest()->limit(9)->get();
        $t_products=Product::where('CategoryID', 5)->get();
        return view('Website.index', compact('products', 'categories', 'latest_products',
        't_products'));
    }

    public function show_product($ProductID)
    {
        $product = Product::with('category')->findOrFail($ProductID);
        $products=Product::all();
        $categories = Category::all();
        return view('Website.detail', compact('product',
        'products',
        'categories'));
    }

    public function category_product($CategoryID)
    {
        $products = Product::where('CategoryID', $CategoryID)->paginate(10);
        $categories = Category::all();
        return view('Website.category', compact('products', 'categories'));
    }

    public function about()
    {
        return view('Website.about-us');
    }

    public function contact()
    {
        return view('Website.contact-us');
    }

    public function checkout()
    {
        return view('Website.checkout');
    }


}
