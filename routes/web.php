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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Profile Editing
Route::get('/profiles/edit/{user:username}', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profiles.edit');
Route::patch('/profiles/update/{user:username}', 'App\Http\Controllers\ProfilesController@update')->name('profiles.update');

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

