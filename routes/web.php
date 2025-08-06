<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AssignmentController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function() {
    Route::get('/register', [AuthController::class, 'showRegister']) -> name('register.show');
    Route::get('/login', [AuthController::class , 'showLogin']) -> name('login.show');
    Route::post('/register' ,[AuthController::class, 'register']) ->name('register');
    Route::post('/login', [AuthController::class, 'login']) ->name('login');
});

Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');


Route::middleware('auth') ->group(function() {
    Route::get('/user/profile', [ProfileController::class, 'showProfile'])->name('user.profile');
    Route::post('/user/profile/photo', [ProfileController::class, 'changeProfileImage'])->name('user.profileChangeImage');
    Route::post('/user/profile/removephoto', [ProfileController::class, 'removeProfileImage'])->name('user.profileRemoveImage');
    Route::post('/user/profile/name', [ProfileController::class, 'changeProfileName'])->name('user.profileChangeName');

    Route::group(['middleware' => 'admin'], function(){
        Route::get('/admin/users', [UsersController::class, 'index']) ->name('user.index');
        Route::get('/admin/users/create', [UsersController::class, 'create']) ->name('user.create');
        Route::post('/admin/users', [UsersController::class, 'store']) ->name('user.store');
        Route::get('/admin/users/{user}', [UsersController::class, 'show']) ->name('user.show');
        Route::get('/admin/users/{user}/edit', [UsersController::class, 'edit']) ->name('user.edit');
        Route::put('/admin/users/{user}', [UsersController::class, 'update']) ->name('user.update');
        Route::delete('/admin/users/{user}', [UsersController::class, 'destroy']) ->name('user.destroy');

        Route::get('/admin/courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/admin/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/admin/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('/admin/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/admin/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/admin/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

        Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/admin/notifications/{user}/create', [NotificationController::class, 'create'])->name('notifications.create');
        Route::post('/admin/notifications/{user}', [NotificationController::class, 'store'])->name('notifications.store');
        Route::delete('/admin/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

        Route::get('/admin/questions', [QuestionController::class, 'index']) ->name('questions.index');
        Route::get('/admin/questions/create', [QuestionController::class, 'create']) ->name('questions.create');
        Route::post('/admin/questions', [QuestionController::class, 'store']) ->name('questions.store');
        Route::get('/admin/questions/{question}/edit', [QuestionController::class, 'edit']) ->name('questions.edit');
        Route::put('/admin/questions/{question}', [QuestionController::class, 'update']) ->name('questions.update');
        Route::delete('/admin/questions/{question}', [QuestionController::class, 'destroy']) ->name('questions.destroy');

    });

    Route::group(['middleware' => 'student'], function(){
        Route::get('/student/EnrolledCourses', [CourseController::class, 'viewEnrolledCourses']) ->name('courses.enrolledCourses');
        Route::get('/student/courses', [CourseController::class, 'viewCoursesForStudents'])->name('courses.studentsIndex');
        Route::post('/student/courses/{course}', [CourseController::class, 'enrollInCourse'])->name('courses.enroll');
        Route::delete('/student/courses/{course}', [CourseController::class, 'dropCourse'])->name('courses.drop');

        Route::get('/student/material/{course}', [MaterialController::class, 'showCourseMaterial'])->name('material.courseMaterial');

        Route::get('/student/teachers', [UsersController::class, 'showTeachers'])->name('teachers.index');
        Route::get('/student/EvaluateTeacher/{teacher}', [QuestionController::class, 'showEvaluationForm'])->name('teachers.evaluate');
        Route::post('/student/EvaluteTeacher/{teacher}', [QuestionController::class, 'storeEvaluationResponse'])->name('teachers.storeEvaluation');
        Route::get('/student/teachers/{teacher}', [UsersController::class, 'show']) ->name('teachers.show');

        Route::get('/student/courses/assignments', [CourseController::class, 'showEnrolledCoursesForAssignments'])->name('courses.assignments');
        Route::post('/student/courses/assignements/{course}', [AssignmentController::class, 'store'])->name('assingments.store');


    });

    Route::group(['middleware' => 'teacher'], function(){
        Route::get('/teacher/AssignedCourses', [CourseController::class, 'showAssignedCourses']) ->name('courses.assignedCourses');
        Route::get('/teacher/courses', [CourseController::class, 'showCoursesToTeach'])->name('courses.toApplyList');
        Route::post('/teacher/courses/{course}', [CourseController::class, 'applyToTeachCourse'])->name('courses.teach');
        Route::delete('/teacher/courses/{course}', [CourseController::class, 'cancelTeachingCourse'])->name('courses.cancelTeaching');

        Route::get('/teacher/FellowTeachers', [UsersController::class, 'showFellowTeachers'])->name('fellowTeachers.index');
        Route::get('/teacher/FellowTeachers/{teacher}', [UsersController::class, 'show'])->name('fellowTeachers.show');
        Route::get('/teacher/FellowTeachers/evaluate/{teacher}', [QuestionController::class, 'showEvaluationForm'])->name('fellowTeachers.evaluate');
        Route::post('/teacher/FellowTeachers/evaluate/{teacher}', [QuestionController::class, 'storeEvaluationResponse'])->name('fellowTeachers.storeEvaluation');

        Route::get('/teacher/announcements/courses{course}', [NotificationController::class, 'showAnnouncementForm'])->name('announcements.showAnnouncementForm');
        Route::post('/teacher/accouncements/courses{course}', [NotificationController::class, 'storeAnnouncement'])->name('announcements.storeAnnouncement');
        Route::get('/teacher/courses/material', [MaterialController::class, 'showCoursesToUpoadMaterial'])->name('materials.coursesToUploadeMaterialFor');
        Route::post('/teacher/courses{course}/material', [MaterialController::class, 'uploadMaterial'])->name('materials.upload');

        Route::get('/teacher/courses/assignments', [CourseController::class, 'showAssignedCoursesForAssignments'])->name('courses.submittedAssignments');
        Route::get('/teacher/course{course}/UploadedAssignments', [AssignmentController::class, 'showUploadedAssignments'])->name('courses.showUploadedAssignments');

    });
});


