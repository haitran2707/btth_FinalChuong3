<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () { return redirect('/dashboard'); });

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('courses', CourseController::class);
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');

Route::resource('lessons', LessonController::class);
Route::resource('enrollments', EnrollmentController::class);
