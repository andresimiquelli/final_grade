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
use App\Http\Controllers\JournalsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\PackModuleController;
use App\Http\Controllers\PackModuleSubjectController;
use App\Http\Controllers\StudetController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserAssignmentController;
use App\Http\Controllers\UserController;

$resourceExcept = ['create','edit'];

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () use ($resourceExcept) {

    Route::prefix('auth')->group(function() {

        Route::middleware(['auth:api','jwt.auth'])->group(function () {
           Route::post('logout', 'App\Http\Controllers\AuthController@logout');
            Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
            Route::post('me', 'App\Http\Controllers\AuthController@me');
        });

        Route::post('login', 'App\Http\Controllers\AuthController@login');
    });

    Route::apiResource('users',UserController::class,['except' => $resourceExcept]);
    Route::apiResource('users.assignments',UserAssignmentController::class, ['except' => $resourceExcept]);

    Route::apiResource('courses',CourseController::class,['except' => $resourceExcept]);

    Route::apiResource('subjects',SubjectController::class,['except' => $resourceExcept]);

    Route::apiResource('packs',PackController::class,['except' => $resourceExcept]);
    Route::apiResource('packs.modules',PackModuleController::class,['except' => $resourceExcept]);
    Route::apiResource('packs.modules.subjects',PackModuleSubjectController::class,['except' => $resourceExcept]);

    Route::apiResource('students',StudetController::class, ['except' => $resourceExcept]);

    Route::apiResource('classes',CClassController::class, ['except' => $resourceExcept]);

    Route::apiResource('enrollments',EnrollmentController::class, ['except' => $resourceExcept]);
    Route::apiResource('enrollments.absences', EnrollmentAbsenceController::class, ['except' => [...$resourceExcept, 'update']]);

    Route::apiResource('classes.subjects.lessons',LessonController::class, ['except' => $resourceExcept]);
    Route::apiResource('classes.subjects.evaluations',EvaluationController::class, ['except' => $resourceExcept]);
    Route::apiResource('classes.subjects.evaluations.grades',EvaluationGradeController::class, ['except' => [...$resourceExcept, 'update']]);

    Route::apiResource('finalgrades', FinalgradeController::class, ['except' => [...$resourceExcept, 'update']]);
    Route::get('finalgrades/classes/{class_id}/subjects/{subject_id}/report', FinalgradeController::class.'@report');
    Route::post('finalgrades/classes/{class_id}/subjects/{subject_id}', FinalgradeController::class.'@storeAll');

    Route::get('journals/{class_id}', JournalsController::class."@index");
    Route::get('journals/{class_id}/{subject_id}', JournalsController::class."@find");
    Route::post('journals', JournalsController::class."@store");

    Route::post('lessons/{lesson_id}/absences', LessonController::class."@updateAbsences");
    Route::post('evaluations/{evaluation_id}/grades', EvaluationGradeController::class."@saveAll");
});
