<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(HomeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        Route::get('/websites/{website}', 'show')->name('websites.show');
    });


Auth::routes();

Route::controller(AdminController::class)
    ->prefix('admin')->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('websites', WebsiteController::class);
        Route::get('votes', [VoteController::class, 'index'])->name('votes.index');
        Route::get('votes/{user}', [VoteController::class, 'show'])->name('votes.show');


    });

// Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
