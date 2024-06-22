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

Route::get('/', function () {
    return view('home.index');
})->name('home.index');

//* contact, posts/{id}

Route::get('/contact', function () {
    return view('home.contact');
})->name('home.contact');

Route::get('/posts/{id}', function ($id) {
    $post = [
        1 => [
            'title' => 'post 1',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aperiam?',
        ],
        2 => [
            'title' => 'post 2',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aperiam?',
        ],
    ];

    abort_if(!isset($post[$id]), 404);

    // dd($post[$id]);
    return view('posts.show', ['post' => $post[$id]]);
})->name('posts.show');
