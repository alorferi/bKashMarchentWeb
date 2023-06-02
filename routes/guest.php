<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {

    $subscriptionController = new SubscriptionController();

    return  $subscriptionController->create();
})->name("/");

Route::get('about-us', [AboutUsController::class,'index'])->name('about-us.index');

Route::get('subscriptions/create', [SubscriptionController::class,'create'])->name('subscriptions.create');
Route::post('subscriptions', [SubscriptionController::class,'store'])->name('subscriptions.store');

Route::get('subscriptions/my-payments', [SubscriptionController::class,'showMyPayments'])
->name('subscriptions.show.my-payments');


Route::get('subscriptions/finish', [SubscriptionController::class,'finish'])->name('subscriptions.finish');

