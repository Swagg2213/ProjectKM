<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EventApprovalController;

Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');

Route::get('/test', function () {
    return view('test');
});


Route::middleware(['require.login'])->group(function () {

    Route::middleware(['require.admin'])->group(function () {
        Route::get('/admin/event-approval', [EventApprovalController::class, 'show'])->name('event.approval');
        Route::put('event/{id}/approve', [EventController::class, 'approve'])->name('event.approve');
        Route::put('event/{id}/reject', [EventController::class, 'reject'])->name('event.reject');
        Route::get('event/{id}/review', [EventApprovalController::class, 'reviewEvent'])->name('event.review.form');
        Route::post('event/{id}/review', [EventApprovalController::class, 'sendReviewEvent'])->name('event.review');
    });

    Route::middleware(['require.mahasiswa'])->group(function () {

    });

    Route::middleware(['require.pembuatEvent'])->group(function () {
        Route::get('/addEvent', function () {
            return view('Event.eventForm');
        })->name('event.add.form');
        Route::post("/addEvent", [EventController::class, 'store'])->name('event.add.post');
        Route::get('/profile/event-history', [ProfileController::class, 'showEventHistory'])->name('profile.eventHistory');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    });

    Route::get('/events', [EventController::class, 'show'])->name('event.show');
    Route::get('/event/{event:id}',[EventController::class,'showDetail'])->name('event.detail');
    Route::get('/event/{event:id}/edit', [EventController::class, 'showEdit'])->name('event.edit.form');
    Route::put('/event/{event:id}/edit', [EventController::class, 'update'])->name('event.update');
    Route::post('/event/{id}/toggle-favorite', [EventController::class, 'toggleFavorite'])->name('event.toggleFavorite');
    Route::get('/favorite', [EventController::class, 'showFavorites'])->name('event.favorite');

    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});


// Redirect for old '/' route, commented out as it's replaced by the redirect to login
// Route::get('/', function () {
//     return redirect()->route('event.show');
// });


// Google Authentication routes
Route::get('/auth/google/redirect/{role}', [AuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

