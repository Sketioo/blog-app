<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

Auth::routes();

Route::resource('posts', PostController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy',
]);

//* Comment Related Route
Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comment');
Route::put('/posts/{post}/comments/{comment}', [PostController::class, 'updateComment'])
    ->name('posts.comment.update')->middleware('auth', 'can:update,comment');
Route::delete('/posts/{post}/commets/{comment}', [PostController::class, 'deleteComment'])
    ->name('posts.comment.destroy')->middleware('auth', 'can:delete,comment');

Route::get('/user/posts', [PostController::class, 'userPosts'])->name('user.posts')->middleware('auth');

Route::get('/search', [PostController::class, 'search'])->name('posts.search')->middleware('auth');

Route::post('/contact', [HomeController::class, 'sendEmail'])->name('contact.email');
