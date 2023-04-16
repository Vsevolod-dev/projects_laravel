<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

Route::group(['namespace' => 'Project'], function() {
    Route::group(['middleware' => 'auth'], function() {    
        Route::get('/projects/create', CreateController::class)->name('project.create');
        Route::post('/projects', StoreController::class)->name('project.store');
        Route::get('/projects/{project}/edit', EditController::class)->name('project.edit');
        Route::patch('/projects/{project}', UpdateController::class)->name('project.update');
        Route::delete('/projects/{project}', DestroyController::class)->name('project.destroy');
    });
    
    Route::get('/', IndexController::class)->name('project.index');
    Route::get('/projects', IndexController::class)->name('project.index');
    Route::get('/projects/{project}', ShowController::class)->name('project.show');
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

