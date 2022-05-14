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

use App\Http\Controllers\App\Delegate\DelegateDashbordController;
use App\Http\Controllers\App\Delegate\DelegatePaperSubmissionController;
use App\Http\Controllers\App\Delegate\DelegateBlocFormationController;
use App\Http\Controllers\App\Delegate\DelegateViennaFormulaController;
use App\Http\Controllers\App\Delegate\DelegateLineByLineController;
use App\Http\Controllers\App\Delegate\DelegateResolutionController;
use App\Http\Controllers\App\Delegate\DelegateGeneralAssemblyController;
use App\Http\Controllers\App\Delegate\DelegateProfileController;

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

Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

Route::group(['middleware' => 'bureauchecker'], function() {
    
    Route::get('/bureau_dashbord', [BureauDashbordController::class,'index'])->name('app.bureau_dashbord');
    Route::get('/bureau_paper_submission', [BureauPaperSubmissionController::class,'index'])->name('app.bureau_paper_submission');
    Route::get('/bureau_bloc_formation', [BureauBlocFormationController::class,'index'])->name('app.bureau_bloc_formation');
    Route::get('/bureau_vienna_formula', [BureauViennaFormulaController::class,'index'])->name('app.bureau_vienna_formula');
    Route::get('/bureau_line_by_line', [BureauLineByLineController::class,'index'])->name('app.bureau_line_by_line');
    Route::get('/bureau_resolution', [BureauResolutionController::class,'index'])->name('app.bureau_resolution');
    Route::get('/bureau_general_assembly', [BureauGeneralAssemblyController::class,'index'])->name('app.bureau_general_assembly');
    Route::get('/bureau_profile', [BureauProfileController::class,'index'])->name('app.bureau_profile');

});


Route::group(['middleware' => 'delegatechecker'], function() {

    Route::get('/delegate_dashbord', [DelegateDashbordController::class,'getDashbord'])->name('app.delegate_dashbord');
    Route::get('/delegate_paper_submission', [DelegatePaperSubmissionController::class,'index'])->name('app.delegate_paper_submission');
    Route::get('/delegate_bloc_formation', [DelegateBlocFormationController::class,'index'])->name('app.delegate_bloc_formation');
    Route::get('/delegate_vienna_formula', [DelegateViennaFormulaController::class,'index'])->name('app.delegate_vienna_formula');
    Route::get('/delegate_line_by_line', [DelegateLineByLineController::class,'index'])->name('app.delegate_line_by_line');
    Route::get('/delegate_resolution', [DelegateResolutionController::class,'index'])->name('app.delegate_resolution');
    Route::get('/delegate_general_assembly', [DelegateGeneralAssemblyController::class,'index'])->name('app.delegate_general_assembly');
    Route::get('/delegate_profile', [DelegateProfileController::class,'index'])->name('app.delegate_profile');
    
});
