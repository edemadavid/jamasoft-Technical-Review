<?php


use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\VoteController;
use App\Http\Controllers\API\V1\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {

    Route::controller(AuthController::class)
        ->prefix('auth')->name('auth.')
        ->group(function () {
            Route::post('signup', 'signup');
            Route::post('verify-otp', 'verifyOTP');
            Route::post('resend-otp', 'resendOTP');
            Route::post('reset-password', 'resetPassword');
            Route::post('login', 'login');
        });
});

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {

    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::controller(UserController::class)
        ->prefix('user')->name('user.')
        ->group(function () {
            Route::get('info', 'getUserInfo');
            Route::post('update', 'updateUserInfo');
            Route::resource('websites', WebsiteController::class);

            Route::post('/website/{website}/vote', [VoteController::class, 'vote']);
    });




});
