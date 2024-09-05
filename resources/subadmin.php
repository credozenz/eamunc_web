<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubAdmin\AuthController;
use App\Http\Controllers\SubAdmin\ForgotPasswordController;
use App\Http\Controllers\SubAdmin\DashbordController;
// use App\Http\Controllers\SubAdmin\NewsletterController;
// use App\Http\Controllers\SubAdmin\PresidentMessagesController;
// use App\Http\Controllers\SubAdmin\ProfileController;
// use App\Http\Controllers\SubAdmin\FacultiesMessagesController;
// use App\Http\Controllers\SubAdmin\MentorsController;
// use App\Http\Controllers\SubAdmin\GalleryController;
// use App\Http\Controllers\SubAdmin\LiveController;
// use App\Http\Controllers\SubAdmin\WorkMembersController;
// use App\Http\Controllers\SubAdmin\MembersController;
// use App\Http\Controllers\SubAdmin\HostSchoolController;
// use App\Http\Controllers\SubAdmin\ParticipateSchoolController;
// use App\Http\Controllers\SubAdmin\ActImpactsController;
// use App\Http\Controllers\SubAdmin\VcconduntController;
// use App\Http\Controllers\SubAdmin\VisionController;
// use App\Http\Controllers\SubAdmin\MissionController;
// use App\Http\Controllers\SubAdmin\LetterController;
// use App\Http\Controllers\SubAdmin\ScheduleConfController;
// use App\Http\Controllers\SubAdmin\ConferenceUpdatesController;
// use App\Http\Controllers\SubAdmin\BannerController;
// use App\Http\Controllers\SubAdmin\RulesController;
// use App\Http\Controllers\SubAdmin\AlumniController;
// use App\Http\Controllers\SubAdmin\AlumniNewsController;
// use App\Http\Controllers\SubAdmin\AlumniWebinarController;
// use App\Http\Controllers\SubAdmin\ImportantDateController;
// use App\Http\Controllers\SubAdmin\CommitteeController;
// use App\Http\Controllers\SubAdmin\PastConferenceController;
// use App\Http\Controllers\SubAdmin\TimerController;
// use App\Http\Controllers\SubAdmin\FooterController;
// use App\Http\Controllers\SubAdmin\FaqSchoolController;
// use App\Http\Controllers\SubAdmin\FeedbackController;
// use App\Http\Controllers\SubAdmin\BlocFormationController;
// use App\Http\Controllers\SubAdmin\StudentsController;
// use App\Http\Controllers\SubAdmin\SchoolsController;
// use App\Http\Controllers\SubAdmin\GuidelineController;
// use App\Http\Controllers\SubAdmin\LiabilityWaiverController;
// use App\Http\Controllers\SubAdmin\AlumniRegController;
// use App\Http\Controllers\SubAdmin\ExportExcelController;
// use App\Http\Controllers\SubAdmin\UsersController;
// use App\Http\Controllers\SubAdmin\CertificateController;
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

     Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');

Route::group(['middleware' => 'subadminchecker'], function() {
     
     Route::get('/dashbord', [DashbordController::class,'getDashbord'])->name('subadmin.dashbord');
     Route::get('/log_out', [DashbordController::class,'log_out'])->name('subadmin.log_out');

     // Route::get('/certificate',[CertificateController::class,'index'])->name('subadmin.certificate');
     // Route::post('/certificate_set',[CertificateController::class,'certificate_set'])->name('subadmin.certificate_set');
    
     Route::get('/newsletter', [NewsletterController::class,'index'])->name('subadmin.newsletter');
     Route::get('/newsletter_create', [NewsletterController::class,'create'])->name('subadmin.newsletter.create');
     Route::post('/newsletter_store', [NewsletterController::class,'store'])->name('subadmin.newsletter.store');
     Route::get('/newsletter_edit/{id}', [NewsletterController::class,'edit'])->name('subadmin.newsletter.edit');
     Route::get('/newsletter_show/{id}', [NewsletterController::class,'show'])->name('subadmin.newsletter.show');
     Route::post('/newsletter_update/{id}', [NewsletterController::class,'update'])->name('subadmin.newsletter.update');
     Route::post('/newsletter_delete/{id}', [NewsletterController::class,'destroy'])->name('subadmin.newsletter.destroy');

     Route::get('/president_messages', [PresidentMessagesController::class,'index'])->name('subadmin.president_messages');
     Route::post('/president_messages_update', [PresidentMessagesController::class,'update'])->name('subadmin.president_messages.update');

     Route::get('/liability_waiver_form', [LiabilityWaiverController::class,'index'])->name('subadmin.liability_waiver_form');
     Route::post('/liability_waiver_form_update', [LiabilityWaiverController::class,'update'])->name('subadmin.liability_waiver_form.update');


     Route::get('/rules', [RulesController::class,'index'])->name('subadmin.rules');
     Route::post('/rules_update', [RulesController::class,'update'])->name('subadmin.rules.update');

     Route::get('/alumni', [AlumniController::class,'index'])->name('subadmin.alumni');
     Route::post('/alumni_update', [AlumniController::class,'update'])->name('subadmin.alumni.update');

     Route::get('/alumninews', [AlumniNewsController::class,'index'])->name('subadmin.alumninews');
     Route::get('/alumninews_create', [AlumniNewsController::class,'create'])->name('subadmin.alumninews.create');
     Route::post('/alumninews_store', [AlumniNewsController::class,'store'])->name('subadmin.alumninews.store');
     Route::get('/alumninews_edit/{id}', [AlumniNewsController::class,'edit'])->name('subadmin.alumninews.edit');
     Route::get('/alumninews_show/{id}', [AlumniNewsController::class,'show'])->name('subadmin.alumninews.show');
     Route::post('/alumninews_update/{id}', [AlumniNewsController::class,'update'])->name('subadmin.alumninews.update');
     Route::post('/alumninews_delete/{id}', [AlumniNewsController::class,'destroy'])->name('subadmin.alumninews.destroy');
     Route::post('/alumninews_archive/{id}', [AlumniNewsController::class,'archive'])->name('subadmin.alumninews.archive');


     Route::get('/alumniwebinar', [AlumniWebinarController::class,'index'])->name('subadmin.alumniwebinar');
     Route::get('/alumniwebinar_create', [AlumniWebinarController::class,'create'])->name('subadmin.alumniwebinar.create');
     Route::post('/alumniwebinar_store', [AlumniWebinarController::class,'store'])->name('subadmin.alumniwebinar.store');
     Route::get('/alumniwebinar_edit/{id}', [AlumniWebinarController::class,'edit'])->name('subadmin.alumniwebinar.edit');
     Route::get('/alumniwebinar_show/{id}', [AlumniWebinarController::class,'show'])->name('subadmin.alumniwebinar.show');
     Route::post('/alumniwebinar_update/{id}', [AlumniWebinarController::class,'update'])->name('subadmin.alumniwebinar.update');
     Route::post('/alumniwebinar_delete/{id}', [AlumniWebinarController::class,'destroy'])->name('subadmin.alumniwebinar.destroy');
     Route::post('/alumniwebinar_archive/{id}', [AlumniWebinarController::class,'archive'])->name('subadmin.alumniwebinar.archive');



     Route::get('/importantdate', [ImportantDateController::class,'index'])->name('subadmin.importantdate');
     Route::get('/importantdate_create', [ImportantDateController::class,'create'])->name('subadmin.importantdate.create');
     Route::post('/importantdate_store', [ImportantDateController::class,'store'])->name('subadmin.importantdate.store');
     Route::get('/importantdate_edit/{id}', [ImportantDateController::class,'edit'])->name('subadmin.importantdate.edit');
     Route::get('/importantdate_show/{id}', [ImportantDateController::class,'show'])->name('subadmin.importantdate.show');
     Route::post('/importantdate_update/{id}', [ImportantDateController::class,'update'])->name('subadmin.importantdate.update');
     Route::post('/importantdate_delete/{id}', [ImportantDateController::class,'destroy'])->name('subadmin.importantdate.destroy');

     Route::get('/banner', [BannerController::class,'index'])->name('subadmin.banner');
     Route::get('/banner_create', [BannerController::class,'create'])->name('subadmin.banner.create');
     Route::post('/banner_store', [BannerController::class,'store'])->name('subadmin.banner.store');
     Route::get('/banner_edit/{id}', [BannerController::class,'edit'])->name('subadmin.banner.edit');
     Route::get('/banner_show/{id}', [BannerController::class,'show'])->name('subadmin.banner.show');
     Route::post('/banner_update/{id}', [BannerController::class,'update'])->name('subadmin.banner.update');
     Route::post('/banner_delete/{id}', [BannerController::class,'destroy'])->name('subadmin.banner.destroy');
     
     Route::get('/facultiesmessages', [FacultiesMessagesController::class,'index'])->name('subadmin.facultiesmessages');
     Route::get('/facultiesmessages_create', [FacultiesMessagesController::class,'create'])->name('subadmin.facultiesmessages.create');
     Route::post('/facultiesmessages_store', [FacultiesMessagesController::class,'store'])->name('subadmin.facultiesmessages.store');
     Route::get('/facultiesmessages_edit/{id}', [FacultiesMessagesController::class,'edit'])->name('subadmin.facultiesmessages.edit');
     Route::get('/facultiesmessages_show/{id}', [FacultiesMessagesController::class,'show'])->name('subadmin.facultiesmessages.show');
     Route::post('/facultiesmessages_update/{id}', [FacultiesMessagesController::class,'update'])->name('subadmin.facultiesmessages.update');
     Route::post('/facultiesmessages_delete/{id}', [FacultiesMessagesController::class,'destroy'])->name('subadmin.facultiesmessages.destroy');
     
     Route::get('/our_mentors', [MentorsController::class,'index'])->name('subadmin.our_mentors');
     Route::get('/our_mentors_create', [MentorsController::class,'create'])->name('subadmin.our_mentors.create');
     Route::post('/our_mentors_store', [MentorsController::class,'store'])->name('subadmin.our_mentors.store');
     Route::get('/our_mentors_edit/{id}', [MentorsController::class,'edit'])->name('subadmin.our_mentors.edit');
     Route::get('/our_mentors_show/{id}', [MentorsController::class,'show'])->name('subadmin.our_mentors.show');
     Route::post('/our_mentors_update/{id}', [MentorsController::class,'update'])->name('subadmin.our_mentors.update');
     Route::post('/our_mentors_delete/{id}', [MentorsController::class,'destroy'])->name('subadmin.our_mentors.destroy');

     Route::get('/gallery', [GalleryController::class,'index'])->name('subadmin.gallery');
     Route::get('/gallery_create', [GalleryController::class,'create'])->name('subadmin.gallery.create');
     Route::post('/gallery_store', [GalleryController::class,'store'])->name('subadmin.gallery.store');
     Route::get('/gallery_edit/{id}', [GalleryController::class,'edit'])->name('subadmin.gallery.edit');
     Route::get('/gallery_show/{id}', [GalleryController::class,'show'])->name('subadmin.gallery.show');
     Route::get('/gallery_images/{id}', [GalleryController::class,'gallery_images'])->name('subadmin.gallery.images');
     Route::post('/gallery_add_images', [GalleryController::class,'add_images'])->name('subadmin.gallery.add_images');
     Route::post('/gallery_add_video', [GalleryController::class,'add_video'])->name('subadmin.gallery.add_video');
     Route::post('/gallery_update/{id}', [GalleryController::class,'update'])->name('subadmin.gallery.update');
     Route::post('/gallery_delete/{id}', [GalleryController::class,'destroy'])->name('subadmin.gallery.destroy');
     Route::post('/gallery_img_delete/{id}', [GalleryController::class,'gallery_img_delete'])->name('subadmin.gallery.dlt_images');

     Route::get('/live', [LiveController::class,'index'])->name('subadmin.live');
     Route::post('/live_update', [LiveController::class,'update'])->name('subadmin.live.update');

     Route::get('/timer', [TimerController::class,'index'])->name('subadmin.timer');
     Route::post('/timer_update', [TimerController::class,'update'])->name('subadmin.timer.update');

     Route::get('/work_members', [WorkMembersController::class,'index'])->name('subadmin.work_members');
     Route::get('/work_members_create', [WorkMembersController::class,'create'])->name('subadmin.work_members.create');
     Route::post('/work_members_store', [WorkMembersController::class,'store'])->name('subadmin.work_members.store');
     Route::get('/work_members_edit/{id}', [WorkMembersController::class,'edit'])->name('subadmin.work_members.edit');
     Route::get('/work_members_show/{id}', [WorkMembersController::class,'show'])->name('subadmin.work_members.show');
     Route::post('/work_members_update/{id}', [WorkMembersController::class,'update'])->name('subadmin.work_members.update');
     Route::post('/work_members_delete/{id}', [WorkMembersController::class,'destroy'])->name('subadmin.work_members.destroy');

     Route::get('/host_schools', [HostSchoolController::class,'index'])->name('subadmin.host_schools');
     Route::get('/host_schools_create', [HostSchoolController::class,'create'])->name('subadmin.host_schools.create');
     Route::post('/host_schools_store', [HostSchoolController::class,'store'])->name('subadmin.host_schools.store');
     Route::get('/host_schools_edit/{id}', [HostSchoolController::class,'edit'])->name('subadmin.host_schools.edit');
     Route::get('/host_schools_show/{id}', [HostSchoolController::class,'show'])->name('subadmin.host_schools.show');
     Route::post('/host_schools_update/{id}', [HostSchoolController::class,'update'])->name('subadmin.host_schools.update');
     Route::post('/host_schools_delete/{id}', [HostSchoolController::class,'destroy'])->name('subadmin.host_schools.destroy');

     Route::get('/participate_schools', [ParticipateSchoolController::class,'index'])->name('subadmin.participate_schools');
     Route::get('/participate_schools_create', [ParticipateSchoolController::class,'create'])->name('subadmin.participate_schools.create');
     Route::post('/participate_schools_store', [ParticipateSchoolController::class,'store'])->name('subadmin.participate_schools.store');
     Route::get('/participate_schools_edit/{id}', [ParticipateSchoolController::class,'edit'])->name('subadmin.participate_schools.edit');
     Route::get('/participate_schools_show/{id}', [ParticipateSchoolController::class,'show'])->name('subadmin.participate_schools.show');
     Route::post('/participate_schools_update/{id}', [ParticipateSchoolController::class,'update'])->name('subadmin.participate_schools.update');
     Route::post('/participate_schools_delete/{id}', [ParticipateSchoolController::class,'destroy'])->name('subadmin.participate_schools.destroy');


     Route::get('/faculty_advisors', [SchoolsController::class,'faculty_advisors'])->name('subadmin.faculty_advisors');
     Route::get('/faculty_advisors_export', [SchoolsController::class,'faculty_advisors_export'])->name('subadmin.faculty_advisors_export');


     Route::get('/letters', [LetterController::class,'index'])->name('subadmin.letters');
     Route::get('/letters_create', [LetterController::class,'create'])->name('subadmin.letters.create');
     Route::post('/letters_store', [LetterController::class,'store'])->name('subadmin.letters.store');
     Route::get('/letters_edit/{id}', [LetterController::class,'edit'])->name('subadmin.letters.edit');
     Route::get('/letters_show/{id}', [LetterController::class,'show'])->name('subadmin.letters.show');
     Route::post('/letters_update/{id}', [LetterController::class,'update'])->name('subadmin.letters.update');
     Route::post('/letters_delete/{id}', [LetterController::class,'destroy'])->name('subadmin.letters.destroy');

     Route::get('/conference_schedule', [ScheduleConfController::class,'index'])->name('subadmin.conference_schedule');
     Route::get('/conference_schedule_create', [ScheduleConfController::class,'create'])->name('subadmin.conference_schedule.create');
     Route::post('/conference_schedule_store', [ScheduleConfController::class,'store'])->name('subadmin.conference_schedule.store');
     Route::get('/conference_schedule_edit/{id}', [ScheduleConfController::class,'edit'])->name('subadmin.conference_schedule.edit');
     Route::get('/conference_schedule_show/{id}', [ScheduleConfController::class,'show'])->name('subadmin.conference_schedule.show');
     Route::post('/conference_schedule_update/{id}', [ScheduleConfController::class,'update'])->name('subadmin.conference_schedule.update');
     Route::post('/conference_schedule_delete/{id}', [ScheduleConfController::class,'destroy'])->name('subadmin.conference_schedule.destroy');
     Route::post('/conference_schedule_note', [ScheduleConfController::class,'note'])->name('subadmin.conference_schedule_note.note');

     Route::get('/conference_updates', [ConferenceUpdatesController::class,'index'])->name('subadmin.conference_updates');
     Route::get('/conference_updates_create', [ConferenceUpdatesController::class,'create'])->name('subadmin.conference_updates.create');
     Route::post('/conference_updates_store', [ConferenceUpdatesController::class,'store'])->name('subadmin.conference_updates.store');
     Route::get('/conference_updates_edit/{id}', [ConferenceUpdatesController::class,'edit'])->name('subadmin.conference_updates.edit');
     Route::get('/conference_updates_show/{id}', [ConferenceUpdatesController::class,'show'])->name('subadmin.conference_updates.show');
     Route::post('/conference_updates_update/{id}', [ConferenceUpdatesController::class,'update'])->name('subadmin.conference_updates.update');
     Route::post('/conference_updates_delete/{id}', [ConferenceUpdatesController::class,'destroy'])->name('subadmin.conference_updates.destroy');
     
     Route::get('/committee', [CommitteeController::class,'index'])->name('subadmin.committee');
     Route::get('/committee_create', [CommitteeController::class,'create'])->name('subadmin.committee.create');
     Route::post('/committee_store', [CommitteeController::class,'store'])->name('subadmin.committee.store');
     Route::get('/committee_edit/{id}', [CommitteeController::class,'edit'])->name('subadmin.committee.edit');
     Route::get('/committee_show/{id}', [CommitteeController::class,'show'])->name('subadmin.committee.show');
     Route::post('/committee_update/{id}', [CommitteeController::class,'update'])->name('subadmin.committee.update');
     Route::post('/committee_delete/{id}', [CommitteeController::class,'destroy'])->name('subadmin.committee.destroy');
     Route::post('/committee_file_delete/{id}', [CommitteeController::class,'file_destroy'])->name('subadmin.committee.file_destroy');

     Route::get('/press_corp', [CommitteeController::class,'press_corp'])->name('subadmin.committee.press_corp');
     Route::post('/press_corp_update', [CommitteeController::class,'press_corp_update'])->name('subadmin.committee.press_corp_update');
     Route::get('/press_corp_member', [CommitteeController::class,'press_corp_member'])->name('subadmin.committee.press_corp_member');
     Route::post('/press_corp_addmember', [CommitteeController::class,'press_corp_addmember'])->name('subadmin.committee.press_corp_addmember');
     Route::get('/press_corp_member_dlt/{id}', [CommitteeController::class,'press_corp_member_dlt'])->name('subadmin.committee.press_corp_member_dlt');
     Route::get('/press_corp_dlt/{id}', [CommitteeController::class,'press_corp_dlt'])->name('subadmin.committee.press_corp_dlt');

     Route::get('/users', [UsersController::class,'index'])->name('subadmin.users');
     Route::get('/users_create', [UsersController::class,'create'])->name('subadmin.users.create');
     Route::post('/users_store', [UsersController::class,'store'])->name('subadmin.users.store');
     Route::get('/users_edit/{id}', [UsersController::class,'edit'])->name('subadmin.users.edit');
     Route::get('/users_show/{id}', [UsersController::class,'show'])->name('subadmin.users.show');
     Route::post('/users_update/{id}', [UsersController::class,'update'])->name('subadmin.users.update');
     Route::post('/users_delete/{id}', [UsersController::class,'destroy'])->name('subadmin.users.destroy');
     Route::post('/users_file_delete/{id}', [UsersController::class,'file_destroy'])->name('subadmin.users.file_destroy');



     Route::get('/blocformation/{id}', [BlocFormationController::class,'index'])->name('subadmin.blocformation');
     Route::get('/blocformation_create/{id}', [BlocFormationController::class,'create'])->name('subadmin.blocformation.create');
     Route::post('/blocformation_store', [BlocFormationController::class,'store'])->name('subadmin.blocformation_store');
     Route::get('/blocformation_show/{id}', [BlocFormationController::class,'show'])->name('subadmin.blocformation_show');
     Route::get('/blocformation_edit/{id}', [BlocFormationController::class,'edit'])->name('subadmin.blocformation_edit');
     Route::post('/blocformation_update/{id}', [BlocFormationController::class,'update'])->name('subadmin.blocformation_update');
     Route::post('/blocformation_delete/{id}', [BlocFormationController::class,'delete'])->name('subadmin.blocformation_delete');
     
     Route::get('/pastconference', [PastConferenceController::class,'index'])->name('subadmin.pastconference');
     Route::get('/pastconference_create', [PastConferenceController::class,'create'])->name('subadmin.pastconference.create');
     Route::post('/pastconference_store', [PastConferenceController::class,'store'])->name('subadmin.pastconference.store');
     Route::get('/pastconference_edit/{id}', [PastConferenceController::class,'edit'])->name('subadmin.pastconference.edit');
     Route::get('/pastconference_show/{id}', [PastConferenceController::class,'show'])->name('subadmin.pastconference.show');
     Route::post('/pastconference_update/{id}', [PastConferenceController::class,'update'])->name('subadmin.pastconference.update');
     Route::post('/pastconference_delete/{id}', [PastConferenceController::class,'destroy'])->name('subadmin.pastconference.destroy');
     
     Route::get('/pastconference_images/{id}', [PastConferenceController::class,'pastconference_images'])->name('subadmin.pastconference.images');
     Route::get('/pastconference_files/{id}', [PastConferenceController::class,'pastconference_files'])->name('subadmin.pastconference.files');
     Route::post('/pastconference_add_images', [PastConferenceController::class,'add_images'])->name('subadmin.pastconference.add_images');
     Route::post('/pastconference_add_files', [PastConferenceController::class,'add_files'])->name('subadmin.pastconference.add_files');
     Route::post('/pastconference_img_delete/{id}', [PastConferenceController::class,'gallery_img_delete'])->name('subadmin.pastconference.dlt_image');
     Route::post('/pastconference_file_delete/{id}', [PastConferenceController::class,'gallery_file_delete'])->name('subadmin.pastconference.dlt_file');

     Route::get('/act_impacts', [ActImpactsController::class,'index'])->name('subadmin.act_impacts');
     Route::post('/act_impacts_update', [ActImpactsController::class,'update'])->name('subadmin.act_impacts.update');

     Route::get('/vc_condunt', [VcconduntController::class,'index'])->name('subadmin.vc_condunt');
     Route::post('/vc_condunt_update', [VcconduntController::class,'update'])->name('subadmin.vc_condunt.update');

     Route::get('/vision', [VisionController::class,'index'])->name('subadmin.vision');
     Route::post('/vision_update', [VisionController::class,'update'])->name('subadmin.vision.update');

     Route::get('/mission', [MissionController::class,'index'])->name('subadmin.mission');
     Route::post('/mission_update', [MissionController::class,'update'])->name('subadmin.mission.update');

     Route::get('/profile', [ProfileController::class,'profile'])->name('subadmin.profile');
     Route::post('/profile_update', [ProfileController::class,'update_profile'])->name('subadmin.profile.update');

     Route::get('/change_password', [ProfileController::class,'change_password'])->name('subadmin.change_password');
     Route::post('/password_update', [ProfileController::class,'update_password'])->name('subadmin.password.update');

     Route::get('/faq', [FaqSchoolController::class,'index'])->name('subadmin.faq');
     Route::get('/faq_create', [FaqSchoolController::class,'create'])->name('subadmin.faq.create');
     Route::post('/faq_store', [FaqSchoolController::class,'store'])->name('subadmin.faq.store');
     Route::get('/faq_edit/{id}', [FaqSchoolController::class,'edit'])->name('subadmin.faq.edit');
     Route::get('/faq_show/{id}', [FaqSchoolController::class,'show'])->name('subadmin.faq.show');
     Route::post('/faq_update/{id}', [FaqSchoolController::class,'update'])->name('subadmin.faq.update');
     Route::post('/faq_delete/{id}', [FaqSchoolController::class,'destroy'])->name('subadmin.faq.destroy');

     Route::get('/feedback', [FeedbackController::class,'index'])->name('subadmin.feedback');
     Route::get('/feedback_create', [FeedbackController::class,'create'])->name('subadmin.feedback.create');
     Route::post('/feedback_store', [FeedbackController::class,'store'])->name('subadmin.feedback.store');
     Route::get('/feedback_edit/{id}', [FeedbackController::class,'edit'])->name('subadmin.feedback.edit');
     Route::post('/feedback_update/{id}', [FeedbackController::class,'update'])->name('subadmin.feedback.update');
     Route::post('/feedback_delete/{id}', [FeedbackController::class,'destroy'])->name('subadmin.feedback.destroy');

     Route::get('/user_feedback', [FeedbackController::class,'feedback'])->name('subadmin.user_feedback');
     Route::get('/user_feedback_show/{id}', [FeedbackController::class,'feedback_show'])->name('subadmin.user_feedback.show');
     Route::post('/user_feedback_delete/{id}', [FeedbackController::class,'feedback_destroy'])->name('subadmin.feedback.feedback_destroy');

     Route::get('/terms', [FooterController::class,'terms'])->name('subadmin.terms');
     Route::post('/terms_update', [FooterController::class,'terms_update'])->name('subadmin.terms_update');

     Route::get('/privacy_policy', [FooterController::class,'privacy_policy'])->name('subadmin.privacy_policy');
     Route::post('/privacy_policy_update', [FooterController::class,'privacy_policy_update'])->name('subadmin.privacy_policy_update');





     Route::post('/committee_excelexport/{id}', [ExportExcelController::class,'committee_excelexport'])->name('subadmin.committee_excelexport');
     Route::post('/faculty_advisorsexport', [ExportExcelController::class,'faculty_advisorsexport'])->name('subadmin.faculty_advisorsexport');

     Route::post('/students_export', [ExportExcelController::class,'students_export'])->name('subadmin.students_export');



     Route::get('/alumni_registration', [AlumniRegController::class,'index'])->name('subadmin.alumni_registration');

     Route::get('/certificate_design', [CertificateController::class,'index'])->name('subadmin.certificate_design');
     Route::post('/certificate_input_store', [CertificateController::class,'store'])->name('subadmin.certificate_input.store');
     Route::post('/certificate_input_delete/{id}', [CertificateController::class,'destroy'])->name('subadmin.certificate_input.destroy');
     
     Route::get('/certificate_show', [CertificateController::class,'show'])->name('subadmin.certificate_show');
     Route::post('/certificate_design_store/{id}', [CertificateController::class,'update'])->name('subadmin.certificate_design.store');

     Route::get('/students', [StudentsController::class,'index'])->name('subadmin.students');
     Route::get('/student_show/{id}', [StudentsController::class,'show'])->name('subadmin.student.show'); 
     Route::get('/student_edit/{id}', [StudentsController::class,'edit'])->name('subadmin.student.edit');
     Route::post('/student_update/{id}', [StudentsController::class,'update'])->name('subadmin.student.update');
     Route::post('/student_delete/{id}', [StudentsController::class,'destroy'])->name('subadmin.student.destroy');
     Route::post('/student_statuschange/{id}', [StudentsController::class,'status_change'])->name('subadmin.student.statuschange');
     

     Route::get('/student_password/{id}', [StudentsController::class,'change_password'])->name('subadmin.student_password');
     Route::post('/student_pwd_update/{id}', [StudentsController::class,'update_password'])->name('subadmin.student_pwd_update');

     Route::post('/student_certificate/{id}', [StudentsController::class,'student_certificate'])->name('subadmin.student_certificate');

     Route::post('/student_bulk_certi', [StudentsController::class,'student_bulk_certi'])->name('subadmin.student_bulk_certi');

     Route::get('/invite_student/{id}', [StudentsController::class,'invite_student'])->name('subadmin.student.invitestudent');
     Route::post('/student_bulk_invite', [StudentsController::class,'student_bulk_invite'])->name('subadmin.student_bulk_invite');
    
     Route::get('/committee_bureau/{id}', [CommitteeController::class,'committee_bureau'])->name('subadmin.committee.bureau');
     
     // Route::post('/committee_add_bureau', [CommitteeController::class,'add_bureau'])->name('subadmin.committee.add_bureau');
     // Route::post('/committee_dlt_bureau/{id}', [CommitteeController::class,'delete_bureau'])->name('subadmin.committee.dlt_bureau');
     
     Route::get('/committee_delegate/{id}', [CommitteeController::class,'committee_delegate'])->name('subadmin.committee.delegate');
     Route::post('/committee_country', [CommitteeController::class,'committee_country'])->name('subadmin.committee.committee_country');
     
     // Route::post('/committee_add_delegate', [CommitteeController::class,'add_delegate'])->name('subadmin.committee.add_delegate');
     // Route::post('/committee_dlt_delegate/{id}', [CommitteeController::class,'delete_delegate'])->name('subadmin.committee.dlt_delegate');
     // Route::post('/committee_get_delegate', [CommitteeController::class,'get_delegate'])->name('subadmin.committee.get_delegate');
    

     Route::get('/schools', [SchoolsController::class,'index'])->name('subadmin.schools');
     Route::get('/school_edit/{id}', [SchoolsController::class,'edit'])->name('subadmin.school.edit');
     Route::get('/school_show/{id}', [SchoolsController::class,'show'])->name('subadmin.school.show');
     Route::post('/school_update/{id}', [SchoolsController::class,'update'])->name('subadmin.school.update');
     Route::post('/school_delete/{id}', [SchoolsController::class,'destroy'])->name('subadmin.school.destroy');

     Route::get('/guideline', [GuidelineController::class,'index'])->name('subadmin.guideline');
     Route::post('/guideline_update', [GuidelineController::class,'update'])->name('subadmin.guideline.update');


});