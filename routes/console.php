<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\CourseController;

// ✅ CRUD - Students
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::get('/students/{student}', [StudentController::class, 'show']);
Route::put('/students/{student}', [StudentController::class, 'update']);
Route::delete('/students/{student}', [StudentController::class, 'destroy']);

// ✅ CRUD - Teachers
Route::get('/teachers', [TeacherController::class, 'index']);
Route::post('/teachers', [TeacherController::class, 'store']);
Route::get('/teachers/{teacher}', [TeacherController::class, 'show']);
Route::put('/teachers/{teacher}', [TeacherController::class, 'update']);
Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy']);

// ✅ عرض جميع الدورات التي يدرسها معلم
Route::get('/teachers/{id}/courses', [TeacherController::class, 'getCourses']);

// ✅ CRUD - Courses
Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{course}', [CourseController::class, 'show']);
Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{course}', [CourseController::class, 'destroy']);

// ✅ تسجيل طالب في دورة
Route::post('/courses/{id}/enroll', [CourseController::class, 'enrollStudent']);

// ✅ عرض الطلاب المسجلين في دورة
Route::get('/courses/{id}/students', [CourseController::class, 'getEnrolledStudents']);

// ✅ تعليق فيه رابط Postman
// Postman Collection: https://www.postman.com/your-link-here
