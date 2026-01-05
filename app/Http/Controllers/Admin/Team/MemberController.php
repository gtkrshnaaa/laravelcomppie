<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->paginate(20);
        return view('admin.team.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'social_links' => 'nullable|array',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.members.index')
            ->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $member)
    {
        return view('admin.team.members.edit', compact('member'));
    }

    public function update(Request $request, TeamMember $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'social_links' => 'nullable|array',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                Storage::disk('public')->delete($member->photo);
            }
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $member->update($validated);

        return redirect()->route('admin.team.members.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $member)
    {
        if ($member->photo && Storage::disk('public')->exists($member->photo)) {
            Storage::disk('public')->delete($member->photo);
        }

        $member->delete();

        return redirect()->route('admin.team.members.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
