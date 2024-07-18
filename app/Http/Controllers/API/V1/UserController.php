<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserInfo(Request $request): JsonResponse
    {
        try {
            // Retrieve the authenticated user
            $user = $request->user();

            // Return user information
            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }

    public function updateUserInfo(Request $request): JsonResponse
    {
        try {
            // Retrieve the authenticated user
            $user = $request->user();

            // Validate the request data
            $request->validate([
                'name' => 'string|nullable',
                'email' => 'email|nullable|unique:users,email,' . $user->id,

            ]);

            // Update user information
            $user->update([
                'name' => $request->input('name', $user->name),
                'email' => $request->input('email', $user->email),

            ]);

            // Return updated user information
            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }


}
