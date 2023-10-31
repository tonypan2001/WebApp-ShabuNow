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

Route::group([
    'middleware' => 'api',
    'prefix' => 'order'
], function () {
    Route::get('{table}', [\App\Http\Controllers\Api\OrderController::class, 'index']);
    Route::post('create/{table}', [\App\Http\Controllers\Api\OrderController::class, 'create']);
    Route::get('checkPending/{table}', [\App\Http\Controllers\Api\OrderController::class, 'checkPending']);
    Route::get('sendOrders/{table}', [\App\Http\Controllers\Api\OrderController::class, 'sendOrders']);
    Route::get('show/{order}', [\App\Http\Controllers\Api\OrderController::class, 'show']);
});

Route::apiResource('/menu', \App\Http\Controllers\Api\MenuController::class);


Route::group([ //staff section --------------------------------------------------------------------------------------------
    'middleware' => 'api',
    'prefix' => 'staff'
], function () {
    Route::get('/', [\App\Http\Controllers\Api\UserController::class, 'listStaff']);
    Route::get('{user}', [\App\Http\Controllers\Api\UserController::class, 'show']); //show 1 User (NOT ONLY 1 STAFF)
    Route::put('{user}/update', [\App\Http\Controllers\Api\UserController::class, 'update']); //show 1 User (NOT ONLY 1 STAFF)
    Route::delete('{user}/delete', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
    Route::post('create', [\App\Http\Controllers\Api\UserController::class, 'store']);
});

Route::group([ //customer section --------------------------------------------------------------------------------------------
    'middleware' => 'api',
    'prefix' => 'customer'
], function () {
    Route::get('/', [\App\Http\Controllers\Api\UserController::class, 'listCustomer']);
    Route::get('{user}', [\App\Http\Controllers\Api\UserController::class, 'show']); //show 1 User (NOT ONLY 1 STAFF)
    Route::put('{user}/update', [\App\Http\Controllers\Api\UserController::class, 'update']); //show 1 User (NOT ONLY 1 STAFF)
    Route::delete('{user}/delete', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
    Route::post('create', [\App\Http\Controllers\Api\UserController::class, 'store']);
});
