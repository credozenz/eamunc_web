<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\Bureau\BureauDashbordController;
use App\Http\Controllers\App\Delegate\DelegateDashbordController;
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

Route::group(['middleware' => 'bureauchecker'], function() {
    
    Route::get('/bureau_dashbord', [BureauDashbordController::class,'getDashbord'])->name('app.bureau_dashbord');

});


Route::group(['middleware' => 'delegatechecker'], function() {

    Route::get('/delegate_dashbord', [DelegateDashbordController::class,'getDashbord'])->name('app.delegate_dashbord');

});
