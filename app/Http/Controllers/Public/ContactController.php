<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $companyInfo = CompanySetting::first();
        return view('public.contact', compact('companyInfo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactSubmission::create($validated);

        return redirect()->back()
            ->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
