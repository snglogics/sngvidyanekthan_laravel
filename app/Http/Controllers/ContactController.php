<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function viewContact()
    {
        return view('contact');
    }

   public function submit(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'phone'   => 'required|string|max:15',
            'messege' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // Send acknowledgment to the user
        Mail::raw("
        Dear {$validated['name']},

        Thank you for contacting us! We have received your message and will get back to you shortly.

        Here is a copy of your submission:
        Name: {$validated['name']}
        Email: {$validated['email']}
        Phone: {$validated['phone']}
        Subject: {$validated['subject']}
        Message: {$validated['messege']}

        Regards,
        Your Sivagiri Vidya niketan Team
        ", function ($message) use ($validated) {
            $message->to($validated['email'])
                ->from(config('mail.from.address'), config('mail.from.name'))
                ->subject('Thank you for contacting us!');
        });

        // Optionally: Send a copy to admin
        Mail::raw("
        New contact form submission:

        Name: {$validated['name']}
        Email: {$validated['email']}
        Phone: {$validated['phone']}
        Subject: {$validated['subject']}
        Message: {$validated['messege']}
        ", function ($message) {
            $message->to(config('mail.from.address'))
                ->from(config('mail.from.address'), config('mail.from.name'))
                ->subject('New Contact Form Submission');
        });

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been sent, and you will receive a confirmation email.'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while sending your message: ' . $e->getMessage()
        ], 500);
    }
}


    public function getintouchSubmit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'phone'   => 'required|string|max:15',
            'messege' => 'required|string',
        ]);

        try {
            // ✅ This sends a mail *to the user*
            Mail::raw("
                Dear {$validated['name']},

                Thank you for getting in touch!

                Here’s what we received:
                Name: {$validated['name']}
                Email: {$validated['email']}
                Phone: {$validated['phone']}
                Subject: {$validated['subject']}
                Message: {$validated['messege']}

                We will contact you soon.

                Best regards,
                Your Site Team
            ", function ($message) use ($validated) {
                $message->to($validated['email']) // 👈 Send to the user's email
                    ->from(config('mail.from.address'), config('mail.from.name')) // 👈 Always set FROM
                    ->subject('Thank you for contacting us!');
            });

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent and you will receive a confirmation email.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }
}
