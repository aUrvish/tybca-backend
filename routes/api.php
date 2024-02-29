<?php

use App\Http\Controllers\AuthController;
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
            Route::post('student/add', 'add');
            Route::post('teacher/add', 'add');
            Route::get('logout', 'logout');
            Route::get('profile', 'profile');
            Route::post('change-password', 'changePassword');
        });
    }
);
