<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware('auth')->group(function (){ //Makes sure the user is logged in to view

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Search
Route::get('/search', [App\Http\Controllers\ThreadsController::class, 'search'])->name('threads.search');


//Profile Editing
Route::get('/profiles/edit/{user:username}', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profiles.edit');
Route::patch('/profiles/update/{user:username}', 'App\Http\Controllers\ProfilesController@update')->name('profiles.update');
Route::get('/profiles/myPosts', [App\Http\Controllers\ProfilesController::class, 'myPosts'])->name('profiles.myPosts');


//Add/Delete a Category
Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('categories.index');
Route::post('/categories', [App\Http\Controllers\CategoriesController::class, 'create'])->name('categories.create');
Route::delete('/categories', [App\Http\Controllers\CategoriesController::class, 'delete'])->name('categories.delete');

//Create/Edit/Delete a Thread
Route::get('/threads', [App\Http\Controllers\ThreadsController::class, 'index'])->name('threads.index');
Route::get('/threads/create', [App\Http\Controllers\ThreadsController::class, 'create'])->name('threads.create');
Route::post('/threads/create', [App\Http\Controllers\ThreadsController::class, 'store'])->name('threads.store');
Route::delete('/threads', [App\Http\Controllers\ThreadsController::class, 'delete'])->name('threads.delete');
Route::get('/threads/show/{thread:name}', [App\Http\Controllers\ThreadsController::class, 'show'])->name('threads.show');
Route::get('/threads/edit/{thread:name}', [App\Http\Controllers\ThreadsController::class, 'edit'])->name('threads.edit');
Route::patch('/threads/update/{thread:name}', 'App\Http\Controllers\ThreadsController@update')->name('threads.update');

//Comments
Route::post('/comments/store', [App\Http\Controllers\CommentsController::class, 'store'])->name('comments.store');
Route::get('/comments/edit/{comments:id}', [App\Http\Controllers\CommentsController::class, 'edit'])->name('comments');
Route::patch('/comments/update/{comments:id}', 'App\Http\Controllers\CommentsController@update')->name('comments.update');
Route::delete('/comments', [App\Http\Controllers\CommentsController::class, 'delete'])->name('comments.delete');

});