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
use App\Http\Controllers\Admin\WorkMembersController;
use App\Http\Controllers\Admin\HostSchoolController;
use App\Http\Controllers\Admin\ActImpactsController;
use App\Http\Controllers\Admin\VcconduntController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\ScheduleConfController;
use App\Http\Controllers\Admin\ConferenceUpdatesController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\RulesController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\AlumniNewsController;
use App\Http\Controllers\Admin\ImportantDateController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\PastConferenceController;
use App\Http\Controllers\Admin\TimerController;

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

     Route::get('/rules', [RulesController::class,'index'])->name('admin.rules');
     Route::post('/rules_update', [RulesController::class,'update'])->name('admin.rules.update');

     Route::get('/alumni', [AlumniController::class,'index'])->name('admin.alumni');
     Route::post('/alumni_update', [AlumniController::class,'update'])->name('admin.alumni.update');

     Route::get('/alumninews', [AlumniNewsController::class,'index'])->name('admin.alumninews');
     Route::get('/alumninews_create', [AlumniNewsController::class,'create'])->name('admin.alumninews.create');
     Route::post('/alumninews_store', [AlumniNewsController::class,'store'])->name('admin.alumninews.store');
     Route::get('/alumninews_edit/{id}', [AlumniNewsController::class,'edit'])->name('admin.alumninews.edit');
     Route::get('/alumninews_show/{id}', [AlumniNewsController::class,'show'])->name('admin.alumninews.show');
     Route::post('/alumninews_update/{id}', [AlumniNewsController::class,'update'])->name('admin.alumninews.update');
     Route::post('/alumninews_delete/{id}', [AlumniNewsController::class,'destroy'])->name('admin.alumninews.destroy');

     Route::get('/importantdate', [ImportantDateController::class,'index'])->name('admin.importantdate');
     Route::get('/importantdate_create', [ImportantDateController::class,'create'])->name('admin.importantdate.create');
     Route::post('/importantdate_store', [ImportantDateController::class,'store'])->name('admin.importantdate.store');
     Route::get('/importantdate_edit/{id}', [ImportantDateController::class,'edit'])->name('admin.importantdate.edit');
     Route::get('/importantdate_show/{id}', [ImportantDateController::class,'show'])->name('admin.importantdate.show');
     Route::post('/importantdate_update/{id}', [ImportantDateController::class,'update'])->name('admin.importantdate.update');
     Route::post('/importantdate_delete/{id}', [ImportantDateController::class,'destroy'])->name('admin.importantdate.destroy');

     Route::get('/banner', [BannerController::class,'index'])->name('admin.banner');
     Route::get('/banner_create', [BannerController::class,'create'])->name('admin.banner.create');
     Route::post('/banner_store', [BannerController::class,'store'])->name('admin.banner.store');
     Route::get('/banner_edit/{id}', [BannerController::class,'edit'])->name('admin.banner.edit');
     Route::get('/banner_show/{id}', [BannerController::class,'show'])->name('admin.banner.show');
     Route::post('/banner_update/{id}', [BannerController::class,'update'])->name('admin.banner.update');
     Route::post('/banner_delete/{id}', [BannerController::class,'destroy'])->name('admin.banner.destroy');
     
     Route::get('/facultiesmessages', [FacultiesMessagesController::class,'index'])->name('admin.facultiesmessages');
     Route::get('/facultiesmessages_create', [FacultiesMessagesController::class,'create'])->name('admin.facultiesmessages.create');
     Route::post('/facultiesmessages_store', [FacultiesMessagesController::class,'store'])->name('admin.facultiesmessages.store');
     Route::get('/facultiesmessages_edit/{id}', [FacultiesMessagesController::class,'edit'])->name('admin.facultiesmessages.edit');
     Route::get('/facultiesmessages_show/{id}', [FacultiesMessagesController::class,'show'])->name('admin.facultiesmessages.show');
     Route::post('/facultiesmessages_update/{id}', [FacultiesMessagesController::class,'update'])->name('admin.facultiesmessages.update');
     Route::post('/facultiesmessages_delete/{id}', [FacultiesMessagesController::class,'destroy'])->name('admin.facultiesmessages.destroy');
     
     Route::get('/our_mentors', [MentorsController::class,'index'])->name('admin.our_mentors');
     Route::get('/our_mentors_create', [MentorsController::class,'create'])->name('admin.our_mentors.create');
     Route::post('/our_mentors_store', [MentorsController::class,'store'])->name('admin.our_mentors.store');
     Route::get('/our_mentors_edit/{id}', [MentorsController::class,'edit'])->name('admin.our_mentors.edit');
     Route::get('/our_mentors_show/{id}', [MentorsController::class,'show'])->name('admin.our_mentors.show');
     Route::post('/our_mentors_update/{id}', [MentorsController::class,'update'])->name('admin.our_mentors.update');
     Route::post('/our_mentors_delete/{id}', [MentorsController::class,'destroy'])->name('admin.our_mentors.destroy');

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

     Route::get('/timer', [TimerController::class,'index'])->name('admin.timer');
     Route::post('/timer_update', [TimerController::class,'update'])->name('admin.timer.update');

     Route::get('/work_members', [WorkMembersController::class,'index'])->name('admin.work_members');
     Route::get('/work_members_create', [WorkMembersController::class,'create'])->name('admin.work_members.create');
     Route::post('/work_members_store', [WorkMembersController::class,'store'])->name('admin.work_members.store');
     Route::get('/work_members_edit/{id}', [WorkMembersController::class,'edit'])->name('admin.work_members.edit');
     Route::get('/work_members_show/{id}', [WorkMembersController::class,'show'])->name('admin.work_members.show');
     Route::post('/work_members_update/{id}', [WorkMembersController::class,'update'])->name('admin.work_members.update');
     Route::post('/work_members_delete/{id}', [WorkMembersController::class,'destroy'])->name('admin.work_members.destroy');

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

     Route::get('/conference_schedule', [ScheduleConfController::class,'index'])->name('admin.conference_schedule');
     Route::get('/conference_schedule_create', [ScheduleConfController::class,'create'])->name('admin.conference_schedule.create');
     Route::post('/conference_schedule_store', [ScheduleConfController::class,'store'])->name('admin.conference_schedule.store');
     Route::get('/conference_schedule_edit/{id}', [ScheduleConfController::class,'edit'])->name('admin.conference_schedule.edit');
     Route::get('/conference_schedule_show/{id}', [ScheduleConfController::class,'show'])->name('admin.conference_schedule.show');
     Route::post('/conference_schedule_update/{id}', [ScheduleConfController::class,'update'])->name('admin.conference_schedule.update');
     Route::post('/conference_schedule_delete/{id}', [ScheduleConfController::class,'destroy'])->name('admin.conference_schedule.destroy');

     Route::get('/conference_updates', [ConferenceUpdatesController::class,'index'])->name('admin.conference_updates');
     Route::get('/conference_updates_create', [ConferenceUpdatesController::class,'create'])->name('admin.conference_updates.create');
     Route::post('/conference_updates_store', [ConferenceUpdatesController::class,'store'])->name('admin.conference_updates.store');
     Route::get('/conference_updates_edit/{id}', [ConferenceUpdatesController::class,'edit'])->name('admin.conference_updates.edit');
     Route::get('/conference_updates_show/{id}', [ConferenceUpdatesController::class,'show'])->name('admin.conference_updates.show');
     Route::post('/conference_updates_update/{id}', [ConferenceUpdatesController::class,'update'])->name('admin.conference_updates.update');
     Route::post('/conference_updates_delete/{id}', [ConferenceUpdatesController::class,'destroy'])->name('admin.conference_updates.destroy');
     
     Route::get('/committee', [CommitteeController::class,'index'])->name('admin.committee');
     Route::get('/committee_create', [CommitteeController::class,'create'])->name('admin.committee.create');
     Route::post('/committee_store', [CommitteeController::class,'store'])->name('admin.committee.store');
     Route::get('/committee_edit/{id}', [CommitteeController::class,'edit'])->name('admin.committee.edit');
     Route::get('/committee_show/{id}', [CommitteeController::class,'show'])->name('admin.committee.show');
     Route::post('/committee_update/{id}', [CommitteeController::class,'update'])->name('admin.committee.update');
     Route::post('/committee_delete/{id}', [CommitteeController::class,'destroy'])->name('admin.committee.destroy');
     Route::get('/committee_members/{id}', [CommitteeController::class,'committee_members'])->name('admin.committee.members');
     Route::post('/committee_add_members', [CommitteeController::class,'add_members'])->name('admin.committee.add_members');
     Route::post('/member_delete/{id}', [CommitteeController::class,'member_delete'])->name('admin.committee.dlt_member');

     Route::get('/pastconference', [PastConferenceController::class,'index'])->name('admin.pastconference');
     Route::get('/pastconference_create', [PastConferenceController::class,'create'])->name('admin.pastconference.create');
     Route::post('/pastconference_store', [PastConferenceController::class,'store'])->name('admin.pastconference.store');
     Route::get('/pastconference_edit/{id}', [PastConferenceController::class,'edit'])->name('admin.pastconference.edit');
     Route::get('/pastconference_show/{id}', [PastConferenceController::class,'show'])->name('admin.pastconference.show');
     Route::post('/pastconference_update/{id}', [PastConferenceController::class,'update'])->name('admin.pastconference.update');
     Route::post('/pastconference_delete/{id}', [PastConferenceController::class,'destroy'])->name('admin.pastconference.destroy');
     
     Route::get('/pastconference_images/{id}', [PastConferenceController::class,'pastconference_images'])->name('admin.pastconference.images');
     Route::post('/pastconference_add_images', [PastConferenceController::class,'add_images'])->name('admin.pastconference.add_images');
     Route::post('/pastconference_img_delete/{id}', [PastConferenceController::class,'gallery_img_delete'])->name('admin.pastconference.dlt_image');

     Route::get('/act_impacts', [ActImpactsController::class,'index'])->name('admin.act_impacts');
     Route::post('/act_impacts_update', [ActImpactsController::class,'update'])->name('admin.act_impacts.update');

     Route::get('/vc_condunt', [VcconduntController::class,'index'])->name('admin.vc_condunt');
     Route::post('/vc_condunt_update', [VcconduntController::class,'update'])->name('admin.vc_condunt.update');

     Route::get('/vision', [VisionController::class,'index'])->name('admin.vision');
     Route::post('/vision_update', [VisionController::class,'update'])->name('admin.vision.update');

     Route::get('/profile', [ProfileController::class,'profile'])->name('admin.profile');
     Route::post('/profile_update', [ProfileController::class,'update_profile'])->name('admin.profile.update');

     Route::get('/change_password', [ProfileController::class,'change_password'])->name('admin.change_password');
     Route::post('/password_update', [ProfileController::class,'update_password'])->name('admin.password.update');

     Route::get('/log_out', [ProfileController::class,'log_out'])->name('admin.log_out');

});