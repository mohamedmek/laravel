<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/',[PostController::class, 'index']);

Route::get('/posts',[PostController::class, 'index'])->name('posts.index')->middleware(middleware:'auth');

Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create')->middleware(middleware:'auth');

Route::post('/posts', [PostController::class, 'store'])->middleware(middleware:'auth');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware(middleware:'auth');


Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware(middleware:'auth');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware(middleware:'auth');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware(middleware:'auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
