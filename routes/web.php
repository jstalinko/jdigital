<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JustOrangeController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [JustOrangeController::class , 'index']);
Route::get('/about', [JustOrangeController::class , 'about'])->name('about');
Route::get('/contact', [JustOrangeController::class , 'contact'])->name('contact');


Route::get('/posts',[JustOrangeController::class , 'posts'])->name('posts');
Route::group(['prefix' => '/post'] , function(){
    Route::redirect('/' , '/posts');
    Route::get('/{slug}',[JustOrangeController::class, 'post'])->name('post.detail');
});

Route::get('/products',[JustOrangeController::class , 'products'])->name('products');
Route::group(['prefix' => '/product'] , function(){
    Route::redirect('/' , '/products');
    Route::get('/checkout/{slug}',[OrderController::class, 'checkoutProduct'])->name('product.checkout');
    Route::get('/{slug}',[JustOrangeController::class, 'product'])->name('product.detail');
});

