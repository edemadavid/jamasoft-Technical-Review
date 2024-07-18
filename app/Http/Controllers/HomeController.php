<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Website;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        $categories = Category::all();

        return view('welcome', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search websites by name or category
        $websites = Website::where('title', 'LIKE', "%$query%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->paginate(1);


        return view('website.search-result', compact('websites', 'query'));
    }

    public function show(Website $website)
    {
        return view('website.single-search', compact('website'));
    }
}
