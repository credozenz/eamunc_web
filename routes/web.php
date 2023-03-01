<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\AboutUSController;
use App\Http\Controllers\Web\ActImpactController;
use App\Http\Controllers\Web\AlumniController;
use App\Http\Controllers\Web\CommitteesController;
use App\Http\Controllers\Web\ConferencesController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\FeedbackController;
use App\Http\Controllers\Web\GalleryController;
use App\Http\Controllers\Web\HostSchoolController;
use App\Http\Controllers\Web\ParticipateSchoolController;
use App\Http\Controllers\Web\LiveController;
use App\Http\Controllers\Web\PastConferenceController;
use App\Http\Controllers\Web\RegistrationController;
use App\Http\Controllers\Web\VirtualCodeController;
use App\Http\Controllers\Web\NewsLetterController;
use App\Http\Controllers\Web\PolicyController;

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

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/about', [AboutUSController::class,'index'])->name('about-us');
Route::get('/act-impact', [ActImpactController::class,'index'])->name('act-impact');
Route::get('/alumni', [AlumniController::class,'index'])->name('alumni');
Route::get('/alumninews-inner/{id}', [AlumniController::class,'alumni_news_inner'])->name('alumni-news-inner');
Route::get('/committees', [CommitteesController::class,'index'])->name('committees');
Route::get('/committees-inner/{id}', [CommitteesController::class,'index_inner'])->name('committees-inner');
Route::get('/conferences', [ConferencesController::class,'index'])->name('conference');
Route::get('/conference-update-inner/{id}', [ConferencesController::class,'conference_update_inner'])->name('conference-update-inner');
Route::get('/faq', [FaqController::class,'index'])->name('faq');
Route::get('/feedback', [FeedbackController::class,'index'])->name('feedback');
Route::post('/feedback-store', [FeedbackController::class,'feedback_store'])->name('feedback-store');
Route::get('/gallery', [GalleryController::class,'index'])->name('gallery');
Route::get('/gallery-inner/{id}', [GalleryController::class,'index_inner'])->name('gallery-inner');
Route::get('/host-school', [HostSchoolController::class,'index'])->name('host-school');
Route::get('/participate-school', [ParticipateSchoolController::class,'index'])->name('participate-school');
Route::get('/live', [LiveController::class,'index'])->name('live');
Route::get('/newsletter', [NewsLetterController::class,'index'])->name('newsletter');
Route::get('/past-conference', [PastConferenceController::class,'index'])->name('past-conference');
Route::get('/past-conference-inner/{id}', [PastConferenceController::class,'index_inner'])->name('past-conference-inner');
Route::get('/registration', [RegistrationController::class,'index'])->name('registration');
Route::get('/school-registration', [RegistrationController::class,'school_registration'])->name('school-registration');
Route::post('/school-registration-store', [RegistrationController::class,'school_store'])->name('school-registration-store');
Route::get('/isg-registration', [RegistrationController::class,'isg_registration'])->name('isg-registration');
Route::post('/isg-registration-store', [RegistrationController::class,'isg_store'])->name('isg-registration-store');
Route::get('/virtual-code', [VirtualCodeController::class,'index'])->name('virtual-code');
Route::post('/committees_and_country', [RegistrationController::class,'committees_and_country'])->name('committees_and_country');
Route::post('/validate_user_email', [RegistrationController::class,'validate_user_email'])->name('validate_user_email');
Route::post('/validate_user_phone', [RegistrationController::class,'validate_user_phone'])->name('validate_user_phone');

Route::get('/privacy_policy', [PolicyController::class,'privacy_policy'])->name('privacy-policy');
Route::get('/terms_service', [PolicyController::class,'terms_service'])->name('terms-service');