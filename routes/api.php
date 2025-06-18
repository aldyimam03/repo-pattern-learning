<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthTokenMiddleware;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\RoomController;
use App\Http\Controllers\Api\V1\StudentController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// PENGGUNAAN API RESOURCE LEBIH BOROS 
// Route::prefix('student')->controller(StudentController::class)->group(function () {
//     Route::get('/', 'index');
//     Route::get('/{id}', 'show');
//     Route::post('/', 'store');
//     Route::put('/{id}', 'update');
//     Route::delete('/{id}', 'destroy');
// });

// PENGGUNAAN API RESOURCE LEBIH SINGKAT (SINGULAR)
// Route::apiResource('student', StudentController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// PENGGUNAAN API RESOURCE LEBIH SINGKAT (PLURAL)
// Route::middleware(AuthTokenMiddleware::class)->group(function () {
Route::middleware('auth:api')->group(function () {
    Route::apiResources([
        'student' => StudentController::class,
        'room' => RoomController::class,
    ]);
    Route::post('/logout', [AuthController::class, 'logout']);
});
