<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('website.index');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/entrar', 'HomeController@signin')->name('website.signin');
Route::get('/sair', 'HomeController@signout')->name('website.signout');
Route::get('/sobre', 'HomeController@about')->name('website.about');
Route::get('/recuperar-senha', 'HomeController@forgotPassword')->name('website.forgotPassword');
