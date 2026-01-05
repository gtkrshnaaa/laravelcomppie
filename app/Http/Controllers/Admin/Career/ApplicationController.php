<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with('job')->latest()->paginate(20);
        return view('admin.career.applications.index', compact('applications'));
    }

    public function show(JobApplication $application)
    {
        return view('admin.career.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,shortlisted,accepted,rejected',
            'notes' => 'nullable|string',
        ]);

        $application->update($validated);

        return redirect()->back()
            ->with('success', 'Application status updated successfully.');
    }

    public function downloadResume(JobApplication $application)
    {
        if ($application->resume_path && Storage::disk('public')->exists($application->resume_path)) {
            return Storage::disk('public')->download($application->resume_path);
        }

        return redirect()->back()
            ->with('error', 'Resume file not found.');
    }

    public function destroy(JobApplication $application)
    {
        if ($application->resume_path && Storage::disk('public')->exists($application->resume_path)) {
            Storage::disk('public')->delete($application->resume_path);
        }

        $application->delete();

        return redirect()->route('admin.career.applications.index')
            ->with('success', 'Application deleted successfully.');
    }
}
