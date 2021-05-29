<?php

use App\Http\Controllers\NotificationsController;
use App\Mail\TopicCreated;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Services\Notification\Notification;
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
Route::get('/notify/email', [NotificationsController::class, 'form'])->name('notification.form');
Route::post('/notify/email', [NotificationsController::class, 'byEmail'])->name('notification.notify');
