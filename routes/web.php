<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AdminController;

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


Route::middleware(['web'])->group(function () {
    Route::get('/', [AuthController::class, 'viewlogin'])->name('viewlogin');

    Route::get('/login', [AuthController::class, 'viewlogin'])->name('viewlogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/signup', [AuthController::class, 'viewsignup'])->name('viewsignup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

    Route::get('/forgotpassword', [AuthController::class, 'viewforgetpassword'])->name('viewforgetpassword');
    Route::post('/forgotpassword', [AuthController::class, 'forgetpassword'])->name('forgetpassword');

    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes for student dashboard
Route::middleware(['web', 'auth', 'checkRole:student'])->group(function () {
    Route::get('/student-dashboard', [AppController::class, 'index'])->name('index');
    Route::get('/submit-documents', [AppController::class, 'documents'])->name('submitdocuments');
    Route::get('/document-status', [AppController::class, 'showDocumentstatus'])->name('showDocumentstatus');
    Route::get('/notifications', [AppController::class, 'notification'])->name('notification');
    Route::get('/faqs', [AppController::class, 'faqs'])->name('faqs');
    Route::get('/profile', [AppController::class, 'profile'])->name('profile');
    Route::get('/editprofile', [AppController::class, 'showeditprofile'])->name('showeditprofile');
    Route::patch('/update-profile', [AppController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/document/upload', [AppController::class, 'uploadDocument'])->name('document.upload');
    Route::get('/student/courses', [AppController::class, 'showCourses'])->name('student.courses');
    Route::post('/student/courses/enroll', [AppController::class, 'enrollInCourse'])->name('student.courses.enroll');
    Route::delete('/courses/enrolled/{courseId}', [AppController::class, 'deleteEnrolledCourse'])->name('delete.enrolled.course');
    Route::get('/courses/form', [AppController::class, 'showCourseForm'])->name('show.course.form');

});

// Routes for admin dashboard
Route::middleware(['web', 'auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admindashboard');
    Route::get('/students', [AdminController::class, 'viewStudent'])->name('viewStudent');
    Route::get('/settings-general', [AdminController::class, 'viewGensettings'])->name('viewGensettings');
    Route::get('/settings-verification-requirements', [AdminController::class, 'viewVerificationreq'])->name('viewVerificationreq');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/fetch-students', [AdminController::class, 'viewfetchUsers'])->name('viewfetchUser');
    Route::post('/fetch-users', [AdminController::class, 'fetchUsers'])->name('fetchUsers');
    Route::get('/review-details/{id}', [AdminController::class, 'showReviewDetails'])->name('review.details');
    Route::patch('/sessions/{id}/update', [AdminController::class, 'update'])->name('sessions.update');
    Route::post('/submissions/manage-deadline', [AdminController::class, 'manageDeadline'])->name('submissions.manageDeadline');
    Route::post('/doc-types', [AdminController::class, 'store'])->name('doc-types.store');
    Route::delete('/doc-types/{id}', [AdminController::class, 'destroy'])->name('doc-types.destroy');
    Route::post('/requirements/store', [AdminController::class, 'storeRequirement'])->name('requirements.store');
    Route::delete('/delete-requirement/{id}', [AdminController::class, 'destroyrequirement'])->name('delete.requirement');
    Route::put('/sessions/{id}', [AdminController::class, 'updatesession'])->name('update.session');
    Route::put('/update-submission-deadline', [AdminController::class, 'updatedeadline'])->name('update.submission-deadline');
    Route::get('/document/{document_id}/view', [AdminController::class, 'view'])->name('document.view');
    Route::post('/document/{document_id}/approve', [AdminController::class, 'approve'])->name('document.approve');
    Route::post('/document/{document_id}/reject', [AdminController::class, 'reject'])->name('document.reject');
    Route::get('/courses', [AdminController::class, 'course'])->name('courses.index');
    Route::post('/courses', [AdminController::class, 'course_store'])->name('courses.store');
    Route::delete('/courses/{id}', [AdminController::class, 'course_destroy'])->name('courses.destroy');

});


