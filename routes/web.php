<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCrudController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/pricing', function () {
    return view('home.pricing');
});

Route::get('/events', [EventController::class, 'events'])->name('events');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.show');
Route::post('/event/{slug}/register', [EventController::class, 'register'])->name('event.register');
Route::get('/category/{slug}', [EventController::class, 'showByCategory'])->name('category.show');
Route::get('/city-category/{slug}', [EventController::class, 'showByCityCategory'])->name('city-category.show');

Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
});

Route::get('/dashboard', [EventCrudController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/create-event', [EventCrudController::class, 'createEvent'])
    ->middleware(['auth', 'verified'])
    ->name('create-event');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
