<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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
Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('logout', [AuthController::class,'logout']);
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    // Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'category'
], function () {
    Route::get('', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::post('/store', [\App\Http\Controllers\Api\CategoryController::class, 'store']);
    Route::put('/update/{name}', [\App\Http\Controllers\Api\CategoryController::class, 'update']);
});


//Route::apiResource('/category', \App\Http\Controllers\Api\CategoryController::class);

Route::apiResource('/menu', \App\Http\Controllers\Api\MenuController::class);
Route::apiResource('/order', \App\Http\Controllers\Api\OrderController::class);
