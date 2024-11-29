<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EndpointDestroyController;
use App\Http\Controllers\EndpointStoreController;
use App\Http\Controllers\EndpointUpdateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteStoreController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/{site?}', DashboardController::class)->name('dashboard');
    Route::post('/sites', SiteStoreController::class);
    Route::post('/sites/{site}/endpoints', EndpointStoreController::class);
    Route::patch('/endpoints/{endpoint}', EndpointUpdateController::class);
    Route::delete('/endpoints/{endpoint}', EndpointDestroyController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
