<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Jobs\SendSms;
use App\Models\User;
use App\Services\Notification\Constants\EmailTypes;
use App\Services\Notification\Notification;
use Exception;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    private $notification;
    public function __construct()
    {
        $this->middleware('auth');
        $this->notification = resolve(Notification::class);
    }

    public function EmailForm()
    {
        $users = User::all(['id', 'name']);
        $email_types = EmailTypes::toFarsi();
        return view('notifications.email', compact('users', 'email_types'));
    }

    public function sendEmail(Request $request)
    {

        $request = $this->validateRequest($request);
        try{

            $emailType = EmailTypes::getMailClass($request['email_type']);
            SendEmail::dispatch(auth()->user(),new $emailType($request['message']));
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

    public function smsForm()
    {
        $users = User::all(['id', 'name']);
        return view('notifications.sms', compact('users'));
    }

    public function sendSms(Request $request)
    {
        $request = $this->validateRequestSms($request);

        try{
            //SendSms::dispatch(auth()->user(),$request['message']);
            $this->notification->sendSms(auth()->user(),$request['message']);
            return redirect()->back()->with([
                'success' => __('sms.sent_successfully'),
            ]);
        }catch(\Throwable $e)
        {
            return redirect()->back()->with([
                'failed' => __('sms.sent_failed'),
            ]);
        }

    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'user' => ['required', 'integer', 'exists:users,id'],
            'email_type' => ['required', 'integer'],
            'message' => 'string',
        ]);
    }

    private function validateRequestSms(Request $request)
    {
        return $request->validate([
            'user' => ['required', 'integer', 'exists:users,id'],
            'message' => ['required','string'],
        ]);
    }
}
