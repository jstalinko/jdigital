<?php

use App\Http\Controllers\GithubController;
use App\Http\Controllers\JustOrangeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TripayWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tripay-webhook', TripayWebhookController::class)->name('tripay.webhook');
Route::post('/create-order', [OrderController::class, 'createTransaction']);
Route::get('/transaction/{invoice}',[OrderController::class,'getTransaction']);
Route::group(['prefix' => '/gh'], function () {
    Route::get('/get-releases/{repo}', [GithubController::class, 'getReleases'])->name('api.github.releases');
    Route::get('/get-assets/{repo}/{releaseid}', [GithubController::class, 'getAssets'])->name('api.github.assets');
    Route::get('/get-repos', [GithubController::class, 'getRepos'])->name('api.github.repos');

});
Route::post('/contact' , [JustOrangeController::class , 'submitContact']);