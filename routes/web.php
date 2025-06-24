<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    return view('test');
});
Route::get('/event', function () {
    return view('Event.eventform');
});
    Route::post("/addEvent", [EventController::class, 'store'])->name('event.add');
    Route::get('/',[EventController::class, 'show'])->name('event.show');    
    Route::get('/event/{event:id}',[EventController::class,'showDetail']);
Route::get('/login', function () {
    return view('login.loginForm');
});
    // Route::get('/auth-google-redirect',[Controller::class,'google_redirect'])
    // Route::get('/auth-google-callback',[Controller::class,'google_callback'])

