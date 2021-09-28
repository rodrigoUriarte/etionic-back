<?php

use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => ['auth:sanctum'],
], function(){
    Route::apiResource('usuarios', UserController::class);
    Route::apiResource('items', ItemController::class);
});
Route::post('/login', LoginController::class);
