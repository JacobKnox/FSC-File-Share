<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BugController;
use App\Http\Controllers\EmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::controller(BugController::class)->group(function () {
    Route::get('/bug', 'create');
    Route::post('/bug', 'store');
});

Route::controller(UserController::class)->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', 'login');
        Route::get('/signup', 'signup');
        Route::post('/login', 'authenticate');
        Route::post('/signup', 'create');
    });

    Route::middleware(['auth', /*'verified'*/])->group(function () {
        Route::get('/logout', 'unauthenticate');
    });
});

/*
Route::controller(EmailController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/email/verify', 'notice')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['signed'])->name('verification.verify');
        Route::post('/email/verification-notification', 'send')->middleware(['throttle:6,1'])->name('verification.send');
    });
});
*/