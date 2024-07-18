<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('websites')->find($id);
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        }
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        }

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }



    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
