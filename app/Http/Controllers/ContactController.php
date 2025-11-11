<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormReceived;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        // Auto-generate subject for database storage
        $validated['subject'] = 'Contact Form Enquiry';

        // Add metadata
        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        // Save to database
        $submission = ContactSubmission::create($validated);

        // Send emails synchronously
        try {
            // Admin notification
            Mail::to(config('mail.admin_email', 'info@hub-base.co.uk'))
                ->send(new ContactFormSubmitted($submission));

            // Customer confirmation
            Mail::to($validated['email'])
                ->send(new ContactFormReceived($submission));

            return redirect('/#contact')->with('success', 'Thank you for contacting us! We\'ve sent you a confirmation email and will respond within 24-48 hours.');
        } catch (\Exception $e) {
            // Log error but still show success to user (submission was saved)
            Log::error('Contact form email failed: ' . $e->getMessage());

            return redirect('/#contact')->with('success', 'Thank you for contacting us! We will get back to you soon.');
        }
    }
}
