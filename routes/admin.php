<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PresidentMessagesController;
use App\Http\Controllers\Admin\ProfileController;
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
     
     Route::get('/dashbord', [DashbordController::class,'getDashbord'])->name('admin.dashbord');
    
     Route::get('/newsletter', [NewsletterController::class,'index'])->name('admin.newsletter');
     Route::get('/newsletter_create', [NewsletterController::class,'create'])->name('admin.newsletter.create');
     Route::post('/newsletter_store', [NewsletterController::class,'store'])->name('admin.newsletter.store');
     Route::get('/newsletter_edit/{id}', [NewsletterController::class,'edit'])->name('admin.newsletter.edit');
     Route::get('/newsletter_show/{id}', [NewsletterController::class,'show'])->name('admin.newsletter.show');
     Route::post('/newsletter_update/{id}', [NewsletterController::class,'update'])->name('admin.newsletter.update');
     Route::post('/newsletter_delete/{id}', [NewsletterController::class,'destroy'])->name('admin.newsletter.destroy');

     Route::get('/president_messages', [PresidentMessagesController::class,'index'])->name('admin.president_messages');
     Route::post('/president_messages_update', [PresidentMessagesController::class,'update'])->name('admin.president_messages.update');

     Route::get('/profile', [ProfileController::class,'profile']);
     Route::post('/profile_update', [ProfileController::class,'update_profile'])->name('admin.profile.update');

 });