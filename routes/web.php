<?php

use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\teacherController;
use App\Http\Controllers\UserController;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return back()->with('danger', 'You are already logged in');
    } else {
        return view('login');
    }
})->name('login');
Route::post('/login', [UserController::class, 'login'])->name('users.login');
Route::get("/logout", [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['role:1']], function () {

    Route::get("/dashboard", [UserController::class, 'redirect'])->name('dashboard');
    Route::get("/users", [UserController::class, 'index'])->name('users.index');
    Route::get("/users/edit/{user}", [UserController::class, 'edit'])->name('users.edit');
    Route::post("/users/update/{user}", [UserController::class, 'update'])->name('users.update');
    Route::delete("/users/delete/{user}", [UserController::class, 'delete'])->name('users.delete');

    // registration through ajax
    Route::get("/users/create/ajax", [UserController::class, 'createAjax'])->name('users.create.ajax');
    Route::post("/users/create/ajax", [UserController::class, 'storeAjax'])->name('users.store.ajax');

    Route::get("/features", [FeatureController::class, 'createFeature'])->name('users.features');
    Route::post("/features", [FeatureController::class, 'store'])->name('store.feature');


    Route::get("/Permissions", [FeatureController::class, 'createPermission'])->name('users.permission');
    Route::post("/Permissions", [FeatureController::class, 'storePermission'])->name('store.permission');

    Route::get("/checked/permission", [FeatureController::class, 'checkedPermission']);
});

// registeration
Route::get("/users/create", [UserController::class, 'create'])->name('users.create');
Route::post("/users/store", [UserController::class, 'store'])->name('users.store');

Route::group(['middleware' => ['role:2']], function () {

    Route::get("/teacher/index", [teacherController::class, 'index'])->name('teacherDashboard');
    Route::get('attendance/show',[teacherController::class,'attendanceShow'])->name('attendance.show');
    Route::get('attendance/user/{user}',[UserController::class,'studentAttendance'])->name('studentAttendance');


});
Route::group(['middleware' => ['role:3']], function () {
    Route::get("/monitor/index", [MonitorController::class, 'index'])->name('monitorDashboard');
});
Route::group(['middleware' => ['role:4']], function () {
    Route::get("/student/index", [StudentController::class, 'index'])->name('studentDashboard');
});

Route::post("/subject/selected", [StudentController::class, 'selectedSubject'])->name('subject.seleted');

Route::get("/subject", [SubjectController::class, 'index'])->name('subject.index');
Route::get("/subject/create", [SubjectController::class, 'create'])->name('subject.create');
Route::post("/subject/store", [SubjectController::class, 'store'])->name('subject.store');
Route::get("/subject/edit/{subject}", [SubjectController::class, 'edit'])->name('subject.edit');
Route::post("/subject/update/{subject}", [SubjectController::class, 'update'])->name('subject.update');

Route::delete("/subject/delete/{subject}", [SubjectController::class, 'delete'])->name('subject.delete');

Route::get('subject/approve/{student}',[StudentSubjectController::class,'approved'])->name('subject.approved');
Route::get('subject/reject/{student}',[StudentSubjectController::class,'rejected'])->name('subject.rejected');
Route::get('user/attendance',[UserController::class,'attendance'])->name('user.attendance');
Route::get('user/attendance/update',[UserController::class,'attendanceUpdate'])->name('user.attendance.update');
Route::get('teacher/attendance',[UserController::class,'teachersAttendance'])->name('teachersAttendance');
Route::get('student/attendance/{student}',[StudentController::class,'attendanceDetail'])->name('attendanceDetail');
Route::get('attendance/teacher/{teacher}',[teacherController::class,'attendanceDetailTeacher'])->name('attendanceDetailTeacher');
Route::post('user/search',[UserController::class,'search'])->name('user.search');
