<?php

use App\Http\Controllers\ProfilerAcademicController;
use App\Http\Controllers\ProfilerContractController;
use App\Http\Controllers\ProfilerEmailController;
use App\Http\Controllers\ProfilerExpController;
use App\Http\Controllers\ProfilerInfoController;
use App\Http\Controllers\ProfilerIpController;
use App\Http\Controllers\ProfilerLangController;
use App\Http\Controllers\ProfilerMedicalController;
use App\Http\Controllers\ProfilerProjectController;
use App\Http\Controllers\ProfilerResidentController;
use App\Http\Controllers\ProfilerSkillController;
use App\Http\Controllers\ProfilerTelephoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources([
    'academic' => ProfilerAcademicController::class,
    'contract' => ProfilerContractController::class,
    'email' => ProfilerEmailController::class,
    'exp' => ProfilerExpController::class,
    'info' => ProfilerInfoController::class,
    'ip' => ProfilerIpController::class,
    'lang' => ProfilerLangController::class,
    'medical' => ProfilerMedicalController::class,
    'project' => ProfilerProjectController::class,
    'resident' => ProfilerResidentController::class,
    'skill' => ProfilerSkillController::class,
    'telephone' => ProfilerTelephoneController::class,
]);

Route::post('skilled', [ProfilerSkillController::class, 'store']);
