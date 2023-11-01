<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
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
    Route::get('', [CategoryController::class, 'index']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::put('/update/{name}', [CategoryController::class, 'update']);
});

//Route::apiResource('/category', \App\Http\Controllers\Api\CategoryController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'order'
], function () {
    Route::get('{table}', [OrderController::class, 'index']);
    Route::post('store/{table}', [OrderController::class, 'store']);
    Route::get('checkPending/{table}', [OrderController::class, 'checkPending']);
    Route::get('sendOrders/{table}', [OrderController::class, 'sendOrders']);
    Route::get('show/{order}', [OrderController::class, 'show']);
});

Route::group([
    'middlemare' => 'api',
    'prefix' => 'menu'
], function () {
    Route::post('store', [MenuController::class, 'store']);
});

Route::group([ //staff section --------------------------------------------------------------------------------------------
    'middleware' => 'api',
    'prefix' => 'staff'
], function () {
    Route::get('/', [UserController::class, 'listStaff']);
    Route::get('{user}', [UserController::class, 'show']); //show 1 User (NOT ONLY 1 STAFF)
    Route::put('{user}/update', [UserController::class, 'update']); //show 1 User (NOT ONLY 1 STAFF)
    Route::delete('{user}/delete', [UserController::class, 'destroy']);
    Route::post('create', [UserController::class, 'store']);
});

Route::group([ //customer section --------------------------------------------------------------------------------------------
    'middleware' => 'api',
    'prefix' => 'customer'
], function () {
    Route::get('/', [UserController::class, 'listCustomer']);
    Route::get('{user}', [UserController::class, 'show']); //show 1 User (NOT ONLY 1 STAFF)
    Route::put('{user}/update', [UserController::class, 'update']); //show 1 User (NOT ONLY 1 STAFF)
    Route::delete('{user}/delete', [UserController::class, 'destroy']);
    Route::post('create', [UserController::class, 'store']);
});
