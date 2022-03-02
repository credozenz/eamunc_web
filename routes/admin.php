<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\NewsletterController;
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

 Route::group(['middleware' => 'adminchecker'], function() {
     Route::get('/dashbord', [DashbordController::class,'getDashbord']);
     Route::get('/newsletter', [NewsletterController::class,'index']);
     Route::get('/newsletter_create', [NewsletterController::class,'create']);
     Route::post('/newsletter_store', [NewsletterController::class,'store']);
     Route::get('/newsletter_edit/{id}', [NewsletterController::class,'edit']);
     Route::get('/newsletter_show/{id}', [NewsletterController::class,'show']);
     Route::post('/newsletter_update/{id}', [NewsletterController::class,'update']);
     Route::post('/newsletter_delete/{id}', [NewsletterController::class,'destroy']);
 });