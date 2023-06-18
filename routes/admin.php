<?php

use App\Http\Controllers\ActivityIpController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\OtcController;
use App\Http\Controllers\PaymentAmountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentFrequencyController;
use App\Http\Controllers\DonationSectorController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Http\Controllers\SubscriptionRequestController;

Route::group(['prefix' => 'admin',  'middleware' => ['auth'], 'as'=>"admin."], function () {

    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::resource('payment-cycles', PaymentFrequencyController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('payment-amounts', PaymentAmountController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('payment-sectors', DonationSectorController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);


    Route::resource('subscriptions', SubscriptionController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    // Route::get('subscriptions/{subscription}/fetch', [SubscriptionController::class,'fetch'])->name("subscriptions.fetch");

    Route::resource('payments', PaymentController::class)
    ->except([
       // 'index', 'show'
    ])
    ->middleware(['auth']);

    Route::resource('subscription-requests', SubscriptionRequestController::class)
    ->except([
      //  'index', 'show'
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


    Route::get('otcs', [OtcController::class,'index'])->name("otcs.index");
    Route::get('subscription-payments/{subscriptionId}', [SubscriptionPaymentController::class,'index'])->name('subscription-payments.index');

    Route::get('activity-logs', [ActivityLogController::class,'index'])->name('activity-logs.index');
    Route::get('activity-ips', [ActivityIpController::class,'index'])->name('activity-ips.index');
    // Route::get('activity-ip-lookups',  [ActivityIpLookupController::class,'index'])->name('activity-ip-lookups.index');
    Route::get('audits', [AuditController::class,'index'])->name('audits.index');

});
