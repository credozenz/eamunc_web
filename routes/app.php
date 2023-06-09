<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\Admin\ForgotPasswordController;


use App\Http\Controllers\App\Bureau\BureauDashbordController;
use App\Http\Controllers\App\Bureau\BureauPaperSubmissionController;
use App\Http\Controllers\App\Bureau\BureauBlocFormationController;
use App\Http\Controllers\App\Bureau\BureauViennaFormulaController;
use App\Http\Controllers\App\Bureau\BureauLineByLineController;
use App\Http\Controllers\App\Bureau\BureauResolutionController;
use App\Http\Controllers\App\Bureau\BureauGeneralAssemblyController;
use App\Http\Controllers\App\Bureau\BureauProfileController;
use App\Http\Controllers\App\Bureau\BureauSpeakersController;
use App\Http\Controllers\App\Bureau\BureauBlocChatController;
use App\Http\Controllers\App\Bureau\BureauGeneralPapersController;
use App\Http\Controllers\App\Bureau\BureauScheduleProgramController;
use App\Http\Controllers\App\Bureau\BureauCommitteeLiveController;

use App\Http\Controllers\App\Delegate\DelegateDashbordController;
use App\Http\Controllers\App\Delegate\DelegatePaperSubmissionController;
use App\Http\Controllers\App\Delegate\DelegateBlocFormationController;
use App\Http\Controllers\App\Delegate\DelegateViennaFormulaController;
use App\Http\Controllers\App\Delegate\DelegateLineByLineController;
use App\Http\Controllers\App\Delegate\DelegateResolutionController;
use App\Http\Controllers\App\Delegate\DelegateGeneralAssemblyController;
use App\Http\Controllers\App\Delegate\DelegateProfileController;
use App\Http\Controllers\App\Delegate\DelegateSpeakersController;
use App\Http\Controllers\App\Delegate\DelegateBlocChatController;
use App\Http\Controllers\App\Delegate\DelegateGeneralPapersController;
use App\Http\Controllers\App\Delegate\DelegateScheduleProgramController;
use App\Http\Controllers\App\Delegate\DelegateLiabilityWaiverController;
use App\Http\Controllers\App\Delegate\DelegateCommitteeLiveController;



use App\Http\Controllers\App\VIPUser\VIPDashbordController;
use App\Http\Controllers\App\VIPUser\VIPPaperSubmissionController;
use App\Http\Controllers\App\VIPUser\VIPBlocFormationController;
use App\Http\Controllers\App\VIPUser\VIPViennaFormulaController;
use App\Http\Controllers\App\VIPUser\VIPLineByLineController;
use App\Http\Controllers\App\VIPUser\VIPResolutionController;
use App\Http\Controllers\App\VIPUser\VIPGeneralAssemblyController;
use App\Http\Controllers\App\VIPUser\VIPProfileController;
use App\Http\Controllers\App\VIPUser\VIPSpeakersController;
use App\Http\Controllers\App\VIPUser\VIPBlocChatController;
use App\Http\Controllers\App\VIPUser\VIPGeneralPapersController;
use App\Http\Controllers\App\VIPUser\VIPScheduleProgramController;
use App\Http\Controllers\App\VIPUser\VIPCommitteeLiveController;




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


Route::get('/', [AuthController::class,'getApp']);
Route::get('/signin/{id}', [AuthController::class,'getLogin']);
Route::post('/login', [AuthController::class,'postLogin']);

Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

Route::group(['middleware' => 'bureauchecker'], function() {
    
    Route::get('/bureau_dashbord', [BureauDashbordController::class,'index'])->name('app.bureau_dashbord');
    Route::get('/bureau_guideline', [BureauDashbordController::class,'guideline'])->name('app.bureau_guideline');
    Route::get('/bureau_paper_submission', [BureauPaperSubmissionController::class,'index'])->name('app.bureau_paper_submission');
    Route::get('/bureau_bloc_formation', [BureauBlocFormationController::class,'index'])->name('app.bureau_bloc_formation');
    Route::post('/bureau_bloc_store', [BureauBlocFormationController::class,'store'])->name('app.bureau_bloc_store');
    Route::get('/bureau_bloc_show/{id}', [BureauBlocFormationController::class,'show'])->name('app.bureau_bloc_show');
    Route::post('/bureau_bloc_update/{id}', [BureauBlocFormationController::class,'update'])->name('app.bureau_bloc_update');
    
    Route::get('/bureau_committee_live', [BureauCommitteeLiveController::class,'index'])->name('app.bureau_committee_live');
    Route::post('/bureau_live_update/{id}', [BureauCommitteeLiveController::class,'update'])->name('app.bureau_live_update');
    Route::post('/bureau_live_add/{id}', [BureauCommitteeLiveController::class,'add'])->name('app.bureau_live_add');
    Route::post('/bureau_live_delete/{id}', [BureauCommitteeLiveController::class,'live_delete'])->name('app.bureau_live_delete');

    Route::get('/bureau_general_papers', [BureauGeneralPapersController::class,'index'])->name('app.bureau_general_papers');
    Route::post('/bureau_paper_delete/{id}', [BureauGeneralPapersController::class,'destroy'])->name('app.bureau_paper_delete');

    Route::get('/bureau_bloc_chat/{id}', [BureauBlocChatController::class,'index'])->name('app.bureau_bloc_chat');
    Route::post('/bureau_chat_store/{id}', [BureauBlocChatController::class,'store'])->name('app.bureau_chat_store');
    Route::post('/bureau_chat_dlt/{id}', [BureauBlocChatController::class,'destroy'])->name('app.bureau_chat_dlt');
    
    Route::get('/bureau_vienna_formula', [BureauViennaFormulaController::class,'index'])->name('app.bureau_vienna_formula');
    Route::get('/bureau_vienna_formula_editor', [BureauViennaFormulaController::class,'show'])->name('app.bureau_vienna_formula_editor');
    Route::post('/bureau_vienna_formula_store', [BureauViennaFormulaController::class,'store'])->name('app.bureau_vienna_formula_store');

    Route::get('/bureau_line_by_line', [BureauLineByLineController::class,'index'])->name('app.bureau_line_by_line');
    Route::get('/bureau_line_by_line_editor', [BureauLineByLineController::class,'show'])->name('app.bureau_line_by_line_editor');
    Route::post('/bureau_line_by_line_store', [BureauLineByLineController::class,'store'])->name('app.bureau_line_by_line_store');

    Route::get('/bureau_resolution', [BureauResolutionController::class,'index'])->name('app.bureau_resolution');
    Route::get('/bureau_resolution_editor', [BureauResolutionController::class,'show'])->name('app.bureau_resolution_editor');
    Route::post('/bureau_resolution_store', [BureauResolutionController::class,'store'])->name('app.bureau_resolution_store');


    Route::get('/bureau_general_assembly', [BureauGeneralAssemblyController::class,'index'])->name('app.bureau_general_assembly');
    Route::get('/bureau_assembly_show/{id}', [BureauGeneralAssemblyController::class,'show'])->name('app.bureau_assembly_show');
   
   
    Route::get('/bureau_profile', [BureauProfileController::class,'index'])->name('app.bureau_profile');
    Route::post('/bureau_password', [BureauProfileController::class,'update_password'])->name('app.bureau_password');
    Route::post('/bureau_avatar', [BureauProfileController::class,'update_avatar'])->name('app.bureau_avatar');
   
    Route::get('/bureau_speaker', [BureauSpeakersController::class,'index'])->name('app.bureau_speaker');
    Route::post('/bureau_speaker_country', [BureauSpeakersController::class,'bureau_speaker_country'])->name('app.speakers_country');
    Route::post('/bureau_speaker_store', [BureauSpeakersController::class,'store'])->name('app.speakers_store');
    Route::post('/speaker_delete/{id}', [BureauSpeakersController::class,'destroy'])->name('app.speaker_delete');

    Route::get('/bureau_program_schedule', [BureauScheduleProgramController::class,'index'])->name('app.bureau_program_schedule');
    Route::get('/program_schedule_create', [BureauScheduleProgramController::class,'create'])->name('app.program_schedule.create');
    Route::post('/program_schedule_store', [BureauScheduleProgramController::class,'store'])->name('app.program_schedule.store');
    Route::post('/program_schedule_delete/{id}', [BureauScheduleProgramController::class,'destroy'])->name('app.program_schedule.destroy');

    Route::get('/bureau_log_out', [BureauProfileController::class,'log_out'])->name('app.log_out');


});


Route::group(['middleware' => 'delegatechecker'], function() {

    Route::get('/delegate_dashbord', [DelegateDashbordController::class,'index'])->name('app.delegate_dashbord');
    Route::get('/delegate_guideline', [DelegateDashbordController::class,'guideline'])->name('app.delegate_guideline');
    Route::get('/delegate_paper_submission', [DelegatePaperSubmissionController::class,'index'])->name('app.delegate_paper_submission');
    Route::post('/delegate_paper_submit', [DelegatePaperSubmissionController::class,'store'])->name('app.delegate_paper_submit');
    Route::get('/delegate_bloc_formation', [DelegateBlocFormationController::class,'index'])->name('app.delegate_bloc_formation');
    Route::get('/delegate_vienna_formula', [DelegateViennaFormulaController::class,'index'])->name('app.delegate_vienna_formula');
    Route::get('/delegate_line_by_line', [DelegateLineByLineController::class,'index'])->name('app.delegate_line_by_line');
    Route::get('/delegate_resolution', [DelegateResolutionController::class,'index'])->name('app.delegate_resolution');
    Route::post('/delegate_resolution_accept', [DelegateResolutionController::class,'accept'])->name('app.delegate_resolution_accept');
  
    Route::get('/delegate_general_assembly', [DelegateGeneralAssemblyController::class,'index'])->name('app.delegate_general_assembly');
    Route::get('/delegate_assembly_show/{id}', [DelegateGeneralAssemblyController::class,'show'])->name('app.delegate_assembly_show');
   
    Route::get('/delegate_committee_live', [DelegateCommitteeLiveController::class,'index'])->name('app.delegate_committee_live');
  
    Route::get('/delegate_profile', [DelegateProfileController::class,'index'])->name('app.delegate_profile');
    Route::post('/delegate_password', [DelegateProfileController::class,'update_password'])->name('app.delegate_password');
    Route::post('/delegate_avatar', [DelegateProfileController::class,'update_avatar'])->name('app.delegate_avatar');
    Route::get('/delegate_speaker', [DelegateSpeakersController::class,'index'])->name('app.delegate_speaker');
    Route::get('/delegate_program_schedule', [DelegateScheduleProgramController::class,'index'])->name('app.delegate_program_schedule');
    Route::get('/delegate_bloc_chat/{id}', [DelegateBlocChatController::class,'index'])->name('app.bureau_bloc_chat');
    Route::post('/delegate_chat_store/{id}', [DelegateBlocChatController::class,'store'])->name('app.delegate_chat_store');
    Route::post('/delegate_chat_dlt/{id}', [DelegateBlocChatController::class,'destroy'])->name('app.delegate_chat_dlt');
    
    Route::get('/liability_waiver_form', [DelegateLiabilityWaiverController::class,'index'])->name('app.liability_waiver_form');
    Route::post('/liability_waiver_form_submit', [DelegateLiabilityWaiverController::class,'store'])->name('app.liability_waiver_form.liability_form_submit');
    
    Route::get('/delegate_log_out', [DelegateProfileController::class,'log_out'])->name('app.log_out');
});


Route::group(['middleware' => 'vipuserchecker'], function() {
   
    Route::get('/vipuser_dashbord', [VIPDashbordController::class,'index'])->name('app.vipuser_dashbord');
    Route::get('/vipuser_guideline', [VIPDashbordController::class,'guideline'])->name('app.vipuser_guideline');
    Route::get('/vipuser_paper_submission', [VIPPaperSubmissionController::class,'index'])->name('app.vipuser_paper_submission');
    Route::get('/vipuser_bloc_formation', [VIPBlocFormationController::class,'index'])->name('app.vipuser_bloc_formation');
    Route::get('/vipuser_bloc_show/{id}', [VIPBlocFormationController::class,'show'])->name('app.vipuser_bloc_show');
    
    Route::get('/vipuser_general_papers', [VIPGeneralPapersController::class,'index'])->name('app.vipuser_general_papers');
   
    Route::get('/vipuser_bloc_chat/{id}', [VIPBlocChatController::class,'index'])->name('app.vipuser_bloc_chat');
    
    Route::get('/vipuser_vienna_formula', [VIPViennaFormulaController::class,'index'])->name('app.vipuser_vienna_formula');
    Route::get('/vipuser_vienna_formula_editor', [VIPViennaFormulaController::class,'show'])->name('app.vipuser_vienna_formula_editor');
   
    Route::get('/vipuser_line_by_line', [VIPLineByLineController::class,'index'])->name('app.vipuser_line_by_line');
    Route::get('/vipuser_line_by_line_editor', [VIPLineByLineController::class,'show'])->name('app.vipuser_line_by_line_editor');
    
    Route::get('/vipuser_resolution', [VIPResolutionController::class,'index'])->name('app.vipuser_resolution');
    Route::get('/vipuser_resolution_editor', [VIPResolutionController::class,'show'])->name('app.vipuser_resolution_editor');
   

    Route::get('/vipuser_general_assembly', [VIPGeneralAssemblyController::class,'index'])->name('app.vipuser_general_assembly');
    Route::get('/vipuser_assembly_show/{id}', [VIPGeneralAssemblyController::class,'show'])->name('app.vipuser_assembly_show');
   
    Route::get('/vipuser_committee_live', [VIPCommitteeLiveController::class,'index'])->name('app.vipuser_committee_live');
    
    Route::get('/vipuser_speaker', [VIPSpeakersController::class,'index'])->name('app.vipuser_speaker');
    Route::post('/vipuser_speaker_country', [VIPSpeakersController::class,'vipuser_speaker_country'])->name('app.speakers_country');
    
    Route::get('/vipuser_program_schedule', [VIPScheduleProgramController::class,'index'])->name('app.vipuser_program_schedule');
   
    Route::get('/vipuser_log_out', [VIPProfileController::class,'log_out'])->name('app.log_out');

    Route::get('/vipuser_profile', [VIPProfileController::class,'index'])->name('app.vipuser_profile');
    Route::post('/vipuser_password', [VIPProfileController::class,'update_password'])->name('app.vipuser_password');
    Route::post('/vipuser_avatar', [VIPProfileController::class,'update_avatar'])->name('app.vipuser_avatar');


});
