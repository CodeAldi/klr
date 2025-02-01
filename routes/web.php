<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/','index')->name('home');
});
Route::controller(AuthenticationController::class)->group(function(){
    Route::get('/login','LoginView')->middleware('guest')->name('login');
    Route::post('/login/authenticate', 'authenticate')->middleware('guest')->name('authenticate');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
    Route::get('/register','RegisterView')->middleware('guest')->name('register');
});
