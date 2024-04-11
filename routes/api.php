<?php

use App\Http\Controllers\Api\OptionController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user
Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::get('user/{user}', [UserController::class, 'show']);
Route::put('user/{user}', [UserController::class, 'update']);
Route::delete('user/{user}', [UserController::class, 'destroy']);

// Quiz
Route::get('quiz', [QuizController::class, 'index']);
Route::post('quiz', [QuizController::class, 'store']);
Route::get('quiz/{quiz}', [QuizController::class, 'show']);
Route::put('quiz/{quiz}', [QuizController::class, 'update']);
Route::delete('quiz/{quiz}', [QuizController::class, 'destroy']);

// Question
Route::get('question', [QuestionController::class, 'index']);
Route::post('question', [QuestionController::class, 'store']);
Route::get('question/{question}', [QuestionController::class, 'show']);
Route::put('question/{question}', [QuestionController::class, 'update']);
Route::delete('question/{question}', [QuestionController::class, 'destroy']);

// Option
Route::get('option', [OptionController::class, 'index']);
Route::post('option', [OptionController::class, 'store']);
Route::get('option/{option}', [OptionController::class, 'show']);
Route::put('option/{option}', [OptionController::class, 'update']);
Route::delete('option/{option}', [OptionController::class, 'destroy']);