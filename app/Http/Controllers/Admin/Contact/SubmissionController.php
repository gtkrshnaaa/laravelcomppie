<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::latest()->paginate(20);
        return view('admin.contact.submissions.index', compact('submissions'));
    }

    public function show(ContactSubmission $submission)
    {
        // Mark as read
        if (!$submission->read_at) {
            $submission->update(['read_at' => now()]);
        }

        return view('admin.contact.submissions.show', compact('submission'));
    }

    public function destroy(ContactSubmission $submission)
    {
        $submission->delete();

        return redirect()->route('admin.contact.submissions.index')
            ->with('success', 'Contact submission deleted successfully.');
    }

    public function markAsRead(ContactSubmission $submission)
    {
        $submission->update(['read_at' => now()]);

        return redirect()->back()
            ->with('success', 'Marked as read.');
    }

    public function markAsUnread(ContactSubmission $submission)
    {
        $submission->update(['read_at' => null]);

        return redirect()->back()
            ->with('success', 'Marked as unread.');
    }
}
