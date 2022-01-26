<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\DataController;

use App\Http\Controllers\API\NetizenController;
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


// api daftar dan login pengguna 
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

// api login satgas

Route::post('loginsat', [RegisterController::class, 'loginsat']);



Route::middleware('auth:Pengguna')->group(function () {

    Route::get('jeniskaduan', [DataController::class, 'jeniskaduan']);
    Route::post('postkaduan', [DataController::class, 'postkaduan']);
    Route::get('getkaduan', [DataController::class, 'getkaduan']);
    Route::get('getkaduanbyid', [DataController::class, 'getkaduanbyid']);
});
