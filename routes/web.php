<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('home');
});

// Route 1: returns a welcome message
Route::get('/post', function () {
    return view('addpost');
});

// Route 2: returns a different message
Route::get('/goodbye', function () {
    return 'Goodbye, world!';
});

// Route 3: redirects to welcome  message
Route::get('/redirect', function () {
    return redirect('/hello');
});

//accepts a string and outputs in browser
Route::get('/show/{text}', function ($text) {
    return "You entered: " . $text;
    });

Route::get('/', [PostController::class, 'index'])->name('home');