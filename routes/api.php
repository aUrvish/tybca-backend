<?php

use App\Http\Controllers\TenantAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::controller(TenantAuthController::class)->prefix('tenant')->group(
    function() {
        Route::post('add', 'add');
    }
);
