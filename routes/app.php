<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\AuthController;

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

Route::get('/', [AuthController::class,'getLogin']);
Route::post('/login', [AuthController::class,'postLogin']);
Route::group(['middleware' => 'userchecker'], function() {


});
