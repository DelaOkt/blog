<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
// Route::get('users/create', [UserController::class, 'create'])->name('users.create');
// Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
// Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
// Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/category/{slug}', [HomeController::class, 'showPostsByCategory'])->name('category.posts');
Route::get('/kategori/{slug}', [CategoryController::class, 'showPostsByCategory'])->name('category.posts');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
// Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
