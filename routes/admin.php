<?php

use App\Http\Controllers\BackEnd\AccountController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\CommentController;
use App\Http\Controllers\BackEnd\ContactController;
use App\Http\Controllers\BackEnd\NewsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Register resource routes
        $resources = [
            'category' => CategoryController::class,
            'contact' => ContactController::class,
            'news' => NewsController::class,
            'comment' => CommentController::class,
            'account' => AccountController::class,
        ];

        foreach ($resources as $name => $controller) {
            Route::resource($name, $controller);
        }
        Route::post('/news/uploadImage', [NewsController::class, 'uploadImage'])->name('news.uploadImage');

    });


//     <?php

// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Admin Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your admin panel. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
//     Route::resource('/admin/users', 'Admin\UserController');
//     // Add more admin routes here
// });


// Route::resource('catalogues', CatalogueController::class);

// Route::prefix('catalogues')
//     ->as('catalogues.')
//     ->group(function () {
//         Route::get('/',                 [CatalogueController::class, 'index'])->name('index');
//         Route::get('create',            [CatalogueController::class, 'create'])->name('create');
//         Route::post('store',            [CatalogueController::class, 'store'])->name('store');
//         Route::get('show/{id}',         [CatalogueController::class, 'show'])->name('show');
//         Route::get('{id}/edit',         [CatalogueController::class, 'edit'])->name('edit');
//         Route::put('{id}/update',       [CatalogueController::class, 'update'])->name('update');
//         Route::get('{id}/destroy',      [CatalogueController::class, 'destroy'])->name('destroy');

//     });
// Route::resource('products', ProductController::class);
//        Route::prefix('products')
//            ->as('products.')
//            ->group(function () {
//                Route::get('/',                 [ProductController::class, 'index'])->name('index');
//                Route::get('create',            [ProductController::class, 'create'])->name('create');
//                Route::post('store',            [ProductController::class, 'store'])->name('store');
//                Route::get('show/{id}',         [ProductController::class, 'show'])->name('show');
//                Route::get('{id}/edit',         [ProductController::class, 'edit'])->name('edit');
//                Route::put('{id}/update',       [ProductController::class, 'update'])->name('update');
//                Route::get('{id}/destroy',      [ProductController::class, 'destroy'])->name('destroy');
//
//            });
