<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);

Auth::routes();
// Dalam web.php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/category/{slug}', [HomeController::class, 'showPostsByCategory'])->name('category.posts');
Route::get('/kategori/{slug}', [CategoryController::class, 'showPostsByCategory'])->name('category.posts');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{slug}', [CategoryController::class, 'showPostsByCategory'])->name('category.posts');
Route::get('categories/{slug}/posts', [CategoryController::class, 'showPostsByCategory'])->name('category.posts');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
// web.php

Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
});
Route::get('/categories/check-slug', [CategoryController::class, 'checkSlug'])->name('categories.checkSlug');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // Tambahkan route lainnya
});
