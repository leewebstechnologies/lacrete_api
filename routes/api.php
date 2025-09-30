<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('authenticate', [AuthenticationController::class, 'authenticate']);


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Protected Routes
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('logout', [AuthenticationController::class, 'logout']);

    //Blog Routes
    Route::post('blogs', [BlogController::class, 'store']);
    Route::get('blogs', [BlogController::class, 'index']);
    Route::put('blogs/{id}', [BlogController::class, 'update']);
    Route::get('blogs/{id}', [BlogController::class, 'show']);
    Route::delete('blogs/{id}', [BlogController::class, 'destroy']);

    // Temp Image Routes
    Route::post('temp-images', [TempImageController::class, 'store']);



});


