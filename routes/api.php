<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PaperController;
use App\Http\Controllers\Api\ViennaController;
use App\Http\Controllers\Api\LineByLineController;
use App\Http\Controllers\Api\ResolutionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/get_allcommittee', [AuthController::class,'get_allcommittee']);

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::post('/get_profile', [AuthController::class,'get_profile']);
    Route::post('/update_password', [AuthController::class,'update_password']);
    Route::post('/update_avatar', [AuthController::class,'update_avatar']);
    Route::post('/get_profile', [AuthController::class,'get_profile']);
    Route::post('/get_committee', [AuthController::class,'get_committee']);
    Route::post('/get_committee_member', [AuthController::class,'get_committee_member']);

    Route::post('/get_rules_Procedure', [HomeController::class,'get_rules_Procedure']);
    Route::post('/get_speakers_list', [HomeController::class,'get_speakers_list']);
    Route::post('/speakers_country', [HomeController::class,'speakers_country']);
    Route::post('/add_speakers', [HomeController::class,'add_speakers']);

    Route::post('/get_program_schedule', [HomeController::class,'get_program_schedule']);
    Route::post('/delete_program_schedule', [HomeController::class,'delete_program_schedule']);
    Route::post('/add_program_schedule', [HomeController::class,'add_program_schedule']);

    Route::post('/get_blocks', [HomeController::class,'get_blocks']);
    Route::post('/add_blocks', [HomeController::class,'add_blocks']);
    Route::post('/update_blocks', [HomeController::class,'update_blocks']);
    Route::post('/delete_blocks', [HomeController::class,'delete_blocks']);

    Route::post('/get_live_stream', [HomeController::class,'get_live_stream']);
    Route::post('/add_live_stream', [HomeController::class,'add_live_stream']);
    Route::post('/delete_live_stream', [HomeController::class,'delete_live_stream']);


    Route::post('/get_papers', [PaperController::class,'get_papers']);
    Route::post('/add_paper',  [PaperController::class,'add_paper']);
    Route::post('/view_paper', [PaperController::class,'view_paper']);
    Route::post('/delete_paper', [PaperController::class,'delete_paper']);

    Route::post('/get_vienna', [ViennaController::class,'get_vienna']);
    Route::post('/add_vienna',  [ViennaController::class,'add_vienna']);

    Route::post('/get_line_by_line', [LineByLineController::class,'get_line_by_line']);
    Route::post('/add_line_by_line',  [LineByLineController::class,'add_line_by_line']);

    Route::post('/get_resolution', [ResolutionController::class,'get_resolution']);
    Route::post('/add_resolution', [ResolutionController::class,'add_resolution']);
    Route::post('/accept_resolution', [ResolutionController::class,'accept_resolution']);
    



});
