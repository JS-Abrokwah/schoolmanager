<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;



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
Route::get('login', [AuthController::class, 'login']);
Route::post('login',[AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password',[AuthController::class, 'sendResetLink']);
Route::get('password-reset/{token}',[AuthController::class, 'resetPassword']);
Route::post('reset-password/{token}',[AuthController::class, 'resetUserPassword']);






// Route groups
Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::post('admin/admin/add-admin', [AdminController::class, 'addNewAdmin']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'warnDelete']);
    Route::post('admin/admin/delete', [AdminController::class, 'destroy']);

    // Class url
    Route::get('admin/class/list', [SchoolClassController::class, 'list']);
    Route::post('admin/class/add-class', [SchoolClassController::class, 'addNewClass']);
    Route::get('admin/class/edit/{id}', [SchoolClassController::class, 'edit']);
    Route::post('admin/class/edit', [SchoolClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [SchoolClassController::class, 'warnDelete']);
    Route::post('admin/class/delete', [SchoolClassController::class, 'destroy']);

     // Subject url
     Route::get('admin/subject/list', [SubjectController::class, 'list']);
     Route::post('admin/subject/add-class', [SubjectController::class, 'addNewSubject']);
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
