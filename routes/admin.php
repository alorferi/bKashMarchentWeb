<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;

Route::group(['prefix' => 'admin',  'middleware' => ['auth'], 'as'=>"admin."], function () {

    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth'])->name('dashboard');

    Route::resource('posts', PostController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('images', ImageController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);


    Route::resource('videos', VideoController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('tags', TagController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);


    Route::resource('comments', CommentController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('users', UserController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('terms', TermController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('options', OptionController::class)
    ->except([
      //  'index', 'show'
    ])
    ->middleware(['auth']);


    Route::resource('roles', RoleController::class)
    ->except([
      //  'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('permissions', PermissionController::class)
    ->except([
      //  'index', 'show'
    ])
    ->middleware(['auth']);
});
