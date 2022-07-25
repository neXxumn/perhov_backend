<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::controller(PostController::class)->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'createPost');
        Route::get('/tags{id}', 'showTags');
    });
});

Route::controller(AuthController::class)->group(function() {
        Route::post('/registration', 'createUser');
        Route::post('/authorization', 'userLogin');
        Route::get('/users/{id}', 'getUserData');
});
