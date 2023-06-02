<?php

use App\Http\Controllers\ActivityIpController;
use App\Http\Controllers\ActivityLogController;
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
use App\Http\Controllers\AuditController;
use App\Http\Controllers\OnBoardController;
use App\Http\Controllers\PaymentAmountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentCycleController;
use App\Http\Controllers\PaymentSectorController;
use App\Http\Controllers\SubscriptionController;
use App\Models\OnBoard;

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


    Route::resource('payment-cycles', PaymentCycleController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('payment-amounts', PaymentAmountController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('payment-sectors', PaymentSectorController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);


    Route::resource('subscriptions', SubscriptionController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::get('subscriptions/show-by-request-id/{id}', [SubscriptionController::class,'showByRequestId'])->name("subscriptions.show-by-request-id");

    Route::resource('payments', PaymentController::class)
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



    Route::get('activity-logs', [ActivityLogController::class,'index'])->name('activity-logs.index');
    Route::get('activity-ips', [ActivityIpController::class,'index'])->name('activity-ips.index');
    // Route::get('activity-ip-lookups',  [ActivityIpLookupController::class,'index'])->name('activity-ip-lookups.index');
    Route::get('audits', [AuditController::class,'index'])->name('audits.index');

});
