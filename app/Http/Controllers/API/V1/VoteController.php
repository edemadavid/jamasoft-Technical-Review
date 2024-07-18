<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function vote(Request $request, Website $website)
    {
        $user = Auth::user();

        // Check if the user has already voted for this website
        if ($user->votes()->where('website_id', $website->id)->exists()) {
            return response()->json(['message' => 'You have already voted for this website.'], 403);
        }

        // Create a new vote
        Vote::create([
            'user_id' => $user->id,
            'website_id' => $website->id,
        ]);

        return response()->json(['message' => 'Vote added successfully.'], 201);
    }
}
