<?php

use Core\Users\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, "register"]);
Route::post('/validate/account', [AuthController::class, "validateAccount"]);




