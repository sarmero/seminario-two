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


//[---------------------------------login--------------------------------]
// Route::get('/session', [homController::class, 'index'])->name('session.home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'startSession'])->name('session');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['verifyiRoles:Estudiante'])->group(function () {

    //[--------------------------------Session--------------------------------]
    Route::get('/users/home', [UserHomeController::class, 'index'])->name('session.home');

    //---------------------calificaciones-----------------
    Route::get('/users/ratings', [RatingsController::class, 'index'])->name('ratings');
    Route::post('/users/ratings', [RatingsController::class, 'ratings'])->name('ratings.semester');

    //-------------------------offer--------------------
    Route::get('/users/offer', [OfferController::class, 'index'])->name('session.offer');
    Route::get('/users/offer/inscription', [OfferController::class, 'inscrition'])->name('session.offer.inscrition');

    //-------------------------plan Study--------------------
    Route::get('/users/planstudy', [PlanStudyController::class, 'index'])->name('plan');
});

Route::middleware(['verifyiRoles:Docente'])->group(function () {
    //--------------------------------Session---------------------
    Route::get('/users/home', [UserHomeController::class, 'index'])->name('session.home');

    //-------------------------session teacher--------------------
    Route::get('/users/teacher/chairs', [ChairsTeacherController::class, 'index'])->name('teacher.chairs');

    Route::get('/users/teacher/ratings', [RatingTeacherController::class, 'index'])->name('teacher.ratings');
    Route::put('/users/teacher/ratings/update/{id}', [RatingTeacherController::class, 'update'])->name('teacher.ratings.update');
    Route::post('/users/teacher/rating/subject', [RatingTeacherController::class, 'student'])->name('teacher.ratings.subject');

    Route::get('/users/teacher/activity', [ActivityTeacherController::class, 'index'])->name('teacher.activity');
    Route::post('/users/teacher/activity/create', [ActivityTeacherController::class, 'store'])->name('teacher.create');
    Route::post('/users/teacher/activity/subject', [ActivityTeacherController::class, 'activity'])->name('teacher.subject');
});

Route::middleware(['verifyiRoles:Administrador'])->group(function () {
    //[--------------------------------Admin----------------------------------]
    Route::get('/admin/welcome', [AdminHomeController::class, 'index'])->name('admin.home');

    Route::resource('program', AdminProgramController::class);
    Route::resource('offer-program', ProgramOfferController::class);
    Route::resource('subject', AdminSubjectController::class);
    Route::resource('offer-subject', SubjectOfferController::class);
    Route::resource('admissions', AdminAdmissionController::class);
    Route::resource('student', StudentController::class);
    Route::resource('teacher', TeacherController::class);



    // Route::get('/admin/program', [AdminProgramController::class, 'show'])->name('admin.program');
    // Route::get('/admin/program/register', [AdminProgramController::class, 'index'])->name('admin.program.register');
    // Route::post('/admin/program', [AdminProgramController::class, 'store'])->name('admin.program.store');
    // Route::put('/admin/program/update/{id}', [AdminProgramController::class, 'update'])->name('admin.program.update');
    // Route::delete('/admin/program/{id}', [AdminProgramController::class, 'delete'])->name('admin.program.delete');

    // Route::get('/admin/program/offer', [ProgramOfferController::class, 'index'])->name('admin.program.offer');
    // Route::post('/admin/program/offer', [ProgramOfferController::class, 'store'])->name('admin.program.offer.store');
    // Route::put('/admin/program/offer/update/{id}', [ProgramOfferController::class, 'update'])->name('admin.program.offer.update');
    // Route::delete('/admin/program/offer/{id}', [ProgramOfferController::class, 'delete'])->name('admin.program.offer.delete');

    // Route::get('/admin/subject', [AdminSubjectController::class, 'show'])->name('admin.subject');
    // Route::get('/admin/subject/register', [AdminSubjectController::class, 'index'])->name('admin.subject.register');
    // Route::post('/admin/subject', [AdminSubjectController::class, 'store'])->name('admin.subject.store');
    // Route::post('/admin/subject/program', [AdminSubjectController::class, 'subject'])->name('admin.subject.program');
    // Route::put('/admin/subject/update/{id}', [AdminSubjectController::class, 'update'])->name('admin.subject.update');
    // Route::delete('/admin/subject/{id}', [AdminSubjectController::class, 'delete'])->name('admin.subject.delete');

    // Route::get('/admin/subject/offer', [SubjectOfferController::class, 'index'])->name('admin.subject.offer');
    // Route::get('/admin/subject/offer/offer', [SubjectOfferController::class, 'offer'])->name('admin.subject.offer.offer');
    // Route::get('/admin/subject/offer/program', [SubjectOfferController::class, 'programsSubject'])->name('admin.subject.offer.program');
    // Route::post('/admin/subject/offer', [SubjectOfferController::class, 'store'])->name('admin.subject.offer.store');
    // Route::put('/admin/subject/offer/update/{id}', [SubjectOfferController::class, 'update'])->name('admin.subject.offer.update');
    // Route::delete('/admin/subject/offer/{id}', [SubjectOfferController::class, 'delete'])->name('admin.subject.offer.delete');

    // Route::get('/admin/admission', [AdminAdmissionController::class, 'index'])->name('admin.admission');
    // Route::post('/admin/admission', [AdminAdmissionController::class, 'admission'])->name('admin.admission.program');
    // Route::get('/admin/admission/close/{id}', [AdminAdmissionController::class, 'closeOffer'])->name('admin.admission.close');
    // Route::get('/admin/admission/{state}/admission/{id}/programa/{pro}', [AdminAdmissionController::class, 'update'])->name('admin.admission.option');
    // Route::get('/admin/admission/person/{id}', [AdminAdmissionController::class, 'showPerson'])->name('admin.admission.person');

    // Route::get('/admin/student', [StudentController::class, 'index'])->name('admin.student');
    // Route::get('/admin/student/program', [StudentController::class, 'programs'])->name('admin.student.calendar');
    // Route::get('/admin/student/student', [StudentController::class, 'programsStudent'])->name('admin.student.program');
    // Route::get('/admin/student/person/{id}', [StudentController::class, 'showPerson'])->name('admin.student.person');

    // Route::get('/admin/teacher', [TeacherController::class, 'show'])->name('admin.teacher');
    // Route::post('/admin/teacher', [TeacherController::class, 'teacher'])->name('admin.teacher.program');
    // Route::delete('/admin/teacher/{id}', [TeacherController::class, 'delete'])->name('admin.teacher.delete');
    // Route::get('/admin/teacher/person/{id}', [TeacherController::class, 'showPerson'])->name('admin.teacher.person');

    // Route::get('/admin/teacher/register', [TeacherController::class, 'index'])->name('admin.teacher.register');
    // Route::post('/admin/teacher/register', [TeacherController::class, 'store'])->name('admin.teacher.store');
});
