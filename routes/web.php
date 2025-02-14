<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCrudController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/pricing', function () {
    return view('home.pricing');
});

Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->middleware(['auth', 'check.premium'])->name('payment.show');

// routes/web.php
Route::post('/payment/snap', [PaymentController::class, 'createCharge'])->middleware(['auth', 'verified'])->name('payment.snap');
Route::get('/payment/success', [PaymentController::class, 'success'])->middleware(['auth', 'verified'])->name('payment.success');

// Route callback dari Midtrans tidak perlu auth middleware
Route::post('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
Route::post('payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');

Route::get('/events', [EventController::class, 'events'])->name('events');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.show');
Route::get('/all-events', [EventController::class, 'search'])->name('search');
Route::post('/event/{slug}/register', [EventController::class, 'register'])->name('event.register');
Route::get('/category/{slug}', [EventController::class, 'showByCategory'])->name('category.show');
Route::get('/city-category/{slug}', [EventController::class, 'showByCityCategory'])->name('city-category.show');

Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
});

Route::get('/dashboard', [EventCrudController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/create-event', [EventCrudController::class, 'createEvent'])->middleware(['auth', 'verified'])->name('create-event');
Route::get('/my-event', [EventCrudController::class, 'myEvent'])->middleware(['auth', 'verified'])->name('my-event');
Route::get('/detail-event/{slug}', [EventCrudController::class, 'detailEvent'])->middleware(['auth', 'verified'])->name('detail-event');
Route::post('/create-event', [EventCrudController::class, 'store'])->middleware(['auth', 'verified'])->name('events.store');
Route::get('/event/{slug}/edit', [EventCrudController::class, 'edit'])->middleware(['auth', 'verified'])->name('event.edit');
Route::put('/event/{slug}', [EventCrudController::class, 'update'])->middleware(['auth', 'verified'])->name('event.update');
Route::delete('/event/{slug}', [EventCrudController::class, 'destroy'])->middleware(['auth', 'verified'])->name('event.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
