<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DataopdController;
use App\Http\Controllers\Admin\JeniskaduanController;
use App\Http\Controllers\Admin\AdminopdController;
use App\Http\Controllers\Admin\SatgasController;

use App\Http\Controllers\User\UjeniskaduanController;
use App\Http\Controllers\User\UsatgasController;
use App\Http\Controllers\User\UkaduanController;
use App\Http\Controllers\User\UmapskaduanController;
// route user



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

URL::forceScheme('https');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth'])->group(function () {


    // route admin atau superadmin
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->prefix('superadmin')->group(function () {
        Route::get('admin', [AdminController::class, 'index']);
        Route::resource('opd', DataopdController::class);
        Route::resource('jeniskaduan', JeniskaduanController::class);
        Route::resource('adminopd', AdminopdController::class);
        Route::resource('satgas', SatgasController::class);
    });





    // route grub user opd
    Route::middleware(['opd'])->prefix('adminopd')->group(function () {
        Route::get('home', [UserController::class, 'index']);
        Route::resource('ujeniskaduan', UjeniskaduanController::class);
        Route::resource('usatgas', UsatgasController::class);
        Route::post('anggota/api/fetch-cities', [UsatgasController::class, 'fetchCity']);
        Route::resource('ukaduan', UkaduanController::class);
        Route::resource('umapskaduan', UmapskaduanController::class);
    });


    //route logout

    Route::get('/logout', function () {
        Auth::logout();
        redirect('/');
    });
});
