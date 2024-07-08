<?php

use App\Http\Controllers\GithubController;
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

Route::post('/tripay-webhook', [TripayWebhookController::class]);
Route::post('/create-order', [OrderController::class, 'createTransaction']);
Route::group(['prefix' => '/gh'], function () {
    Route::get('/get-releases/{repo}', [GithubController::class, 'getReleases'])->name('api.github.releases');
    Route::get('/get-assets/{repo}/{releaseid}', [GithubController::class, 'getAssets'])->name('api.github.assets');
    Route::get('/get-repos', [GithubController::class, 'getRepos'])->name('api.github.repos');

});

// Route::get('/github',function(){
    
//     $client = new \Github\Client();
//     $auth =$client->authenticate('TOKEN', null, \Github\AuthMethod::ACCESS_TOKEN);
//    // Example: Fetch latest release information
// $repoOwner = 'jstalinko';
// $repoName = 'cicak';

// $release = $client->api('repo')->releases()->latest($repoOwner, $repoName);

// // Example: Find the download URL of the asset (e.g., a zip file)
// $assets = $client->api('repo')->releases()->assets()->all($repoOwner, $repoName, $release['id']);

// $download = $client->api('repo')->releases()->assets()->show($repoOwner,$repoName,$assets[0]['id'],true);

// return response()->streamDownload(function () use ($download) {
//     echo $download;
// }, 'cicak-1.00.zip', ['Content-Type' => 'application/zip']);
// });