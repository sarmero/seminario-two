<?php

use App\Http\Controllers\admin\AdmissionController as AdminAdmissionController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\session\PlanStudyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\start\AdmissionController;
use App\Http\Controllers\start\HomeController;
use App\Http\Controllers\start\PreinscriptionController;
use App\Http\Controllers\session\OfferController;
use App\Http\Controllers\session\RatingsController;
use App\Http\Controllers\start\ProgramController;
use App\Http\Controllers\session\HomeController as UserHomeController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\ProgramController as AdminProgramController;
use App\Http\Controllers\admin\ProgramOfferController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\admin\SubjectOfferController;
use App\Http\Controllers\admin\TeacherController;
use App\Http\Controllers\session\ActivityTeacherController;
use App\Http\Controllers\session\ChairsTeacherController;
use App\Http\Controllers\session\RatingTeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about', [homeController::class, 'about'])->name('about');
Route::get('/preinscription', [PreinscriptionController::class, 'index'])->name('preinscription');
Route::post('/', [PreinscriptionController::class, 'store'])->name('users.store');
Route::get('/admission', [AdmissionController::class, 'index'])->name('admission');
Route::post('/admission', [AdmissionController::class, 'search'])->name('search.users');
Route::get('/programs', [ProgramController::class, 'index'])->name('programs');
Route::get('/content/{id}', [ProgramController::class, 'content'])->name('content');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'startSession'])->name('session');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/users/home', [UserHomeController::class, 'index'])->name('session.home');

Route::middleware(['verifyiRoles:Docente,Estudiante'])->group(function () {
});

// Route::middleware(['verifyiRoles:Estudiante'])->group(function () {
    Route::get('/users/ratings/', [RatingsController::class, 'index'])->name('ratings');
    Route::get('/users/ratings/{id}', [RatingsController::class, 'ratings'])->name('ratings.semester');
    Route::get('/users/offer', [OfferController::class, 'index'])->name('session.offer');
    Route::get('/users/offer/inscription', [OfferController::class, 'inscription'])->name('session.offer.inscrition');
    Route::get('/users/planstudy', [PlanStudyController::class, 'index'])->name('plan');
// });

// Route::middleware(['verifyiRoles:Docente'])->group(function () {
    //-------------------------session teacher--------------------
    Route::get('/users/teacher/chairs', [ChairsTeacherController::class, 'index'])->name('teacher.chairs');
    Route::get('/users/teacher/ratings', [RatingTeacherController::class, 'index'])->name('teacher.ratings');
    Route::put('/users/teacher/ratings/update/{id}', [RatingTeacherController::class, 'update'])->name('teacher.ratings.update');
    Route::post('/users/teacher/rating/subject', [RatingTeacherController::class, 'student'])->name('teacher.ratings.subject');
    Route::resource('activity', ActivityTeacherController::class);
    Route::get('/admin/student/person/{id}', [StudentController::class, 'showPerson'])->name('student.person');

// });

// Route::middleware(['verifyiRoles:Docente,Administrador'])->group(function () {
    Route::get('/admin/student/person/{id}', [StudentController::class, 'showPerson'])->name('student.person');
// });

// Route::middleware(['verifyiRoles:Administrador'])->group(function () {
    Route::get('/admin/welcome', [AdminHomeController::class, 'index'])->name('admin');

    Route::resource('program', AdminProgramController::class);
    Route::resource('offer-program', ProgramOfferController::class);
    Route::resource('subject', AdminSubjectController::class);
    Route::resource('offer-subject', SubjectOfferController::class);
    Route::resource('admissions', AdminAdmissionController::class);
    Route::resource('student', StudentController::class);
    Route::resource('teacher', TeacherController::class);

    Route::get('/offer-subject/subject/{id}', [SubjectOfferController::class, 'getSubjectTeacher'])->name('getSubject');
    Route::get('/student/program/{id}', [StudentController::class, 'getPrograms'])->name('getSubject');
    Route::get('/admin/admission/person/{id}', [AdminAdmissionController::class, 'showPerson'])->name('admission.person');
    Route::get('/admin/teacher/person/{id}', [TeacherController::class, 'showPerson'])->name('teacher.person');
    Route::get('/admin/admission/close/{id}', [AdminAdmissionController::class, 'closeOffer'])->name('admission.close');

// });