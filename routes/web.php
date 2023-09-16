<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Student\PusherController;
use Illuminate\Support\Facades\Process;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize');
    return 'Event dispachted';
});

Route::get('/', function () {
    return Inertia::render('Home', [
        'canResetPassword' => true,
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {

    Route::namespace('App\Http\Controllers')
    ->group(function () {
        Route::post('locale', 'SetUserLocaleController@update')->name('locale.update');
    });

    Route::middleware('admin')
    ->prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->as('admin.') 
    ->group(function () {
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::post('profile', 'ProfileController@store')->name('profile.store');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('logo', 'LogoController@index')->name('logo.index');
        Route::post('logo', 'LogoController@store')->name('logo.update');

        Route::resource('books', 'BookController');
        Route::get('serach-books', 'BookController@search')->name('books.search');

        Route::resource('teachers', 'TeacherController');
        Route::resource('students', 'StudentController');
        Route::resource('study-groups', 'StudyGroupController');
        Route::resource('subjects', 'SubjectController');
        Route::resource('school-classes', 'SchoolClassController');
        Route::get('assign-students/{study_group}', 'AssignStudentToStudyGroupController@index')->name('study-group.assign-students');
        Route::post('assign-students/{study_group}', 'AssignStudentToStudyGroupController@store')->name('study-group.assign-students.store');

        Route::get('add-students/{school_class}', 'AddStudentsToClassController@index')->name('school-class.add-students');
        Route::post('add-students/{school_class}', 'AddStudentsToClassController@store')->name('school-class.add-students.store');
        
        Route::prefix('import')
        ->as('import.') 
        ->group(function () {
            Route::get('students', 'ImportStudentsController@index')->name('students.index');
            Route::post('students', 'ImportStudentsController@store')->name('students.store');
            Route::get('teachers', 'ImportTeacherController@index')->name('teachers.index');
            Route::post('teachers', 'ImportTeacherController@store')->name('teachers.store');
        });

        Route::prefix('export')
        ->as('export.') 
        ->group(function () {
            Route::get('teachers', 'ExportTeacherController@index')->name('teachers');
            Route::get('students', 'ExportStudentController@index')->name('students');
        });
    });

    Route::middleware(['teacher'])
    ->prefix('teacher')
    ->namespace('App\Http\Controllers\Teacher')
    ->as('teacher.')
    ->group(function () {
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::post('profile', 'ProfileController@store')->name('profile.store');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('lessons/{lesson}/reports', 'LessonReportsController@index')->name('lessons.reports');
        Route::resource('lessons', 'LessonController');

        Route::resource('assignments', 'AssignmentController');
        Route::post('assignments/{assignment}/publish', 'AssignmentController@publish')->name('assignment.publish');

        Route::resource('assessments', 'AssessmentController');
        Route::post('assessments/{assessment}/publish', 'AssessmentController@publish')->name('assessment.publish');

        Route::resource('assessments.questions', 'AssessmentQuestionController')->except('show')->shallow();
        Route::resource('assessments.essay-questions', 'EssayQuestionController')->except('show')->shallow();

        Route::prefix('evaluation')
        ->as('evaluation.')
        ->group(function () {
            // Grade Assignment
            Route::get('assignments', 'AssignmentEvaluationController@assignments')->name('assignments');
            Route::get('assignments/{assignment}/submissions', 'AssignmentEvaluationController@index')->name('student.assignments');
            Route::get('assignments/search', 'AssignmentEvaluationController@search')->name('assignments.search');
            Route::get('assessments/search', 'AssessmentEvaluationController@search')->name('assessments.search');
            Route::post('student/{studentAssignment}/grade-assignment', 'AssignmentEvaluationController@grade')->name('assignment.grade');

            // Grade Assessment
            Route::get('assessments', 'AssessmentEvaluationController@assessments')->name('assessments');
            Route::get('assessments/{assessment}/submissions', 'AssessmentEvaluationController@index')->name('student.assessments');
            Route::get('assessments/{studentAssessment}/review', 'AssessmentEvaluationController@review')->name('student.assessment.review');
            Route::post('student/{studentAssessment}/grade-assessment', 'AssessmentEvaluationController@grade')->name('student.assessment.grade');
        });

        Route::prefix('export')
        ->as('export.')
        ->group(function () {
            Route::get('assignments/{assignment}', 'ExportAssignmentSubmissionsController@index')->name('assignments');
            Route::get('assessments/{assessment}', 'ExportAssessmentsubmissionsController@index')->name('assessments');
            Route::get('lesson/{lesson}/reports', 'ExportLessonReportsController@index')->name('lesson.reports');
        });
    });

    Route::middleware(['student'])
    ->prefix('student')
    ->namespace('App\Http\Controllers\Student')
    ->as('student.')
    ->group(function () {

        Route::get('pusher', 'PusherController@index')->name('pusher');
        Route::get('send-notification', [PusherController::class, 'sendNotification']);
        Route::get('notifications', 'NotificationsController@index')->name('notifications.index');

        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::post('profile', 'ProfileController@store')->name('profile.store');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('assignments', 'AssignmentController@index')->name('assignments.index');
        Route::get('active-assignments/search', 'AssignmentController@search')->name('active-assignments.search');
        Route::get('assessments', 'AssessmentController@index')->name('assessments.index');
        Route::get('active-assessments/search', 'AssessmentController@search')->name('active-assessments.search');

        Route::prefix('assignment/{assignment}')->as('assignment.')->group(function () {
            Route::post('/', 'AssignmentController@store')->name('store');
            Route::get('/', 'AssignmentController@show')->name('show');
        });

        Route::prefix('assessments/{assessment}')->as('assessments.')->group(function () {
            Route::post('/', 'AssessmentController@store')->name('store');
            Route::get('start', 'AssessmentController@start')->name('start');
            Route::get('completed', 'AssessmentController@completed')->name('completed');
            Route::get('instructions', 'AssessmentController@instructions')->name('instructions');
        });

        Route::prefix('lessons/{lesson}')->as('lessons.')->group(function () {
            Route::get('/', 'LessonController@show')->name('show');
            Route::post('save-progress', 'LessonController@saveProggress');
            Route::get('files', 'LessonController@files')->name('files.index');
            Route::get('discussion', 'LessonDiscussionController@index')->name('discussion.index');
            Route::post('discussion', 'LessonDiscussionController@store')->name('discussion.store');
        });

        Route::get('books', 'BookController@index')->name('books.index');
        Route::get('books/{book}', 'BookController@show')->name('books.show');
        Route::get('serach-books', 'BookController@search')->name('books.search');
        Route::get('download/book/{book}', 'BookController@download')->name('books.download');
        Route::get('active-lessons', 'LessonController@index')->name('active-lessons.index');
        Route::get('active-lessons/search', 'LessonController@search')->name('active-lessons.search');

        // Notifications
        Route::get('read-notification', 'NotificationsController@markAsRead')->name('notification.read');
    });
});