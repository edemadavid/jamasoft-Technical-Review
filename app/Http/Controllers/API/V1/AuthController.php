<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    /*
	 * Register new user
	*/

    public function signup(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            // Hash the password and add additional fields
            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['role'] = 'user';
            $validatedData['otp'] = rand(100000, 999999);

            $otp = $validatedData['otp'];


            // Create the user
            $user = User::create($validatedData);

            if ($user) {
                // Try sending the OTP email
                try {
                    Mail::to($request->email)->send(new OTPMail($otp));
                    DB::commit();
                    return response()->json($otp, 201);
                } catch (Exception $e) {
                    // Rollback transaction if email sending fails
                    DB::rollBack();
                    return response()->json($e, 500);
                }
            }

            // If user creation failed
            DB::rollBack();
            return response()->json(['error' => 'User creation failed'], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            DB::rollBack();
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Rollback transaction for any other exceptions
            DB::rollBack();
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }


    /*
	 * Generate sanctum token on successful login
	*/

    public function login(Request $request): JsonResponse
    {
        try {
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Find the user
            $user = User::where(['email' => $request->email, 'role' => 'user'])->first();


            // Check if user exists and password is correct
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            if ($user->email_verified_at != null){
                $check_verified = "verified";
            } else {$check_verified = "unverified";}

            // Return user data and access token
            return response()->json([
                'user' => $user,
                'is_verified' => $check_verified,
                'access_token' => $user->createToken($request->email)->plainTextToken
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e], 500);
        }
    }

    public function verifyOTP(Request $request): JsonResponse
    {
        try {
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
                'otp' => 'required|digits:6',
            ]);

            // Find the user by email
            $user = User::where('email', $request->email)->first();

            // Check if the user exists
            if (!$user) {
                throw new Exception('User not found.');
            }

            // Check if the provided OTP matches the user's OTP
            if ($request->otp != $user->otp) {
                throw new Exception('Invalid OTP.');
            }

            // Update the user's OTP to null (OTP verification successful)
            $user->email_verified_at = now();

            // Clear the OTP
            $user->otp = null;

            // Save the user
            $user->save();

            return response()->json(['message' => 'OTP verified successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function resetPassword(Request $request): JsonResponse
    {
        try {
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
            ]);

            // Find the user by email
            $user = User::where('email', $request->email)->first();

            // Check if the user exists
            if (!$user) {
                throw new Exception('User not found.');
            }

            // Generate a password reset token
            $token = Password::createToken($user);

            // Send the password reset email
            $user->sendPasswordResetNotification($token);

            return response()->json(['message' => 'Password reset email sent successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ResendOTP(Request $request): JsonResponse
    {
        try {
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
            ]);

            // Find the user by email
            $user = User::where('email', $request->email)->first();

            // Check if the user exists
            if (!$user) {
                throw new Exception('User not found.');
            }

            // Generate a new OTP
            $otp = rand(100000, 999999);

            // Update the user's OTP in the database
            $user->otp = $otp;
            $user->save();

            // Send the OTP to the user's email
            Mail::to($request->email)->send(new OTPMail($otp));

            return response()->json(['message' => 'New OTP sent successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /*
	 * Revoke token; only remove token that is used to perform logout (i.e. will not revoke all tokens)
	*/
    public function logout(Request $request)
    {
        try {
            // Revoke the current user's token
            $request->user()->currentAccessToken()->delete();
            //$request->user->tokens()->delete(); // use this to revoke all tokens (logout from all devices)

            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }

}
