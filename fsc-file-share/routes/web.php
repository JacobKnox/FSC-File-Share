<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
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
})->name('home');

Route::controller(BugController::class)->group(function () {
    Route::get('/bug', 'create');
    Route::post('/bug', 'store');
});

Route::controller(UserController::class)->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/signup', 'signup')->name('signup');
        Route::post('/login', 'authenticate');
        Route::post('/signup', 'create');
    });

    Route::middleware(['auth', /*'verified'*/])->group(function () {
        Route::get('/logout', 'unauthenticate')->name('logout');
        Route::get('/users/{id}', 'show');
        Route::middleware(['auth.user'])->group(function () {
            Route::put('/users/{id}', 'update');
            Route::delete('/users/{id}', 'destroy');
            Route::get('/users/{id}/edit', 'edit');
        });
    });
});

Route::controller(FileController::class)->group(function () {
    Route::get('/files', 'index');
    Route::middleware(['auth'])->group(function () {
        Route::get('/files/create', 'create');
        Route::post('/files/create', 'store');
        Route::get('/files/{id}/like/id={user}', 'like');
        Route::get('/files/{id}/unlike/id={user}', 'unlike');
        Route::get('/files/{id}/download', 'download');
        Route::post('/files/{id}/comment/id={user}', 'comment');
    });
    Route::get('/files/{id}', 'show');
    Route::get('/files/{id}/preview', 'preview');
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