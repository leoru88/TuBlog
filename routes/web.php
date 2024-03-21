<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

Route::get('/profile/username', [ProfileController::class, 'show'])->name('profile.username');
Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{username}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/posts/{category}', 'App\Http\Controllers\HomeController@postByCategory')->name('posts.category');
Route::get('/post/{postId}', 'App\Http\Controllers\HomeController@post')->name('post');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/admin/categories', 'App\Http\Controllers\Admin\CategoriesController@index')->name('admin.categories.index');
Route::post('/admin/categories.store', 'App\Http\Controllers\Admin\CategoriesController@store')->name('admin.categories.store');
Route::post('/admin/categories/{categoryId}/update', 'App\Http\Controllers\Admin\CategoriesController@update')->name('admin.categories.update');
Route::delete('/admin/categories/{categoryId}/delete', 'App\Http\Controllers\Admin\CategoriesController@delete')->name('admin.categories.delete');

Route::get('/admin/posts', 'App\Http\Controllers\Admin\PostsController@index')->name('admin.posts.index');
Route::post('/admin/posts.store', 'App\Http\Controllers\Admin\PostsController@store')->name('admin.posts.store');
Route::post('/admin/posts/{postId}/update', 'App\Http\Controllers\Admin\PostsController@update')->name('admin.posts.update');
Route::delete('/admin/posts/{postId}/delete', 'App\Http\Controllers\Admin\PostsController@delete')->name('admin.posts.delete');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
