<?php

use App\Http\Controllers\API\SantumController;
use App\Http\Controllers\API\TaskContorller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//public routes 
Route::post("/login", [SantumController::class, 'login']);
Route::post("/register", [SantumController::class, 'register']);

/// protected routes 
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource("/tasks", TaskContorller::class);
    Route::post("/logout", [SantumController::class, 'logout']);
});
