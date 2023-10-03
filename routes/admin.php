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
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\HostSchoolController;
use App\Http\Controllers\Admin\ParticipateSchoolController;
use App\Http\Controllers\Admin\ActImpactsController;
use App\Http\Controllers\Admin\VcconduntController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\ScheduleConfController;
use App\Http\Controllers\Admin\ConferenceUpdatesController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\RulesController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\AlumniNewsController;
use App\Http\Controllers\Admin\AlumniWebinarController;
use App\Http\Controllers\Admin\ImportantDateController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\PastConferenceController;
use App\Http\Controllers\Admin\TimerController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\FaqSchoolController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\BlocFormationController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\SchoolsController;
use App\Http\Controllers\Admin\GuidelineController;
use App\Http\Controllers\Admin\LiabilityWaiverController;
use App\Http\Controllers\Admin\AlumniRegController;
use App\Http\Controllers\Admin\ExportExcelController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CertificateController;
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

Route::group(['middleware' => 'adminchecker'], function() {
     
     Route::get('/dashbord', [DashbordController::class,'getDashbord'])->name('admin.dashbord');
     Route::post('/reg_status', [DashbordController::class,'reg_status'])->name('admin.reg_status');

     // Route::get('/certificate',[CertificateController::class,'index'])->name('admin.certificate');
     // Route::post('/certificate_set',[CertificateController::class,'certificate_set'])->name('admin.certificate_set');
    
     Route::get('/newsletter', [NewsletterController::class,'index'])->name('admin.newsletter');
     Route::get('/newsletter_create', [NewsletterController::class,'create'])->name('admin.newsletter.create');
     Route::post('/newsletter_store', [NewsletterController::class,'store'])->name('admin.newsletter.store');
     Route::get('/newsletter_edit/{id}', [NewsletterController::class,'edit'])->name('admin.newsletter.edit');
     Route::get('/newsletter_show/{id}', [NewsletterController::class,'show'])->name('admin.newsletter.show');
     Route::post('/newsletter_update/{id}', [NewsletterController::class,'update'])->name('admin.newsletter.update');
     Route::post('/newsletter_delete/{id}', [NewsletterController::class,'destroy'])->name('admin.newsletter.destroy');

     Route::get('/president_messages', [PresidentMessagesController::class,'index'])->name('admin.president_messages');
     Route::post('/president_messages_update', [PresidentMessagesController::class,'update'])->name('admin.president_messages.update');

     Route::get('/liability_waiver_form', [LiabilityWaiverController::class,'index'])->name('admin.liability_waiver_form');
     Route::post('/liability_waiver_form_update', [LiabilityWaiverController::class,'update'])->name('admin.liability_waiver_form.update');


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
     Route::post('/alumninews_archive/{id}', [AlumniNewsController::class,'archive'])->name('admin.alumninews.archive');


     Route::get('/alumniwebinar', [AlumniWebinarController::class,'index'])->name('admin.alumniwebinar');
     Route::get('/alumniwebinar_create', [AlumniWebinarController::class,'create'])->name('admin.alumniwebinar.create');
     Route::post('/alumniwebinar_store', [AlumniWebinarController::class,'store'])->name('admin.alumniwebinar.store');
     Route::get('/alumniwebinar_edit/{id}', [AlumniWebinarController::class,'edit'])->name('admin.alumniwebinar.edit');
     Route::get('/alumniwebinar_show/{id}', [AlumniWebinarController::class,'show'])->name('admin.alumniwebinar.show');
     Route::post('/alumniwebinar_update/{id}', [AlumniWebinarController::class,'update'])->name('admin.alumniwebinar.update');
     Route::post('/alumniwebinar_delete/{id}', [AlumniWebinarController::class,'destroy'])->name('admin.alumniwebinar.destroy');
     Route::post('/alumniwebinar_archive/{id}', [AlumniWebinarController::class,'archive'])->name('admin.alumniwebinar.archive');



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
     Route::post('/gallery_add_video', [GalleryController::class,'add_video'])->name('admin.gallery.add_video');
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

     Route::get('/participate_schools', [ParticipateSchoolController::class,'index'])->name('admin.participate_schools');
     Route::get('/participate_schools_create', [ParticipateSchoolController::class,'create'])->name('admin.participate_schools.create');
     Route::post('/participate_schools_store', [ParticipateSchoolController::class,'store'])->name('admin.participate_schools.store');
     Route::get('/participate_schools_edit/{id}', [ParticipateSchoolController::class,'edit'])->name('admin.participate_schools.edit');
     Route::get('/participate_schools_show/{id}', [ParticipateSchoolController::class,'show'])->name('admin.participate_schools.show');
     Route::post('/participate_schools_update/{id}', [ParticipateSchoolController::class,'update'])->name('admin.participate_schools.update');
     Route::post('/participate_schools_delete/{id}', [ParticipateSchoolController::class,'destroy'])->name('admin.participate_schools.destroy');


     Route::get('/faculty_advisors', [SchoolsController::class,'faculty_advisors'])->name('admin.faculty_advisors');
     Route::get('/faculty_advisors_export', [SchoolsController::class,'faculty_advisors_export'])->name('admin.faculty_advisors_export');


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
     Route::post('/conference_schedule_note', [ScheduleConfController::class,'note'])->name('admin.conference_schedule_note.note');

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
     Route::post('/committee_file_delete/{id}', [CommitteeController::class,'file_destroy'])->name('admin.committee.file_destroy');
    

     Route::get('/users', [UsersController::class,'index'])->name('admin.users');
     Route::get('/users_create', [UsersController::class,'create'])->name('admin.users.create');
     Route::post('/users_store', [UsersController::class,'store'])->name('admin.users.store');
     Route::get('/users_edit/{id}', [UsersController::class,'edit'])->name('admin.users.edit');
     Route::get('/users_show/{id}', [UsersController::class,'show'])->name('admin.users.show');
     Route::post('/users_update/{id}', [UsersController::class,'update'])->name('admin.users.update');
     Route::post('/users_delete/{id}', [UsersController::class,'destroy'])->name('admin.users.destroy');
     Route::post('/users_file_delete/{id}', [UsersController::class,'file_destroy'])->name('admin.users.file_destroy');



     Route::get('/blocformation/{id}', [BlocFormationController::class,'index'])->name('admin.blocformation');
     Route::get('/blocformation_create/{id}', [BlocFormationController::class,'create'])->name('admin.blocformation.create');
     Route::post('/blocformation_store', [BlocFormationController::class,'store'])->name('admin.blocformation_store');
     Route::get('/blocformation_show/{id}', [BlocFormationController::class,'show'])->name('admin.blocformation_show');
     Route::get('/blocformation_edit/{id}', [BlocFormationController::class,'edit'])->name('admin.blocformation_edit');
     Route::post('/blocformation_update/{id}', [BlocFormationController::class,'update'])->name('admin.blocformation_update');
     Route::post('/blocformation_delete/{id}', [BlocFormationController::class,'delete'])->name('admin.blocformation_delete');
     
     Route::get('/pastconference', [PastConferenceController::class,'index'])->name('admin.pastconference');
     Route::get('/pastconference_create', [PastConferenceController::class,'create'])->name('admin.pastconference.create');
     Route::post('/pastconference_store', [PastConferenceController::class,'store'])->name('admin.pastconference.store');
     Route::get('/pastconference_edit/{id}', [PastConferenceController::class,'edit'])->name('admin.pastconference.edit');
     Route::get('/pastconference_show/{id}', [PastConferenceController::class,'show'])->name('admin.pastconference.show');
     Route::post('/pastconference_update/{id}', [PastConferenceController::class,'update'])->name('admin.pastconference.update');
     Route::post('/pastconference_delete/{id}', [PastConferenceController::class,'destroy'])->name('admin.pastconference.destroy');
     
     Route::get('/pastconference_images/{id}', [PastConferenceController::class,'pastconference_images'])->name('admin.pastconference.images');
     Route::get('/pastconference_files/{id}', [PastConferenceController::class,'pastconference_files'])->name('admin.pastconference.files');
     Route::post('/pastconference_add_images', [PastConferenceController::class,'add_images'])->name('admin.pastconference.add_images');
     Route::post('/pastconference_add_files', [PastConferenceController::class,'add_files'])->name('admin.pastconference.add_files');
     Route::post('/pastconference_img_delete/{id}', [PastConferenceController::class,'gallery_img_delete'])->name('admin.pastconference.dlt_image');
     Route::post('/pastconference_file_delete/{id}', [PastConferenceController::class,'gallery_file_delete'])->name('admin.pastconference.dlt_file');

     Route::get('/act_impacts', [ActImpactsController::class,'index'])->name('admin.act_impacts');
     Route::post('/act_impacts_update', [ActImpactsController::class,'update'])->name('admin.act_impacts.update');

     Route::get('/vc_condunt', [VcconduntController::class,'index'])->name('admin.vc_condunt');
     Route::post('/vc_condunt_update', [VcconduntController::class,'update'])->name('admin.vc_condunt.update');

     Route::get('/vision', [VisionController::class,'index'])->name('admin.vision');
     Route::post('/vision_update', [VisionController::class,'update'])->name('admin.vision.update');

     Route::get('/mission', [MissionController::class,'index'])->name('admin.mission');
     Route::post('/mission_update', [MissionController::class,'update'])->name('admin.mission.update');

     Route::get('/profile', [ProfileController::class,'profile'])->name('admin.profile');
     Route::post('/profile_update', [ProfileController::class,'update_profile'])->name('admin.profile.update');

     Route::get('/change_password', [ProfileController::class,'change_password'])->name('admin.change_password');
     Route::post('/password_update', [ProfileController::class,'update_password'])->name('admin.password.update');

     Route::get('/faq', [FaqSchoolController::class,'index'])->name('admin.faq');
     Route::get('/faq_create', [FaqSchoolController::class,'create'])->name('admin.faq.create');
     Route::post('/faq_store', [FaqSchoolController::class,'store'])->name('admin.faq.store');
     Route::get('/faq_edit/{id}', [FaqSchoolController::class,'edit'])->name('admin.faq.edit');
     Route::get('/faq_show/{id}', [FaqSchoolController::class,'show'])->name('admin.faq.show');
     Route::post('/faq_update/{id}', [FaqSchoolController::class,'update'])->name('admin.faq.update');
     Route::post('/faq_delete/{id}', [FaqSchoolController::class,'destroy'])->name('admin.faq.destroy');

     Route::get('/feedback', [FeedbackController::class,'index'])->name('admin.feedback');
     Route::get('/feedback_create', [FeedbackController::class,'create'])->name('admin.feedback.create');
     Route::post('/feedback_store', [FeedbackController::class,'store'])->name('admin.feedback.store');
     Route::get('/feedback_edit/{id}', [FeedbackController::class,'edit'])->name('admin.feedback.edit');
     Route::post('/feedback_update/{id}', [FeedbackController::class,'update'])->name('admin.feedback.update');
     Route::post('/feedback_delete/{id}', [FeedbackController::class,'destroy'])->name('admin.feedback.destroy');

     Route::get('/user_feedback', [FeedbackController::class,'feedback'])->name('admin.user_feedback');
     Route::get('/user_feedback_show/{id}', [FeedbackController::class,'feedback_show'])->name('admin.user_feedback.show');
     Route::post('/user_feedback_delete/{id}', [FeedbackController::class,'feedback_destroy'])->name('admin.feedback.feedback_destroy');

     Route::get('/terms', [FooterController::class,'terms'])->name('admin.terms');
     Route::post('/terms_update', [FooterController::class,'terms_update'])->name('admin.terms_update');

     Route::get('/privacy_policy', [FooterController::class,'privacy_policy'])->name('admin.privacy_policy');
     Route::post('/privacy_policy_update', [FooterController::class,'privacy_policy_update'])->name('admin.privacy_policy_update');

     Route::get('/log_out', [ProfileController::class,'log_out'])->name('admin.log_out');



     Route::post('/committee_excelexport/{id}', [ExportExcelController::class,'committee_excelexport'])->name('admin.committee_excelexport');
     Route::post('/faculty_advisorsexport', [ExportExcelController::class,'faculty_advisorsexport'])->name('admin.faculty_advisorsexport');

     Route::post('/students_export', [ExportExcelController::class,'students_export'])->name('admin.students_export');



     Route::get('/alumni_registration', [AlumniRegController::class,'index'])->name('admin.alumni_registration');

     Route::get('/certificate_design', [CertificateController::class,'index'])->name('admin.certificate_design');
     Route::post('/certificate_input_store', [CertificateController::class,'store'])->name('admin.certificate_input.store');
     Route::post('/certificate_input_delete/{id}', [CertificateController::class,'destroy'])->name('admin.certificate_input.destroy');
     
     Route::get('/certificate_show', [CertificateController::class,'show'])->name('admin.certificate_show');
     Route::post('/certificate_design_store/{id}', [CertificateController::class,'update'])->name('admin.certificate_design.store');

     Route::get('/students', [StudentsController::class,'index'])->name('admin.students');
     Route::get('/student_show/{id}', [StudentsController::class,'show'])->name('admin.student.show'); 
     Route::get('/student_edit/{id}', [StudentsController::class,'edit'])->name('admin.student.edit');
     Route::post('/student_update/{id}', [StudentsController::class,'update'])->name('admin.student.update');
     Route::post('/student_delete/{id}', [StudentsController::class,'destroy'])->name('admin.student.destroy');
     Route::post('/student_statuschange/{id}', [StudentsController::class,'status_change'])->name('admin.student.statuschange');
     

     Route::get('/student_password/{id}', [StudentsController::class,'change_password'])->name('admin.student_password');
     Route::post('/student_pwd_update/{id}', [StudentsController::class,'update_password'])->name('admin.student_pwd_update');

     Route::post('/student_certificate/{id}', [StudentsController::class,'student_certificate'])->name('admin.student_certificate');

     Route::post('/student_bulk_certi', [StudentsController::class,'student_bulk_certi'])->name('admin.student_bulk_certi');

     Route::get('/invite_student/{id}', [StudentsController::class,'invite_student'])->name('admin.student.invitestudent');
     Route::post('/student_bulk_invite', [StudentsController::class,'student_bulk_invite'])->name('admin.student_bulk_invite');
    
     Route::get('/committee_bureau/{id}', [CommitteeController::class,'committee_bureau'])->name('admin.committee.bureau');
     
     // Route::post('/committee_add_bureau', [CommitteeController::class,'add_bureau'])->name('admin.committee.add_bureau');
     // Route::post('/committee_dlt_bureau/{id}', [CommitteeController::class,'delete_bureau'])->name('admin.committee.dlt_bureau');
     
     Route::get('/committee_delegate/{id}', [CommitteeController::class,'committee_delegate'])->name('admin.committee.delegate');
     Route::post('/committee_country', [CommitteeController::class,'committee_country'])->name('admin.committee.committee_country');
     
     // Route::post('/committee_add_delegate', [CommitteeController::class,'add_delegate'])->name('admin.committee.add_delegate');
     // Route::post('/committee_dlt_delegate/{id}', [CommitteeController::class,'delete_delegate'])->name('admin.committee.dlt_delegate');
     // Route::post('/committee_get_delegate', [CommitteeController::class,'get_delegate'])->name('admin.committee.get_delegate');
    

     Route::get('/schools', [SchoolsController::class,'index'])->name('admin.schools');
     Route::get('/school_edit/{id}', [SchoolsController::class,'edit'])->name('admin.school.edit');
     Route::get('/school_show/{id}', [SchoolsController::class,'show'])->name('admin.school.show');
     Route::post('/school_update/{id}', [SchoolsController::class,'update'])->name('admin.school.update');
     Route::post('/school_delete/{id}', [SchoolsController::class,'destroy'])->name('admin.school.destroy');

     Route::get('/guideline', [GuidelineController::class,'index'])->name('admin.guideline');
     Route::post('/guideline_update', [GuidelineController::class,'update'])->name('admin.guideline.update');


});