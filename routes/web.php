<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCrudController;
use App\Http\Controllers\GeminiController;
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
Route::post('/payment/snap', [PaymentController::class, 'createCharge'])->middleware(['auth', 'verified'])->name('payment.snap');
Route::get('/payment/success', [PaymentController::class, 'success'])->middleware(['auth', 'verified'])->name('payment.success');
Route::post('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
Route::post('payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');

Route::get('/events', [EventController::class, 'events'])->name('events');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.show');
Route::get('/all-events', [EventController::class, 'search'])->name('search');
Route::post('/event/{slug}/register', [EventController::class, 'register'])->name('event.register');
Route::get('/category/{slug}', [EventController::class, 'showByCategory'])->name('category.show');
Route::get('/city-category/{slug}', [EventController::class, 'showByCityCategory'])->name('city-category.show');
Route::get('/ticket/{eventSlug}/{code}', [EventController::class, 'ticket'])->middleware('auth')->name('ticket');
Route::get('/event/{slug}/cancel-registration', [EventController::class, 'cancelRegistration'])->name('event.cancel-registration');

Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
});

Route::get('/dashboard', [EventCrudController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/history-payment', [EventCrudController::class, 'historyPayment'])->middleware(['auth', 'verified'])->name('history-payment');
Route::get('/event-create', [EventCrudController::class, 'eventCreate'])->middleware(['auth', 'verified'])->name('event-create');
Route::get('/create-event', [EventCrudController::class, 'createEvent'])->middleware(['auth', 'verified'])->name('create-event');
Route::get('/my-event', [EventCrudController::class, 'myEvent'])->middleware(['auth', 'verified'])->name('my-event');
Route::get('/event-finished', [EventCrudController::class, 'eventFinished'])->middleware(['auth', 'verified'])->name('event-finished');
Route::get('/detail-event/{slug}', [EventCrudController::class, 'detailEvent'])->middleware(['auth', 'verified'])->name('detail-event');
Route::post('/create-event', [EventCrudController::class, 'store'])->middleware(['auth', 'verified'])->name('events.store');
Route::get('/event/{slug}/edit', [EventCrudController::class, 'edit'])->middleware(['auth', 'verified'])->name('event.edit');
Route::put('/event/{slug}', [EventCrudController::class, 'update'])->middleware(['auth', 'verified'])->name('event.update');
Route::delete('/event/{slug}', [EventCrudController::class, 'destroy'])->middleware(['auth', 'verified'])->name('event.destroy');
Route::post('/dashboard/event/{event}/participant/{participant}/approve', [EventCrudController::class, 'approveParticipant'])->name('event.approve-participant')->middleware('auth');
Route::get('/dashboard/event/{event}/participant/{participant}', [EventCrudController::class, 'participantDetail'])->name('event.participant-detail')->middleware('auth');
Route::delete('/dashboard/event/{event}/participant/{participant}', [EventCrudController::class, 'removeParticipant'])->name('event.remove-participant')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
