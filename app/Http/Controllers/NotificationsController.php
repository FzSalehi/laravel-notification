<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Notification\Constants\EmailTypes;
use App\Services\Notification\Notification;
use Exception;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function form()
    {
        $users = User::all(['id', 'name']);
        // get email types
        $email_types = EmailTypes::toFarsi();
        return view('notifications.email', compact('users', 'email_types'));
    }

    public function byEmail(Request $request)
    {

        $request = $request->validate([
            'user' => ['required', 'integer', 'exists:users,id'],
            'email_type' => ['required', 'integer'],
            'message' => 'string',
        ]);
        try{
            $notification = resolve(Notification::class);
            $emailType = EmailTypes::getMailClass($request['email_type']);
            $notification->sendEmail(auth()->user(),new $emailType($request['message']));
            return redirect()->back()->with([
                'success' => __('email.sent_successfully'),
            ]);
        }catch(\Throwable $e)
        {
            return redirect()->back()->with([ 
                'failed' => __('email.sent_failed'),
            ]);
        }
        
    }
}
