<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// trang chủ
Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// bài viết
Route::get('/tintuc/{id}', [NewsController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('news.show');

//danh mục
Route::get('/danhmuc', [CategoryController::class, 'index'])->name('category');
Route::get('/danhmuc/{id}', [CategoryController::class, 'show'])->name('category.show');

// Về chúng tôi
Route::get('/aboutus', function () {
    return view('client.about');
})->name('aboutus');

//Liên Hệ
Route::get('/contact', [contactController::class, 'create'])->name('contact.create');
Route::post('/contact', [contactController::class, 'store'])->name('contact.store');

//Bình luận

// Route::get('/test/{id}', [NewsController::class, 'test'])
//     ->where('id', '[0-9]+')
//     ->name('news.test')
Route::post('/comments/uploadImage', [NewsController::class, 'uploadImage'])->name('comments.uploadImage');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware(['auth', 'verified']);

//tìm kiếm
Route::get('/search', [SearchController::class, 'search'])->name('search');

// //verified
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Auth::routes();
