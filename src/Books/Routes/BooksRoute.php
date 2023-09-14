<?php

use Core\Books\Controllers\BooksController;
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
Route::get('/by', [BooksController::class, 'getBooksByParameters']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/', [BooksController::class, 'store']);
    Route::get('/{book}', [BooksController::class, 'show'])->where('book', '[0-9]+');
    Route::delete('/{book}', [BooksController::class, 'delete'])->where('book', '[0-9]+');
    Route::patch('/{book}', [BooksController::class, 'update'])->where('book', '[0-9]+');
});
