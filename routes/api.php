<?php

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

Route::post('/tripay-webhook' , [TripayWebhookController::class]);

Route::post('/create-order',[OrderController::class , 'createTransaction']);

// Route::middleware('api')->get('/check-auth', function () {
//     if (auth()->check()) {
//         return response()->json([
//             'authenticated' => true,
//             'user' => auth()->user(),
//         ]);
//     } else {
//         return response()->json([
//             'authenticated' => false,
//             'message' => 'User is not authenticated',
//         ], 401);
//     }
// });