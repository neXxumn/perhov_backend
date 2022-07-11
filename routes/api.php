<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(NewsController::class)->group(function () {
    Route::get('/news', 'index');
    Route::get('/news/{id}', 'show');
    Route::post('/news', 'create');
});

Route::controller(RegistrationController::class)->group(function() {
    Route::post('/registration', 'createUser');
});

Route::controller(AuthorizationController::class)->group(function() {
    Route::post('/authorization', 'userLogin');
});