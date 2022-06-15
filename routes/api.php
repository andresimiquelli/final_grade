<?php

use App\Http\Controllers\CClassController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentAbsenceController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationGradeController;
use App\Http\Controllers\FinalgradeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\PackModuleController;
use App\Http\Controllers\PackModuleSubjectController;
use App\Http\Controllers\StudetController;
use App\Http\Controllers\TeacherAssignmentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;

$resourceExcept = ['create','edit'];

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () use ($resourceExcept) {
    Route::apiResource('users',UserController::class,['except' => $resourceExcept]);
    Route::apiResource('courses',CourseController::class,['except' => $resourceExcept]);
    Route::apiResource('subjects',SubjectController::class,['except' => $resourceExcept]);
    Route::apiResource('packs',PackController::class,['except' => $resourceExcept]);
    Route::apiResource('packs.modules',PackModuleController::class,['except' => $resourceExcept]);
    Route::apiResource('packs.modules.subjects',PackModuleSubjectController::class,['except' => $resourceExcept]);
    Route::apiResource('students',StudetController::class, ['except' => $resourceExcept]);
    Route::apiResource('classes',CClassController::class, ['except' => $resourceExcept]);
    Route::apiResource('enrollments',EnrollmentController::class, ['except' => $resourceExcept]);
    Route::apiResource('teachers',TeacherController::class, ['except' => $resourceExcept]);
    Route::apiResource('teachers.assignments',TeacherAssignmentController::class, ['except' => $resourceExcept]);
    Route::apiResource('classes.subjects.lessons',LessonController::class, ['except' => $resourceExcept]);
    Route::apiResource('classes.subjects.evaluations',EvaluationController::class, ['except' => $resourceExcept]);
    Route::apiResource('classes.subjects.evaluations.grades',EvaluationGradeController::class, ['except' => [...$resourceExcept, 'update']]);
    Route::apiResource('enrollments.absences', EnrollmentAbsenceController::class, ['except' => [...$resourceExcept, 'update']]);
    Route::apiResource('finalgrades', FinalgradeController::class, ['except' => [...$resourceExcept, 'update']]);
});
