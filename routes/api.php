<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeTimeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\SwitcherController;
use App\Http\Controllers\TvShowController;
use App\Http\Controllers\TvShowTimeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::apiResource('users', UserController::class);

Route::prefix('v1')->middleware('jwt.auth')->group(function() {

    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('jobs', JobController::class);
    Route::apiResource('employee-times', EmployeeTimeController::class);
    Route::apiResource('switcher', SwitcherController::class);
    Route::apiResource('studios', StudioController::class);
    Route::apiResource('tv-shows', TvShowController::class);
    Route::get('tv-show-times/filters', [TvShowTimeController::class, 'filters']);
    Route::apiResource('tv-show-times', TvShowTimeController::class);
    Route::apiResource('schedules', ScheduleController::class);
});
