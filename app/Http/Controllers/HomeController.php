<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;


class HomeController extends Controller {

    public function index() {
        $jobs = Job::with('employer')->where('status', 'active')->latest()->take(6)->get();
        return view('home', compact('jobs'));
    }
}
