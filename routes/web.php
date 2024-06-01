<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'home1'])->name('hom');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [UserController::class, 'home1'])->name('home');
    Route::post('/upload', [UserController::class, 'upload'])->name('upload');
    Route::get('/posting', [UserController::class, 'showPostForm'])->name('posting.form');

    // Routes for liking and unliking posts
    Route::post('/posts/{post}/like', [UserController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/unlike', [UserController::class, 'unlike'])->name('posts.unlike');
     Route::post('/posts/{post}/bookmark', [UserController::class, 'bookmark'])->name('posts.bookmark');
    Route::post('/posts/{post}/unbookmark', [UserController::class, 'unbookmark'])->name('posts.unbookmark');
    Route::get('/bookmarks', [UserController::class, 'showBookmarks'])->name('user.bookmarks');
     Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
     Route::get('/edit-profile', [UserController::class, 'editProfileForm'])->name('user.edit.profile');
    Route::post('/edit-profile', [UserController::class, 'updateProfile'])->name('user.update.profile');
    Route::post('/confirm-password', [UserController::class, 'confirmPassword'])->name('user.confirm.password');
    Route::post('/user/{user}/follow', [UserController::class, 'follow'])->name('user.follow');
    Route::post('/user/{user}/unfollow', [UserController::class, 'unfollow'])->name('user.unfollow');
    Route::get('/following', [UserController::class, 'followingPosts'])->name('following');
     Route::get('/user/{user}/followers', [UserController::class, 'followers'])->name('user.followers');
    Route::get('/user/{user}/following', [UserController::class, 'following'])->name('user.following');

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.submit');
});

