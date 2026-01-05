<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Models\CompanySetting;

class AboutController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('order')->get();
        $companyInfo = CompanySetting::first();

        return view('public.about', compact('teamMembers', 'companyInfo'));
    }
}
