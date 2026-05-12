@extends('layouts.employer')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

    <!-- Total Jobs -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-blue-500">
        <p class="text-gray-500 text-sm mb-1">Total Jobs Posted</p>
        <h2 class="text-4xl font-bold text-blue-600">{{ $total_jobs }}</h2>
        <a href="/employer/my-jobs" class="text-sm text-blue-500 hover:underline mt-2 block">View all jobs →</a>
    </div>

    <!-- Total Applications -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-green-500">
        <p class="text-gray-500 text-sm mb-1">Total Applications Received</p>
        <h2 class="text-4xl font-bold text-green-600">{{ $total_applications }}</h2>
    </div>

</div>

<!-- Quick Actions -->
<div class="bg-white rounded-2xl shadow-sm p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
    <div class="flex flex-wrap gap-4">
        <a href="/employer/post-job"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">
            ➕ Post a New Job
        </a>
        <a href="/employer/my-jobs"
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl transition">
            💼 View My Jobs
        </a>
    </div>
</div>

@endsection