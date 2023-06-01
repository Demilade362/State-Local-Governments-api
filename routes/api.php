<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Public Routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


//private Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('local/search/{name?}', [LocalController::class, 'search']);
        Route::get('states/search/{name?}', [StateController::class, 'search']);
        Route::apiResource('states', StateController::class)->only('index', 'show');
        Route::apiResource('local', LocalController::class)->only('index', 'show');
    });
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
