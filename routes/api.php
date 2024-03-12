<?php

use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;

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

Route::middleware(['auth:sanctum', 'jsonResponse'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [ApiAuthController::class, 'login'])->name('login');

Route::apiResource('/jobs', JobController::class);
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('favorites', FavoriteController::class);
});
