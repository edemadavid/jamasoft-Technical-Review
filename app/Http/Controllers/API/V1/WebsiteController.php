<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function index()
    {
        // Get the authenticated user's websites
        $websites = Website::where('user_id', Auth::id())->with('category')->get();


        return response()->json($websites);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|unique:websites',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $website = Website::create([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json($website, 201);
    }

    public function show(Website $website)
    {
        // Ensure the website belongs to the authenticated user
        if ($website->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($website->load('category'));
    }

    public function update(Request $request, Website $website)
    {
        // Ensure the website belongs to the authenticated user
        if ($website->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|unique:websites,url,' . $website->id,
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $website->update($request->all());
        return response()->json($website);
    }

    public function destroy(Website $website)
    {
        // Ensure the website belongs to the authenticated user
        if ($website->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $website->delete();
        return response()->json(null, 204);
    }
}
