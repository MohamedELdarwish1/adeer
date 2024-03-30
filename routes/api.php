<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'Register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bid', [BidController::class, 'store']);
});
