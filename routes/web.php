<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResepController;

use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
    return view('index');
})->name('login');

Route::get('/register', function(){
    return view('register');
})->name('register');

Route::post('/auth', [UserController::class, 'authenticate'])->name('auth');
Route::post('/signin', [UserController::class, 'store'])->name('signin');


Route::middleware(['auth'])->group(function(){
    Route::get('/app', [UserController::class, 'main'])->name('app');
    Route::post('/app/retrieve', [UserController::class, 'retrieve']);

    Route::post('/app/pasien/retrieve', [PasienController::class, 'lookForEmail']);
    Route::post('/app/pasien/history', [AppointmentController::class, 'getHistoryPasien']);

    Route::post('/app/dokter/retrieve', [DokterController::class, 'lookForEmail']);

    Route::post('/app/farmasi/retrieve', [FarmasiController::class, 'lookForEmail']);
    Route::post('/app/farmasi/history', [FarmasiController::class, 'getHistoryPasien']);

    Route::post('/app/appointment/queue/get', [AppointmentController::class, 'getQueueData']);
    Route::post('/app/appointment/queue/add', [AppointmentController::class, 'bookQueue']);
    Route::post('/app/appointment/queue/update', [AppointmentController::class, 'updateQueue']);
    Route::post('/app/appointment/queue/delete', [AppointmentController::class, 'deleteQueue']);
    Route::post('/app/appointment/queue/history', [AppointmentController::class, 'queueHistory']);

    Route::post('/app/resep/request', [ResepController::class, 'requestResep']);
    Route::post('/app/resep/get', [ResepController::class, 'getResep']);
    Route::post('/app/resep/queue', [ResepController::class, 'getQueue']);
    Route::post('/app/resep/update', [ResepController::class, 'updateQueue']);

    Route::post('/app/pasien/list', [PasienController::class, 'index']);
    Route::post('/app/dokter/list', [DokterController::class, 'index']);
    Route::post('/app/farmasi/list', [FarmasiController::class, 'index']);
    Route::post('/app/appointment/list', [AppointmentController::class, 'index']);

    Route::get('/app/pasien/data/{a}', function(){
        return view('app');
    })->where('a', '.*');

    Route::get('/app/dokter/data/{a}', function(){
        return view('app');
    })->where('a', '.*');

    Route::get('/app/farmasi/data/{a}', function(){
        return view('app');
    })->where('a', '.*');
});
