<?php

use Core\Users\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"])->name('login');

Route::post('/validate/account', [AuthController::class, "validateAccount"]);


Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/logout', [AuthController::class, "logout"]);

});
