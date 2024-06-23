<?php

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

// Route::get('/', function () {
//     return view('home.index');
// })->name('home.index');

// Route::get('/contact', function () {
//     return view('home.contact');
// })->name('home.contact');

$posts = [
    1 => [
        'title' => 'post 1',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aperiam?',
        'is_new' => true,
        'has_comment' => 'This post has a comment',
    ],
    2 => [
        'title' => 'post 2',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aperiam?',
        'is_new' => false,
    ],
];

Route::view('/', 'home.index')->name('home.index');
Route::view('/contact', 'home.contact')->name('home.contact');

Route::get('/posts', function () use ($posts) {
    // dd(request()->all());
    // dd(request()->query('page', '1'));

    return view('posts.index', ['posts' => $posts])
        ->name('posts.index');
});

Route::get('/posts/{id}', function ($id) use ($posts) {

    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
})->name('posts.show');
