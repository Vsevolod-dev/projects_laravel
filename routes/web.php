<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::group(['namespace' => 'Post'], function() {
    Route::group(['middleware' => 'auth'], function() {    
        Route::get('/posts/create', CreateController::class)->name('post.create');
        Route::post('/posts', StoreController::class)->name('post.store');
        Route::get('/posts/{post}/edit', EditController::class)->name('post.edit');
        Route::patch('/posts/{post}', UpdateController::class)->name('post.update');
        Route::delete('/posts/{post}', DestroyController::class)->name('post.destroy');
    });
    
    Route::get('/', IndexController::class)->name('post.index');
    Route::get('/posts', IndexController::class)->name('post.index');
    Route::get('/posts/{post}', ShowController::class)->name('post.show');
});

Route::group(['namespace' => 'User', 'middleware' => 'auth'], function() {
    Route::get('/profile/edit', EditController::class)->name('profile.edit');
    Route::get('/profile/{id?}', IndexController::class)->name('profile.index');
    Route::patch('/profile', UpdateController::class)->name('profile.update');
    Route::get('/profile/{id}/projects', ProjectsController::class)->name('profile.user.index');
    // Route::delete('/posts/{post}', DestroyController::class)->name('post.destroy');
});

Route::post('/upload', DropzoneController::class)->name('dropzone.index');

Auth::routes();

