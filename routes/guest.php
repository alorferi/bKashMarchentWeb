<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Apis\WebhookController;
use App\Http\Controllers\DonateUsController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {

    $donateUsController = new DonateUsController();

    return  $donateUsController->index();
})->name("/");

Route::get('about-us', [AboutUsController::class,'index'])->name('about-us.index');
Route::get('donate-us', [DonateUsController::class,'index'])->name('donate-us.index');

Route::post('donate-us/subscribe', [DonateUsController::class,'subscribe'])->name('donate-us.subscribe');

Route::get('subscriptions/my-payments', [SubscriptionController::class,'showMyPayments'])
->name('subscriptions.show.my-payments');


// Route::get('api/web-hook/bkash', [WebhookController::class,'bKashHookGet']);
Route::get('donate-us/finish', [DonateUsController::class,'finish']);

