<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::get('external-books', [BookController::class, 'externalBooks']);

Route::prefix('v1')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get("", [BookController::class, 'index']);
        Route::post("", [BookController::class, 'create']);
        Route::get("/{book}", [BookController::class, 'show']);
        Route::patch("/{book}", [BookController::class, 'edit']);
        Route::delete("/{book}", [BookController::class, 'destroy']);
    });
});

