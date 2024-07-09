<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
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
Route::post('/comments/{tintuc_id}', [CommentController::class, 'store'])->name('comments.store');
//tìm kiếm
Route::get('/search', [SearchController::class, 'search'])->name('search');

Auth::routes();
