<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ParentController;



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

Route::get('', [AuthController::class, 'welcome']);
Route::get('register-school',[AuthController::class, 'newSchool']);
Route::post('create-school',[AuthController::class, 'createSchool']);
Route::get('login', [AuthController::class, 'login']);
Route::post('login',[AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password',[AuthController::class, 'sendResetLink']);
Route::get('password-reset/{token}',[AuthController::class, 'resetPassword']);
Route::post('reset-password/{token}',[AuthController::class, 'resetUserPassword']);
Route::post('change-password', [AuthController::class, 'changePassword']);





// Admin Route groups
Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::post('admin/admin/add-admin', [AdminController::class, 'addNewAdmin']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'warnDelete']);
    Route::post('admin/admin/delete', [AdminController::class, 'destroy']);

    // Class url
    Route::get('admin/class/list', [ClassesController::class, 'list']);
    Route::post('admin/class/add-class', [ClassesController::class, 'addNewClass']);
    Route::get('admin/class/edit/{id}', [ClassesController::class, 'edit']);
    Route::post('admin/class/edit', [ClassesController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassesController::class, 'warnDelete']);
    Route::post('admin/class/delete', [ClassesController::class, 'destroy']);
    Route::get('admin/class/view_class/{id}', [ClassesController::class, 'classDetail']);
    Route::post('admin/class/add_subject', [ClassesController::class, 'attachSubject']);
    Route::get('admin/class/del_subject/{class_id}/{subject_id}', [ClassesController::class, 'detachSubject']);
    Route::get('admin/class/view_subject/{id}', [SubjectController::class, 'subjectDetail']);
    
     // Students url
     Route::get('admin/students/list', [StudentController::class, 'list']);
     Route::post('admin/students/add-subject', [StudentController::class, 'addNewStudent']);
     Route::get('admin/students/edit/{id}', [StudentController::class, 'edit']);
     Route::post('admin/students/edit', [StudentController::class, 'update']);
     Route::get('admin/students/delete/{id}', [StudentController::class, 'warnDelete']);
     Route::post('admin/students/delete', [StudentController::class, 'destroy']);
     
     // Teachers url
     Route::get('admin/teachers/list', [TeacherController::class, 'list']);
     Route::post('admin/teachers/add-subject', [TeacherController::class, 'addNewTeacher']);
     Route::get('admin/teachers/edit/{id}', [TeacherController::class, 'edit']);
     Route::post('admin/teachers/edit', [TeacherController::class, 'update']);
     Route::get('admin/teachers/delete/{id}', [TeacherController::class, 'warnDelete']);
     Route::post('admin/teachers/delete', [TeacherController::class, 'destroy']);
     
     // Parents url
     Route::get('admin/parents/list', [ParentController::class, 'list']);
     Route::post('admin/parents/add-subject', [ParentController::class, 'addNewParent']);
     Route::get('admin/parents/edit/{id}', [ParentController::class, 'edit']);
     Route::post('admin/parents/edit', [ParentController::class, 'update']);
     Route::get('admin/parents/delete/{id}', [ParentController::class, 'warnDelete']);
     Route::post('admin/parents/delete', [ParentController::class, 'destroy']);
     
     // Subject url
     Route::get('admin/subject/list', [SubjectController::class, 'list']);
     Route::post('admin/subject/add-subject', [SubjectController::class, 'addNewSubject']);
     Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
     Route::post('admin/subject/edit', [SubjectController::class, 'update']);
     Route::get('admin/subject/delete/{id}', [SubjectController::class, 'warnDelete']);
     Route::post('admin/subject/delete', [SubjectController::class, 'destroy']);
});

Route::middleware(['parent'])->group(function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
});

Route::middleware(['teacher'])->group(function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
});

Route::middleware(['student'])->group(function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
});
