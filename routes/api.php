<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->prefix('auth')->group(
    function (){
        Route::post('login', 'login');
        Route::post('request-reset-password', 'sendResetPasswordMail');
        Route::post('reset-password/{token}', 'resetPassword');

        Route::middleware(['auth:sanctum'])->group(function() {
            Route::post('add', 'add');
            Route::get('remove/{id}', 'remove');
            Route::get('logout', 'logout');
            Route::post('change-password', 'changePassword');
            Route::get('students/get', 'studentShow');
            Route::get('teachers/get', 'teacherShow');
            Route::get('staff/get', 'staffShow');
            Route::post('teachers/search', 'teacherSearch');
            Route::post('students/search', 'studentSearch');
            Route::post('staff/search', 'staffSearch');
            Route::post('disable', 'userDisbale');
        });
    }
);

Route::controller(ProfileController::class)->middleware(['auth:sanctum'])->group(
    function(){
        Route::get('profile', 'profile');
        Route::get('profile/{id}', 'userProfile');
        Route::post('profiles-edit', 'profilesEdit');
        Route::post('auth-profiles-edit', 'authProfileEdit');
    }
);

Route::controller(OverviewController::class)->middleware(['auth:sanctum'])->group(
    function(){
        Route::get('overview/get', 'get');
        Route::get('overview/students', 'students');
        Route::get('overview/teachers', 'teachers');
    }
);

Route::controller(CourseController::class)->middleware(['auth:sanctum'])->group(
    function(){
        Route::get('course/get', 'index');
        Route::post('course/add', 'add');
        Route::get('course/remove/{id}', 'remove');
    }
);

Route::controller(NoticeController::class)->middleware(['auth:sanctum'])->prefix('notice')->group(
    function(){
        Route::post('save', 'save');
        Route::get('delete/{id}', 'delete');
        Route::post('change-status', 'status');
        Route::get('publish/{id}', 'publish');
        Route::get('show/{uri}', 'get');
        Route::get('get/{id}', 'show');
        Route::get('all', 'all');
        Route::post('search', 'search');
    }
);
