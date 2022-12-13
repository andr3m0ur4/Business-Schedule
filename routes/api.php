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
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mail as MailModel;

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
// Route::get('email/sendMail', [MailController::class, 'sendMail']);
Route::post('send-mail', [MailController::class, 'sendMail']);
Route::get('verify-token', [MailController::class, 'verifyResetPassword']);
Route::post('change-password', [UserController::class, 'changePassword']);
Route::get('user-job/{user}', [UserController::class, 'userWithJob']);

Route::prefix('v1')->middleware('jwt.auth')->group(function() {
    Route::apiResource('users', UserController::class);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
    Route::get('user-job/{user}', [UserController::class, 'userWithJob']);

    Route::apiResource('jobs', JobController::class);
    Route::put('employee-times/save', [EmployeeTimeController::class, 'save']);
    Route::apiResource('employee-times', EmployeeTimeController::class);
    Route::apiResource('switchers', SwitcherController::class);
    Route::apiResource('studios', StudioController::class);
    Route::apiResource('tv-shows', TvShowController::class);
    Route::get('tv-show-times/filters', [TvShowTimeController::class, 'filters']);
    Route::put('tv-show-times/save', [TvShowTimeController::class, 'save']);
    Route::apiResource('tv-show-times', TvShowTimeController::class);
    Route::post('schedules/save', [ScheduleController::class, 'save']);
    Route::apiResource('schedules', ScheduleController::class);
    Route::apiResource('messages', MessageController::class);
    Route::get('users-data', [UserController::class, 'getUserData']);
    Route::get('users-messages', [MessageController::class, 'getMessages']);
    Route::get('list-users-messages', [UserController::class, 'getUsersMessage']);
    Route::post('read-messages', [MessageController::class, 'readMessages']);
    Route::get('recent-messages', [MessageController::class, 'recentMessages']);
    Route::get('count-messages', [MessageController::class, 'countRecentMessages']);
    Route::get('count-schdules', [ScheduleController::class, 'countSchedule']);
    Route::get('count-time-schdules', [ScheduleController::class, 'countTimeSchedule']);
    Route::get('count-employee-time', [EmployeeTimeController::class, 'countEmployeeTime']);
    Route::get('count-sunday-time', [EmployeeTimeController::class, 'countSundayTime']);
    Route::get('count-tv-show-emloyees', [TvShowTimeController::class, 'countTvShowEmployees']);
});
