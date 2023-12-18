<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use Illuminate\Console\Scheduling\Schedule;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login Route 
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Logout Route
    Route::post('logout', [AuthController::class, 'logout']);

    // Student Routes
    Route::prefix('student')->group(function () {
        Route::post('import', [StudentController::class, 'import']);
        Route::post('export', [StudentController::class, 'export']);
    });

    // Schedule Routes
    Route::prefix('schedule')->group(function () {
        Route::post('store', [ScheduleController::class, 'store']);
    });
});
