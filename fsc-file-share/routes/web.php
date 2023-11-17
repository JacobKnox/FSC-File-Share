<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\BugController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Models\Bug;
use App\Models\Report;
use App\Models\File;
use App\Models\User;
// use App\Http\Controllers\EmailController;

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
        Route::get('/users/{user_id}', 'show');
        Route::get('/users/settings/{user_id}', 'edit');
        Route::put('/users/{user_id}', 'update');
        Route::put('/users/{user_id}/password', 'changePassword');
        Route::delete('/users/{user_id}', 'destroy');
    });
});

Route::controller(FileController::class)->group(function () {
    Route::get('/files', 'index');
    Route::post('/files', 'filter');
    Route::middleware(['auth'])->group(function () {
        Route::get('/files/create', 'create');
        Route::post('/files/create', 'store');
        Route::get('/files/{file_id}/download', 'download');
        Route::delete('/files/{file_id}', 'destroy');
        Route::put('/files/{file_id}', 'update');
    });
    Route::get('/files/{file_id}', 'show');
    Route::get('/files/{file_id}/preview', 'preview');
});

Route::controller(LikeController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/files/{file_id}/like/id={user_id}', 'store');
        Route::get('/files/{file_id}/unlike/id={user_id}', 'destroy');
    });
});

Route::controller(ReportController::class)->group(function () {
    Route::get('/report/{type}/{reported_id}', 'store');
});

Route::controller(CommentController::class)->middleware(['auth'])->group(function () {
    Route::post('/files/{file_id}/comments/{user_id}', 'store');
    Route::middleware(['auth.user'])->group(function () {
        Route::put('/files/comments/{comment_id}', 'update');
        Route::delete('/files/comments/{comment_id}', 'destroy');
    });
});

Route::middleware(['auth:moderator'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', ['bugs' => Bug::all(), 'automod' => Report::where('reporter', '=', 0)->get(), 'reports' => Report::where('reporter', '>', 0)->get()]);
    })->name('dashboard');
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