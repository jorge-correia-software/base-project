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
        // Honeypot check - silently reject bot submissions
        if ($request->filled('website')) {
            // Bot filled the honeypot field - pretend success but don't save/email
            return redirect('/#contact')->with('success', 'Thank you for contacting us! We will get back to you soon.');
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Z\s\-\'\.]+$/', // Only letters, spaces, hyphens, apostrophes, dots
            ],
            'email' => 'required|email|max:255',
            'message' => [
                'required',
                'max:5000',
                function ($attribute, $value, $fail) {
                    // Block common XSS and injection patterns
                    $malicious_patterns = [
                        '/<script/i',
                        '/javascript:/i',
                        '/on\w+\s*=/i', // onclick, onerror, onload, etc.
                        '/<iframe/i',
                        '/eval\(/i',
                        '/expression\(/i',
                        '/vbscript:/i',
                    ];

                    foreach ($malicious_patterns as $pattern) {
                        if (preg_match($pattern, $value)) {
                            $fail('The message contains invalid content.');
                        }
                    }
                },
            ],
            'website' => 'nullable', // Honeypot field (should be empty)
        ]);

        // Sanitize inputs - strip HTML tags and trim whitespace
        $validated['name'] = strip_tags(trim($validated['name']));
        $validated['email'] = strip_tags(trim($validated['email']));
        $validated['message'] = strip_tags(trim($validated['message']));

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
