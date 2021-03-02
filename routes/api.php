<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BaptismController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\MarriageController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('register', [AuthController::class, 'register'])->name('register');

Route::post('reset-password', [AuthController::class, 'sendPasswordResetEmail'])->name('password_reset');

Route::post('password/reset', [AuthController::class, 'resetPassword']);

Route::middleware('auth:api')->group(function() {

    Route::get('logout',  [AuthController::class, 'logout'])->name('logout');

    Route::get('myuser',  [AuthController::class, 'getLoggedUser'])->name('user');

    Route::apiResource('articles', ArticleController::class);

    Route::apiResource('users', UserController::class);

    Route::apiResource('baptisms', BaptismController::class);

    Route::apiResource('confirmations', ConfirmationController::class);

    Route::apiResource('marriages', MarriageController::class);
});




