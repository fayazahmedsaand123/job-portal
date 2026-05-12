<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\AdminController;

// Home
Route::get('/', [HomeController::class, 'index']);

// Public Jobs
Route::get('/jobs', [CandidateController::class, 'jobs']);
Route::get('/jobs/{id}', [CandidateController::class, 'showJob']);

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// Candidate Routes
Route::middleware(['role:candidate'])->group(function () {
    Route::get('/candidate/dashboard', [CandidateController::class, 'dashboard']);
    Route::get('/candidate/jobs', [CandidateController::class, 'jobs']);
    Route::get('/candidate/jobs/{id}', [CandidateController::class, 'showJob']);
    Route::post('/candidate/jobs/{id}/apply', [CandidateController::class, 'applyJob']);
});

// Employer Routes
Route::middleware(['role:employer'])->group(function () {
    Route::get('/employer/dashboard', [EmployerController::class, 'dashboard']);
    Route::get('/employer/my-jobs', [EmployerController::class, 'myJobs']);
    Route::get('/employer/post-job', [EmployerController::class, 'createJob']);
    Route::post('/employer/post-job', [EmployerController::class, 'storeJob']);
    Route::get('/employer/delete-job/{id}', [EmployerController::class, 'deleteJob']);
    Route::get('/employer/applicants/{job_id}', [EmployerController::class, 'applicants']);
    Route::post('/employer/applicants/status/{id}', [EmployerController::class, 'updateStatus']);
});

// Admin Routes
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::get('/admin/users/delete/{id}', [AdminController::class, 'deleteUser']);
    Route::get('/admin/jobs', [AdminController::class, 'jobs']);
    Route::get('/admin/jobs/delete/{id}', [AdminController::class, 'deleteJob']);
    Route::get('/admin/post-job', [AdminController::class, 'createJob']);
    Route::post('/admin/post-job', [AdminController::class, 'storeJob']);
    // Admin API Routes 
    Route::get('/admin/api/stats', [AdminController::class, 'stats']);
    Route::post('/admin/api/post-job', [AdminController::class, 'apiStoreJob']);
    Route::get('/admin/search', [AdminController::class, 'search']);
    Route::get('/admin/api/search', [AdminController::class, 'apiSearch']);
});

