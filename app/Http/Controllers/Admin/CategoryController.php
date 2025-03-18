<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Admin.Category.Category', compact('categories'));
    }

    public function create()
    {
        return view('Admin.Category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required|string|max:255',
            'Description' => 'nullable|string',
        ]);

        Category::create([
            'CategoryName' => strip_tags($request->CategoryName),
            'Description' => strip_tags($request->Description),
        ]);

        $request->session()->flash('message', 'Category is successfully added');
        return redirect()->route('admin.category.index');
    }

    public function edit($CategoryID)
    {
        $category = Category::findOrFail($CategoryID);
        return view('Admin.Category.manage_category', compact('category'));
    }

    public function update(Request $request, $CategoryID)
    {
        $request->validate([
            'CategoryName' => 'required|string|max:255',
            'Description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($CategoryID);
        $category->update([
            'CategoryName' => strip_tags($request->CategoryName),
            'Description' => strip_tags($request->Description),
        ]);

        $request->session()->flash('message', 'Category is successfully updated');
        return redirect()->route('admin.category.index');
    }

    public function delete(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $request->session()->flash('message', 'Category is successfully deleted');
        return redirect()->route('admin.category.index');
    }

    public function status(Request $request, $status, $id)
    {
        $category = Category::findOrFail($id);
        $category->status = $status;
        $category->save();

        $request->session()->flash('message', 'Category status is successfully updated');
        return redirect()->route('admin.category.index');
    }
}
