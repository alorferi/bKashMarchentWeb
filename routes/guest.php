<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionPaymentController;

Route::get('/', function () {

    $subscriptionController = new SubscriptionController();

    return  $subscriptionController->create();
})->name("/");

Route::get('about-us', [AboutUsController::class,'index'])->name('about-us.index');

Route::get('subscriptions/create', [SubscriptionController::class,'create'])->name('subscriptions.create');
Route::post('subscriptions', [SubscriptionController::class,'store'])->name('subscriptions.store');

// Route::get('subscriptions/my-payments', [SubscriptionController::class,'showMyPayments'])
// ->name('subscriptions.show.my-payments');


Route::get('subscriptions/my-subscriptions', [SubscriptionController::class,'showMySubscriptions'])
->name('subscriptions.show.my-subscriptions');


Route::get('subscriptions/finish', [SubscriptionController::class,'finish'])->name('subscriptions.finish');

Route::get('subscription-payments/my-payments-by-subscription-id/{subscriptionId}', [SubscriptionPaymentController::class,'showMyPaymentsBySubscriptionId'])->name('subscription-payments.my-payments-by-subscription-id');
