<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RoomController;
use App\Http\Controllers\Api\V1\StudentController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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
Route::apiResources([
    'student' => StudentController::class,
    'room' => RoomController::class,
]);
