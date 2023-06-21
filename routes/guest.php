<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\MySubscriptionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionPaymentController;

Route::get('/', function () {

    $subscriptionController = new SubscriptionController();

    return  $subscriptionController->create();
})->name("/");

Route::get('about-us', [AboutUsController::class,'index'])->name('about-us.index');

Route::get('subscriptions/create', [SubscriptionController::class,'create'])->name('subscriptions.create');
Route::post('subscriptions', [SubscriptionController::class,'store'])->name('subscriptions.store');

Route::get('subscriptions/finish', [SubscriptionController::class,'finish'])->name('subscriptions.finish');



Route::get('my-subscriptions/login', [MySubscriptionController::class,'login'])
->name('my-subscriptions.login');

Route::group(['middleware' => ['auth.donor']], function () {

    Route::get('my-subscriptions', [MySubscriptionController::class,'index'])->name('my-subscriptions.index');

    Route::post('my-subscriptions/logout', [MySubscriptionController::class,'logout'])->name('my-subscriptions.logout');

    Route::get('my-subscriptions/{subscription}', [MySubscriptionController::class,'show'])->name('my-subscriptions.show');
    Route::get('my-subscriptions/{subscription}/payments', [MySubscriptionController::class,'showPaymentsBySubscriptionId'])->name('my-subscriptions.payments');
    Route::get('my-subscriptions/{subscription}/cancel', [MySubscriptionController::class,'createCancel'])->name('my-subscriptions.cancel');
    Route::post('my-subscriptions/{subscription}/cancel', [MySubscriptionController::class,'confirmCancel'])->name('my-subscriptions.confirm-cancel');

});
