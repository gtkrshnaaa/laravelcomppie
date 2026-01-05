<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::withCount('applications')->latest()->paginate(20);
        return view('admin.career.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.career.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full_time,part_time,contract,internship',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        Job::create($validated);

        return redirect()->route('admin.career.jobs.index')
            ->with('success', 'Job posting created successfully.');
    }

    public function edit(Job $job)
    {
        return view('admin.career.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full_time,part_time,contract,internship',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        $job->update($validated);

        return redirect()->route('admin.career.jobs.index')
            ->with('success', 'Job posting updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.career.jobs.index')
            ->with('success', 'Job posting deleted successfully.');
    }
}
