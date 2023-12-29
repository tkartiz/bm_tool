<?php

use App\Http\Controllers\Creator\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Creator\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Creator\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Creator\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Creator\Auth\NewPasswordController;
use App\Http\Controllers\Creator\Auth\PasswordResetLinkController;
use App\Http\Controllers\Creator\Auth\RegisteredUserController;
use App\Http\Controllers\Creator\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WorkController;
use App\Http\Controllers\Os_appdController;
use App\Http\Controllers\OutsourcingController;

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

// アプリ用
Route::resource('works', WorkController::class)
->middleware(['auth:creators']);

Route::resource('os_appds', Os_appdController::class)
->middleware(['auth:creators']);

Route::resource('outsourcings', OutsourcingController::class)
->middleware(['auth:creators']);

// アプリ用

Route::get('/', function () {
    return view('creator.welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('creator.dashboard');
})->middleware(['auth:creators'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth:creators')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

