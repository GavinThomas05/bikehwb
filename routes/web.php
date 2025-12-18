<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

// Basic route to welcome page
Route::get('/', function () {
    return view('home');
});

// Route to display all posts on the homepage
Route::get('/', [PostController::class, 'index'])->name('home');

// Routes registration form + Handle registration form submission
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Routes login form + Handle login form submission + Handle logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes for creating and storing posts (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

// Routes for editing, updating, and deleting posts (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Route to add comments to a post (protected by auth middleware)
Route::middleware('auth')->post(
    '/posts/{post}/comments', [PostController::class, 'addComment'])->name('posts.addComment');
// Route to delete comments from a post (protected by auth middleware)
Route::middleware('auth')->delete(
    '/comments/{comment}', [PostController::class, 'destroyComment'])->name('comments.destroyComment');