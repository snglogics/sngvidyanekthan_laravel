<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadEvents;
use App\Models\Announcement;
use App\Models\Slider;
use App\Models\PrincipalMsg;
use App\Models\upcoming_events; 
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller {
    public function viewContact()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'phone'   => 'required|string|max:15',
            'messege' => 'required|string',
        ]);

        // Example: send to your email (you can use a mailable if needed)
      try {
    Mail::raw("
        Name: {$request->name}
        Email: {$request->email}
        Phone: {$request->phone}
        Subject: {$request->subject}
        Message: {$request->messege}
    ", function ($message) {
        $message->to(env('MAIL_FROM_ADDRESS'))
                ->subject('New Contact Form Submission');
    });

    return redirect()->back()->with('success', 'Thank you! Your message has been sent.');

} catch (\Exception $e) {
    return redirect()->back()->with('error', 'Mail failed to send: ' . $e->getMessage());
}


}
}