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
use App\Http\Controllers\Web\LiveController;
use App\Http\Controllers\Web\PastConferenceController;
use App\Http\Controllers\Web\RegistrationController;
use App\Http\Controllers\Web\VirtualCodeController;

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
Route::get('/committees', [CommitteesController::class,'index'])->name('committees');
Route::get('/committees-inner/{id}', [CommitteesController::class,'index_inner'])->name('committees-inner');
Route::get('/conferences', [ConferencesController::class,'index'])->name('conference');
Route::get('/faq', [FaqController::class,'index'])->name('faq');
Route::get('/feedback', [FeedbackController::class,'index'])->name('feedback');
Route::get('/gallery', [GalleryController::class,'index'])->name('gallery');
Route::get('/gallery-inner/{id}', [GalleryController::class,'index_inner'])->name('gallery-inner');
Route::get('/host-school', [HostSchoolController::class,'index'])->name('host-school');
Route::get('/live', [LiveController::class,'index'])->name('live');
Route::get('/past-conference', [PastConferenceController::class,'index'])->name('past-conference');
Route::get('/past-conference-inner/{id}', [PastConferenceController::class,'index_inner'])->name('past-conference-inner');
Route::get('/registration', [RegistrationController::class,'index'])->name('registration');
Route::get('/hs-registration', [RegistrationController::class,'hs_registration'])->name('hs-registration');
Route::get('/isg-registration', [RegistrationController::class,'isg_registration'])->name('isg-registration');
Route::get('/virtual-code', [VirtualCodeController::class,'index'])->name('virtual-code');

