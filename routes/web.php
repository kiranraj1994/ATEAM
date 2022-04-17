<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/statistics', [App\Http\Controllers\HomeController::class, 'statistics']);

Route::get('/login', [App\Http\Controllers\UserController::class, 'index']);
Route::post('/login-form', [App\Http\Controllers\UserController::class, 'auth'])->name('user.login-form');
Route::get('/sign-up', [App\Http\Controllers\UserController::class, 'create']);
Route::post('/register', [App\Http\Controllers\UserController::class, 'store'])->name('user.register');
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout']);




Route::group(['middleware'=>'user_auth'],function(){
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/userEventList', [App\Http\Controllers\DashboardController::class, 'userEventList'])->name('userEventList');
    Route::get('/add-event', [App\Http\Controllers\DashboardController::class, 'create']);
    Route::post('/add-event-form', [App\Http\Controllers\DashboardController::class, 'store'])->name('add-event-form');
    Route::post('/update-event-form/{id}', [App\Http\Controllers\DashboardController::class, 'update'])->name('update-event-form');
    Route::get('/edit-event/{id}', [App\Http\Controllers\DashboardController::class, 'edit']);
    Route::post('/event-multitask', [App\Http\Controllers\DashboardController::class, 'multitask'])->name('event-multitask');
    Route::get('/event-status/{status}/{id}', [App\Http\Controllers\DashboardController::class, 'event_status']);
    
    Route::get('/inviteUser/{id}', [App\Http\Controllers\InviteUserController::class, 'index'])->name('inviteUser');
    Route::get('/ajaxinviteUserList', [App\Http\Controllers\InviteUserController::class, 'ajaxinviteUserList'])->name('ajaxinviteUserList');
    Route::get('/add-inviteUser/{id}', [App\Http\Controllers\InviteUserController::class, 'create']);
    Route::post('/add-inviteUser-form', [App\Http\Controllers\InviteUserController::class, 'store'])->name('add-inviteUser-form');
    Route::post('/update-inviteUser-form/{id}', [App\Http\Controllers\InviteUserController::class, 'update'])->name('update-inviteUser-form');
    Route::get('/edit-inviteUser/{id}', [App\Http\Controllers\InviteUserController::class, 'edit']);
    Route::post('/inviteUser-multitask', [App\Http\Controllers\InviteUserController::class, 'multitask'])->name('inviteUser-multitask');
    Route::get('/inviteUser-status/{status}/{id}', [App\Http\Controllers\InviteUserController::class, 'inviteUser_status']);
});