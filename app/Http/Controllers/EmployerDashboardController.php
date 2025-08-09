<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerDashboardController extends Controller
{
    public function index()
    {
        $employer = Auth::user()->employer;

        $jobs = Job::where('employer_id', $employer->id)
                    ->latest()
                    ->paginate(6); // 6 per page for a nice grid

        return view('employer.dashboard', compact('jobs'));
    }
}

