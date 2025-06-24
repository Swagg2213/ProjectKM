<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;

Route::get('/test', function () {
    return view('test');
});

//Home
Route::get('/events', [EventController::class, 'show'])->name('event.show');

//Create Event
Route::get('/addEvent', function () {
    return view('Event.eventform');
});
Route::post("/addEvent", [EventController::class, 'store'])->name('event.add');

// Detail Event
Route::get('/event/{event:id}',[EventController::class,'showDetail'])->name('event.detail');

// Toggle Favorite
Route::post('/event/{id}/toggle-favorite', [EventController::class, 'toggleFavorite'])->name('event.toggleFavorite');

// Halaman Favorite
Route::get('/favorite', [EventController::class, 'showFavorites'])->name('event.favorite');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');


// Redirect kalau user ke url / maka akan langsung diarahkan ke /events
Route::get('/', function () {
    return redirect()->route('event.show');
});

// Route::get('/', function () {
//     return redirect()->route('auth.login');
// });


// Route::get('/auth-google-redirect',[Controller::class,'google_redirect'])
// Route::get('/auth-google-callback',[Controller::class,'google_callback'])

