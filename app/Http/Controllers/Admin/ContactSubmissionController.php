<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::latest()->paginate(20);
        return view('admin.contact-submissions.index', compact('submissions'));
    }

    public function show(ContactSubmission $submission)
    {
        return view('admin.contact-submissions.show', compact('submission'));
    }

    public function markAsRead(ContactSubmission $submission)
    {
        $submission->markAsRead();

        return back()->with('success', 'Marked as read');
    }

    public function markAsReplied(ContactSubmission $submission)
    {
        $submission->markAsReplied();

        return back()->with('success', 'Marked as replied');
    }

    public function destroy(ContactSubmission $submission)
    {
        $submission->delete();

        return redirect()->route('admin.contact-submissions.index')
            ->with('success', 'Submission deleted successfully');
    }
}
