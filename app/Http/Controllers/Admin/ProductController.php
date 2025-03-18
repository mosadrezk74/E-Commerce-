<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('Admin.Product.product', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('Admin.Product.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProductName' => 'required|string|max:100',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'StockQuantity' => 'required|integer|min:0',
            'SKU' => 'nullable|string|unique:products,SKU|max:50',
            'ImageURL' => 'nullable|url',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'SupplierID' => 'nullable|exists:suppliers,SupplierID',
            'IsActive' => 'nullable|boolean',
            'IsFeatured' => 'nullable|boolean',
            'IsTrending' => 'nullable|boolean',
        ]);

        Product::create([
            'ProductName' => $request->ProductName,
            'Description' => $request->Description,
            'SKU' => $request->SKU,
            'ImageURL' => $request->ImageURL,
            'Price' => $request->Price,
            'CategoryID' => $request->CategoryID,
            'SupplierID' => $request->SupplierID,
            'StockQuantity' => $request->StockQuantity,
            'IsActive' => $request->IsActive ?? 0,
            'IsTrending' => $request->IsTrending ?? 0,
            'IsFeatured' => $request->IsFeatured ?? 0,
        ]);

        return redirect()->route('admin.product.index')
        ->with('success', 'Product added successfully');
    }

    public function filter(Request $request)
    {
        $category = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $query = Product::query();

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($minPrice && $maxPrice) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        $filteredProducts = $query->get();
        return response()->json($filteredProducts);
    }

    public function delete(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        $request->session()->flash('message', 'Product deleted successfully');
        return redirect()->route('admin.product.index');
    }



    public function status(Request $request, $status, $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $status;
        $product->save();

        $request->session()->flash('message', 'Product status updated successfully');
        return redirect()->route('admin.product.index');
    }

    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', empty($cart) ? null : $cart);
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart');
    }

    public function search(Request $request)
    {
        $products = Product::with('category')
            ->where('ProductName', 'like', "%{$request->keyword}%")
            ->orWhere('Description', 'like', "%{$request->keyword}%")
            ->paginate(9);

        $categories = Category::all();
        return view('Website.shop', compact('products', 'categories'));
    }
}
