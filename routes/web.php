<?php

use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::view('/','welcome');

Route::view('/home', 'home');
Route::get('/notify/email', [NotificationsController::class, 'EmailForm'])->name('notification.emailForm');
Route::post('/notify/email', [NotificationsController::class, 'sendEmail'])->name('notification.sendEmail');


Route::get('/notify/sms',[NotificationsController::class,'SmsForm'])->name('notification.smsForm');
Route::post('/notify/sms',[NotificationsController::class,'sendSms'])->name('notification.sendSms');
