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

// PENGGUNAAN API RESOURCE LEBIH SINGKAT (PLURAL)
// Route::middleware(AuthTokenMiddleware::class)->group(function () {
// Route::middleware('auth:api')->group(function () {
//     Route::apiResources([
//         'student' => StudentController::class,
//         'room' => RoomController::class,
//     ]);
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // bisa diakses semua user
    Route::prefix('student')->controller(StudentController::class)->group(function () {
        Route::get('/', [StudentController::class, 'index']);
        Route::get('/{id}', [StudentController::class, 'show']);
    });
    Route::prefix('room')->controller(StudentController::class)->group(function () {
        Route::get('/', [RoomController::class, 'index']);
        Route::get('/{id}', [RoomController::class, 'show']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // hanya admin
    Route::middleware('role:admin')->group(function () {
        Route::prefix('student')->controller(StudentController::class)->group(function () {
            Route::post('/', [StudentController::class, 'store']);
            Route::put('/{id}', [StudentController::class, 'update']);
            Route::delete('/{id}', [StudentController::class, 'destroy']);
        });
        Route::prefix('room')->controller(RoomController::class)->group(function () {
            Route::post('/', [RoomController::class, 'store']);
            Route::put('/{id}', [RoomController::class, 'update']);
            Route::delete('/{id}', [RoomController::class, 'destroy']);
        });
    });
});
