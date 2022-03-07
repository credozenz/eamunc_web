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
use App\Http\Controllers\Admin\LiveController;
use App\Http\Controllers\Admin\CommitteeMembersController;
use App\Http\Controllers\Admin\HostSchoolController;
use App\Http\Controllers\Admin\ActImpactsController;
use App\Http\Controllers\Admin\VcconduntController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\LetterController;
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
     Route::get('/gallery_images/{id}', [GalleryController::class,'gallery_images'])->name('admin.gallery.images');
     Route::post('/gallery_add_images', [GalleryController::class,'add_images'])->name('admin.gallery.add_images');
     Route::post('/gallery_update/{id}', [GalleryController::class,'update'])->name('admin.gallery.update');
     Route::post('/gallery_delete/{id}', [GalleryController::class,'destroy'])->name('admin.gallery.destroy');
     Route::post('/gallery_img_delete/{id}', [GalleryController::class,'gallery_img_delete'])->name('admin.gallery.dlt_images');

     Route::get('/live', [LiveController::class,'index'])->name('admin.live');
     Route::post('/live_update', [LiveController::class,'update'])->name('admin.live.update');

     Route::get('/committee_members', [CommitteeMembersController::class,'index'])->name('admin.committee_members');
     Route::get('/committee_members_create', [CommitteeMembersController::class,'create'])->name('admin.committee_members.create');
     Route::post('/committee_members_store', [CommitteeMembersController::class,'store'])->name('admin.committee_members.store');
     Route::get('/committee_members_edit/{id}', [CommitteeMembersController::class,'edit'])->name('admin.committee_members.edit');
     Route::get('/committee_members_show/{id}', [CommitteeMembersController::class,'show'])->name('admin.committee_members.show');
     Route::post('/committee_members_update/{id}', [CommitteeMembersController::class,'update'])->name('admin.committee_members.update');
     Route::post('/committee_members_delete/{id}', [CommitteeMembersController::class,'destroy'])->name('admin.committee_members.destroy');

     Route::get('/host_schools', [HostSchoolController::class,'index'])->name('admin.host_schools');
     Route::get('/host_schools_create', [HostSchoolController::class,'create'])->name('admin.host_schools.create');
     Route::post('/host_schools_store', [HostSchoolController::class,'store'])->name('admin.host_schools.store');
     Route::get('/host_schools_edit/{id}', [HostSchoolController::class,'edit'])->name('admin.host_schools.edit');
     Route::get('/host_schools_show/{id}', [HostSchoolController::class,'show'])->name('admin.host_schools.show');
     Route::post('/host_schools_update/{id}', [HostSchoolController::class,'update'])->name('admin.host_schools.update');
     Route::post('/host_schools_delete/{id}', [HostSchoolController::class,'destroy'])->name('admin.host_schools.destroy');

     Route::get('/letters', [LetterController::class,'index'])->name('admin.letters');
     Route::get('/letters_create', [LetterController::class,'create'])->name('admin.letters.create');
     Route::post('/letters_store', [LetterController::class,'store'])->name('admin.letters.store');
     Route::get('/letters_edit/{id}', [LetterController::class,'edit'])->name('admin.letters.edit');
     Route::get('/letters_show/{id}', [LetterController::class,'show'])->name('admin.letters.show');
     Route::post('/letters_update/{id}', [LetterController::class,'update'])->name('admin.letters.update');
     Route::post('/letters_delete/{id}', [LetterController::class,'destroy'])->name('admin.letters.destroy');


     Route::get('/act_impacts', [ActImpactsController::class,'index'])->name('admin.act_impacts');
     Route::post('/act_impacts_update', [ActImpactsController::class,'update'])->name('admin.act_impacts.update');

     Route::get('/vc_condunt', [VcconduntController::class,'index'])->name('admin.vc_condunt');
     Route::post('/vc_condunt_update', [VcconduntController::class,'update'])->name('admin.vc_condunt.update');

     Route::get('/vision', [VisionController::class,'index'])->name('admin.vision');
     Route::post('/vision_update', [VisionController::class,'update'])->name('admin.vision.update');

     Route::get('/profile', [ProfileController::class,'profile']);
     Route::post('/profile_update', [ProfileController::class,'update_profile'])->name('admin.profile.update');

     Route::get('/change_password', [ProfileController::class,'change_password']);
     Route::post('/password_update', [ProfileController::class,'update_password'])->name('admin.password.update');

});