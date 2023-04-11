<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\DonateUsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PostController ;
use App\Http\Controllers\SubscriptionController;
use App\Models\Post;

Route::get('/', function () {


    $donateUsController = new DonateUsController();

    return  $donateUsController->index();
    // $posts = Post::latest()
    // ->where('post_status', 'publish')
    // ->paginate();
    // return view('welcome', compact('posts'));
})->name("/");

Route::get('posts', [PostController::class,'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class,'show'])->name('posts.show');
Route::get('gallery', [GalleryController::class,'index'])->name('gallery.index');
Route::get('about-us', [AboutUsController::class,'index'])->name('about-us.index');
Route::get('donate-us', [DonateUsController::class,'index'])->name('donate-us.index');
Route::get('books', [BookController::class,'index'])->name('books.index');
Route::get('members', [MemberController::class,'index'])->name('members.index');
Route::get('committees', [CommitteeController::class,'index'])->name('committees.index');

Route::get('subscriptions/{mobile}/show-by-mobile', [SubscriptionController::class,'showByMobile'])
->name('subscriptions.mobile.show');
