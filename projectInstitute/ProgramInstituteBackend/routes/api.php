<?php

use App\Http\Controllers\v1\Admin\AdmissionController;
use App\Http\Controllers\v1\admin\CalendarController;
use App\Http\Controllers\v1\admin\ModalityController;
use App\Http\Controllers\v1\admin\StudentController;
use App\Http\Controllers\v1\Admin\ProgramController;
use App\Http\Controllers\v1\Admin\ProgramOfferController;
use App\Http\Controllers\v1\Admin\SubjectController;
use App\Http\Controllers\v1\Admin\SubjectOfferController;
use App\Http\Controllers\v1\Admin\TeacherController;
use App\Http\Controllers\v1\DistrictController;
use App\Http\Controllers\v1\LoginController;
use App\Http\Controllers\v1\PersonController;
use App\Http\Controllers\v1\SemesterController;
use App\Http\Controllers\v1\session\SessionController;
use App\Http\Controllers\v1\session\student\OfferController;
use App\Http\Controllers\v1\session\student\PlanStudyController;
use App\Http\Controllers\v1\session\ActivityController;
use App\Http\Controllers\v1\session\NewsController;
use App\Http\Controllers\v1\session\student\HomeController;
use App\Http\Controllers\v1\session\student\RatingsController;
use App\Http\Controllers\v1\session\teacher\ChairsController;
use App\Http\Controllers\v1\session\teacher\HomeController as TeacherHomeController;
use App\Http\Controllers\v1\session\teacher\RatingController;
use App\Http\Controllers\v1\start\PreinscriptionController;
use App\Http\Controllers\v1\start\ProgramController as StartProgramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//========================== admin ======================
Route::apiResource('v1/program', ProgramController::class);
Route::apiResource('v1/offer-program', ProgramOfferController::class);
Route::apiResource('v1/offer-subject', SubjectOfferController::class);
Route::apiResource('v1/student', StudentController::class);
Route::apiResource('v1/subject', SubjectController::class);
Route::apiResource('v1/teacher', TeacherController::class);
Route::apiResource('v1/modality', ModalityController::class);
Route::apiResource('v1/calendar', CalendarController::class);
Route::apiResource('v1/admission', AdmissionController::class);

Route::get('v1/program/programs/{id}', [ProgramController::class,'getProgramId']);
Route::get('v1/show/program', [ProgramController::class,'getProgram']);
Route::get('v1/teacher/tea/{id}', [TeacherController::class,'getTeacherId']);
Route::get('v1/teacher/person/{id}', [TeacherController::class,'showPerson']);
Route::get('v1/offer-subject/teacher/{id}', [SubjectOfferController::class,'getOfferTeacher']);
Route::get('v1/offer-subject/subject/{id}', [SubjectOfferController::class,'getSubjectTeacher']);
Route::get('v1/subject/subject/{id}', [SubjectController::class,'getSubject']);
Route::get('v1/student/person/{id}', [StudentController::class, 'showStudent']);
Route::get('v1/student/program/{id}', [StudentController::class, 'getPrograms']);
Route::get('v1/admission/person/{id}', [AdmissionController::class, 'showPerson']);
Route::get('v1/admission/close/{id}', [AdmissionController::class, 'closeOffer']);

//============== session ========================
Route::apiResource('v1/session',SessionController::class);
Route::apiResource('v1/activity', ActivityController::class);
Route::get('v1/student/activity/{id}', [ActivityController::class,'getActivityStudent']);
Route::get('v1/teacher/activity/{id}', [ActivityController::class,'getActivityTeacher']);

//================ teacher ======================
Route::apiResource('v1/rating', RatingController::class);
Route::get('v1/list/subject/{tea}',[ChairsController::class,'getSubject']);
Route::get('v1/teacher/subject/{tea}',[ChairsController::class,'getSubjectTeacher']);
Route::get('v1/teacher/teacher/{id}', [TeacherHomeController::class,'getTeacher']);
Route::get('v1/chairs/{cal}/teacher/{tea}',[ChairsController::class,'getSubjectTeacher']);

//================ student ======================
Route::get('v1/offer/pro/{pro}/sem/{sem}/std/{std}',[OfferController::class,'getOfferSubject']);
Route::post('v1/offer',[OfferController::class,'store']);
Route::get('v1/ratings/semester/{id}/student/{std}',[RatingsController::class,'getRatings']);
Route::get('v1/planstudy/{id}', [PlanStudyController::class, 'getPlanStudy']);
Route::get('v1/student/position/{id}/offer/{offer}', [HomeController::class, 'getPosition']);
Route::get('v1/student/average/{id}', [HomeController::class, 'getAverage']);
Route::get('v1/student/approved/{id}', [HomeController::class, 'getApproved']);
Route::get('v1/student/subject-count/{id}', [HomeController::class, 'getSubjectCount']);
Route::get('v1/student/student/{id}', [HomeController::class, 'getStudent']);


Route::apiResource('v1/person', PersonController::class);
Route::apiResource('v1/semester',SemesterController::class);
Route::apiResource('v1/district', DistrictController::class);
Route::apiResource('v1/news',NewsController::class);
Route::get('v1/person/document/{number}', [PersonController::class, 'getDocument']);
Route::post('v1/login', [LoginController::class, 'login']);
Route::post('v1/logout', [LoginController::class,'logout']);

Route::apiResource('v1/programs', StartProgramController::class);
Route::apiResource('v1/preinscription', PreinscriptionController::class);
