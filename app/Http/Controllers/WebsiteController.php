<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Category;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::all();
        return view('admin.websites.index', compact('websites'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.websites.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $website = Website::create([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        $website->categories()->attach($request->categories);

        return redirect()->route('admin.websites.index')->with('success', 'Website created successfully');
    }

    public function edit($id)
    {
        $website = Website::find($id);
        if (!$website) {
            return redirect()->route('admin.websites.index')->with('error', 'Website not found');
        }
        $categories = Category::all();
        return view('admin.websites.edit', compact('website', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $website = Website::find($id);
        if (!$website) {
            return redirect()->route('admin.websites.index')->with('error', 'Website not found');
        }

        $website->update([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        $website->categories()->sync($request->categories);

        return redirect()->route('admin.websites.index')->with('success', 'Website updated successfully');
    }

    public function destroy($id)
    {
        $website = Website::find($id);
        if (!$website) {
            return redirect()->route('admin.websites.index')->with('error', 'Website not found');
        }

        $website->categories()->detach();
        $website->delete();

        return redirect()->route('admin.websites.index')->with('success', 'Website deleted successfully');
    }
}


