<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;

class AdminController extends Controller {

    // Admin Dashboard
    public function dashboard() {
        $total_users        = User::count();
        $total_jobs         = Job::count();
        $total_applications = Application::count();
        $recent_users       = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('total_users', 'total_jobs', 'total_applications', 'recent_users'));
    }

    // Manage Users
    public function users() {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    // Delete User
    public function deleteUser($id) {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully!');
    }

    // Manage Jobs
    public function jobs() {
        $jobs = Job::with('employer')->latest()->get();
        return view('admin.jobs', compact('jobs'));
    }

    // Delete Job
    public function deleteJob($id) {
        Job::findOrFail($id)->delete();
        return back()->with('success', 'Job deleted successfully!');
    }

    // Show Post Job Form
    public function createJob() {
        return view('admin.post_job');
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

        return redirect('/admin/jobs')->with('success', 'Job posted successfully!');
    }

    // API Stats for React
    public function stats() {
        return response()->json([
            'total_users'        => User::count(),
            'total_jobs'         => Job::count(),
            'total_applications' => Application::count(),
            'recent_users'       => User::latest()->take(5)->get(),
            'recent_jobs'        => Job::with('employer')->latest()->take(5)->get(),
            'monthly_jobs'       => [
                ['month' => 'Jan', 'jobs' => 4],
                ['month' => 'Feb', 'jobs' => 7],
                ['month' => 'Mar', 'jobs' => 5],
                ['month' => 'Apr', 'jobs' => 9],
                ['month' => 'May', 'jobs' => 12],
                ['month' => 'Jun', 'jobs' => 8],
                ['month' => 'Jul', 'jobs' => 15],
                ['month' => 'Aug', 'jobs' => 11],
                ['month' => 'Sep', 'jobs' => 18],
                ['month' => 'Oct', 'jobs' => 14],
                ['month' => 'Nov', 'jobs' => 20],
                ['month' => 'Dec', 'jobs' => Job::count()],
            ],
        ]);
    }

    public function apiStoreJob(Request $request) {
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

        return response()->json(['success' => true]);
    }

    public function search(Request $request) {
        $q = $request->q;

        $users = User::where('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->get();

        $jobs = Job::with('employer')
                ->where('title', 'like', "%$q%")
                ->orWhere('location', 'like', "%$q%")
                ->get();

        return view('admin.search', compact('users', 'jobs', 'q'));
    }

    public function apiSearch(Request $request) {
        $q = $request->q;

        if (!$q || strlen($q) < 1) {
            return response()->json(['users' => [], 'jobs' => []]);
        }

        $users = User::where('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->limit(5)
                    ->get(['id', 'name', 'email', 'role']);

        $jobs = Job::where('title', 'like', "%$q%")
                ->orWhere('location', 'like', "%$q%")
                ->limit(5)
                ->get(['id', 'title', 'location', 'job_type']);

        return response()->json(['users' => $users, 'jobs' => $jobs]);
    }
}