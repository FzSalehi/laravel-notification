<?php

use App\Mail\TopicCreated;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Services\Notification\Notification;

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

Route::get('/', function () {
    //Mail::to('faraz@gmail.com')->send(new TopicCreated);

    $notification = resolve(Notification::class);

    //$notification->sendEmail(User::find(1),new TopicCreated);
    $user = User::find(1);
    $notification->sendSms($user->phone_number,'slam');
    
});
