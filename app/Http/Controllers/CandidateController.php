<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;

class CandidateController extends Controller {

    // Candidate Dashboard
    public function dashboard() {
        $candidate_id = session('login_id');
        $applications = Application::with('job')->where('candidate_id', $candidate_id)->latest()->get();
        return view('candidate.dashboard', compact('applications'));
    }

    // Show All Jobs with Search
    public function jobs(Request $request) {
        $query = Job::with('employer')->where('status', 'active');

        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $jobs = $query->latest()->get();
        return view('candidate.jobs', compact('jobs'));
    }

    // Show Single Job
    public function showJob($id) {
        $job = Job::with('employer')->findOrFail($id);
        $already_applied = Application::where('job_id', $id)
            ->where('candidate_id', session('login_id'))
            ->exists();
        return view('candidate.show_job', compact('job', 'already_applied'));
    }

    // Apply for Job
    public function applyJob(Request $request, $job_id) {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Check already applied
        $already_applied = Application::where('job_id', $job_id)
            ->where('candidate_id', session('login_id'))
            ->exists();

        if ($already_applied) {
            return back()->with('error', 'You already applied for this job.');
        }

        // Save Resume
        $resume_path = $request->file('resume')->store('resumes', 'public');

        Application::create([
            'job_id'              => $job_id,
            'candidate_id'        => session('login_id'),
            'resume_path'         => $resume_path,
            'application_status'  => 'pending',
        ]);

        return redirect('/candidate/dashboard')->with('success', 'Application submitted successfully!');
    }
}