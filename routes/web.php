<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

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

// Route to display all posts on the homepage
Route::get('/', [PostController::class, 'index'])->name('home');

// Show registration form + Handle registration form submission
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Show login form + Handle login form submission + Handle logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');