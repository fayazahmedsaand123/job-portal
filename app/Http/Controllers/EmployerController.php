<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;

class EmployerController extends Controller {

    // Dashboard
    public function dashboard() {
        $employer_id = session('login_id');
        $total_jobs = Job::where('employer_id', $employer_id)->count();
        $total_applications = Application::whereHas('job', function($q) use ($employer_id) {
            $q->where('employer_id', $employer_id);
        })->count();

        return view('employer.dashboard', compact('total_jobs', 'total_applications'));
    }

    // My Jobs List
    public function myJobs() {
        $jobs = Job::where('employer_id', session('login_id'))->latest()->get();
        return view('employer.my_jobs', compact('jobs'));
    }

    // Show Post Job Form
    public function createJob() {
        return view('employer.post_job');
    }

    // Save Job to Database
    public function storeJob(Request $request) {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'salary'      => 'required|string|max:100',
            'job_type'    => 'required|in:Full-time,Part-time,Remote,Freelance',
        ]);

        Job::create([
            'employer_id' => session('login_id'),
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'salary'      => $request->salary,
            'job_type'    => $request->job_type,
            'status'      => 'active',
        ]);

        return redirect('/employer/my-jobs')->with('success', 'Job posted successfully!');
    }

    // Delete Job
    public function deleteJob($id) {
        $job = Job::where('id', $id)->where('employer_id', session('login_id'))->firstOrFail();
        $job->delete();
        return redirect('/employer/my-jobs')->with('success', 'Job deleted successfully!');
    }

    // View Applicants
    public function applicants($job_id) {
        $job = Job::where('id', $job_id)->where('employer_id', session('login_id'))->firstOrFail();
        $applications = Application::with('candidate')->where('job_id', $job_id)->get();
        return view('employer.applicants', compact('job', 'applications'));
    }

    // Update Applicant Status
    public function updateStatus(Request $request, $id) {
        $application = Application::findOrFail($id);
        $application->application_status = $request->status;
        $application->save();
        return back()->with('success', 'Status updated!');
    }
}