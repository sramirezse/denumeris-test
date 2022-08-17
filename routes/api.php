<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FuelStationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostalCodeController;
use App\Models\FuelStation;

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
//auth routes without token

Route::post('auth/loginAdmin', [AuthController::class, 'loginAdmin']);
Route::get('states', [PostalCodeController::class, 'getStates']);
Route::get('cities', [PostalCodeController::class, 'getCities']);
Route::get('stations', [FuelStationController::class, 'index']);
//route middleware auth
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    //auth & users
    Route::get('auth/user', [AuthController::class, 'user']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('user', [UserController::class, 'store']);
    Route::prefix('users')->group(function () {
        Route::get('index', [UserController::class, 'index']);
    });


});
