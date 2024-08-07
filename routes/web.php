<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JustOrangeController;
use App\Http\Controllers\OrderController;
use Filament\Http\Middleware\Authenticate;

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

Route::get('/', [JustOrangeController::class, 'index']);
Route::get('/about', [JustOrangeController::class, 'about'])->name('about');
Route::get('/contact', [JustOrangeController::class, 'contact'])->name('contact');
Route::get('/invoice/{invoice}', [OrderController::class, 'getInvoice'])->name('invoice');

Route::get('/posts', [JustOrangeController::class, 'posts'])->name('posts');
Route::group(['prefix' => '/post'], function () {
    Route::redirect('/', '/posts');
    Route::get('/search', [JustOrangeController::class, 'searchPost'])->name('post.search');
    Route::get('/{slug}', [JustOrangeController::class, 'post'])->name('post.detail');
});

Route::get('/products', [JustOrangeController::class, 'products'])->name('products');
Route::group(['prefix' => '/product'], function () {
    Route::redirect('/', '/products');
    Route::get('/category/{slug}', [JustOrangeController::class, 'categoryProduct'])->name('product.category');
    Route::get('/search', [JustOrangeController::class, 'searchProduct'])->name('product.search');
    Route::get('/checkout/{slug}', [OrderController::class, 'checkoutProduct'])->name('product.checkout');
    Route::get('/{slug}', [JustOrangeController::class, 'product'])->name('product.detail');
});


Route::group(['middleware' => 'auth:sanctum'] , function(){
    Route::get('/download/{product_id}' , [OrderController::class , 'downloadProduct'])->name('product.download');
});