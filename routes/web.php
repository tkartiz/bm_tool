<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\WorkspecController;
use App\Http\Controllers\ContactController;

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
Route::resource('applications', ApplicationController::class)
->middleware(['auth:users']);

Route::resource('workspecs', WorkspecController::class)
->middleware(['auth:users']);

Route::resource('contacts', ContactController::class)
->middleware(['auth:users']);

// アプリ用


Route::get('/', function () {
    return view('user.welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

require __DIR__.'/auth.php';
