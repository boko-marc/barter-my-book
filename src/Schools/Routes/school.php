<?php

use Core\Schools\Controllers\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('', [SchoolController::class, "index"]);




