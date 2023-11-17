<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Lunch\CategoryController;
use App\Http\Controllers\Lunch\DishController;
use App\Http\Controllers\Lunch\LunchController;
use App\Http\Controllers\Uefa\UefaController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('lunch')->group(function () {
        Route::get('', [LunchController::class, 'index']);
        Route::controller(CategoryController::class)->prefix('categories')->group(function () {
            Route::get('', 'index');
            Route::get('{category}', 'show');
            Route::put('{category}', 'update');
        });
        Route::controller(DishController::class)->prefix('dishes')->group(function () {
            Route::get('', 'index');
            Route::get('{dish}', 'show');
            Route::put('{dish}', 'update');
        });
    });
    Route::prefix('uefa')->group(function () {
        Route::get('', [UefaController::class, 'index']);
    });
});

Route::post('login', [AuthController::class, 'login']);
