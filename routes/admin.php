<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PresidentMessagesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FacultiesMessagesController;
use App\Http\Controllers\Admin\MentorsController;
use App\Http\Controllers\Admin\GalleryController;
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

     Route::get('/facultiesmessages', [FacultiesMessagesController::class,'index'])->name('admin.facultiesmessages');
     Route::get('/facultiesmessages_create', [FacultiesMessagesController::class,'create'])->name('admin.facultiesmessages.create');
     Route::post('/facultiesmessages_store', [FacultiesMessagesController::class,'store'])->name('admin.facultiesmessages.store');
     Route::get('/facultiesmessages_edit/{id}', [FacultiesMessagesController::class,'edit'])->name('admin.facultiesmessages.edit');
     Route::get('/facultiesmessages_show/{id}', [FacultiesMessagesController::class,'show'])->name('admin.facultiesmessages.show');
     Route::post('/facultiesmessages_update/{id}', [FacultiesMessagesController::class,'update'])->name('admin.facultiesmessages.update');
     Route::post('/facultiesmessages_delete/{id}', [FacultiesMessagesController::class,'destroy'])->name('admin.facultiesmessages.destroy');
     
     Route::get('/our_mentors', [MentorsController::class,'index'])->name('admin.ourmentors');
     Route::get('/our_mentors_create', [MentorsController::class,'create'])->name('admin.ourmentors.create');
     Route::post('/our_mentors_store', [MentorsController::class,'store'])->name('admin.ourmentors.store');
     Route::get('/our_mentors_edit/{id}', [MentorsController::class,'edit'])->name('admin.ourmentors.edit');
     Route::get('/our_mentors_show/{id}', [MentorsController::class,'show'])->name('admin.ourmentors.show');
     Route::post('/our_mentors_update/{id}', [MentorsController::class,'update'])->name('admin.ourmentors.update');
     Route::post('/our_mentors_delete/{id}', [MentorsController::class,'destroy'])->name('admin.ourmentors.destroy');

     Route::get('/gallery', [GalleryController::class,'index'])->name('admin.gallery');
     Route::get('/gallery_create', [GalleryController::class,'create'])->name('admin.gallery.create');
     Route::post('/gallery_store', [GalleryController::class,'store'])->name('admin.gallery.store');
     Route::get('/gallery_edit/{id}', [GalleryController::class,'edit'])->name('admin.gallery.edit');
     Route::get('/gallery_show/{id}', [GalleryController::class,'show'])->name('admin.gallery.show');
     Route::post('/gallery_update/{id}', [GalleryController::class,'update'])->name('admin.gallery.update');
     Route::post('/gallery_delete/{id}', [GalleryController::class,'destroy'])->name('admin.gallery.destroy');
     

     Route::get('/profile', [ProfileController::class,'profile']);
     Route::post('/profile_update', [ProfileController::class,'update_profile'])->name('admin.profile.update');

     Route::get('/change_password', [ProfileController::class,'change_password']);
     Route::post('/password_update', [ProfileController::class,'update_password'])->name('admin.password.update');

 });