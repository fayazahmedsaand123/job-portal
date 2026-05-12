@extends('layouts.candidate')

@section('content')

<div class="bg-white rounded-2xl shadow-sm p-8 max-w-3xl">

    <!-- Job Header -->
    <div class="flex items-start gap-4 mb-6">
        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 font-bold text-xl">
            {{ strtoupper(substr($job->employer->name, 0, 1)) }}
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $job->title }}</h2>
            <p class="text-gray-500">{{ $job->employer->name }}</p>
        </div>
    </div>

    <!-- Job Details -->
    <div class="flex flex-wrap gap-3 mb-6">
        <span class="bg-blue-50 text-blue-600 px-4 py-2 rounded-full text-sm">{{ $job->job_type }}</span>
        <span class="bg-gray-100 text-gray-600 px-4 py-2 rounded-full text-sm">📍 {{ $job->location }}</span>
        <span class="bg-green-50 text-green-600 px-4 py-2 rounded-full text-sm">💰 {{ $job->salary }}</span>
    </div>

    <!-- Description -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Job Description</h3>
        <p class="text-gray-600 leading-relaxed">{{ $job->description }}</p>
    </div>

    <!-- Apply Section -->
    @if($already_applied)
        <div class="bg-green-50 text-green-600 px-6 py-4 rounded-xl text-center font-medium">
            ✅ You have already applied for this job.
        </div>
    @else
        <div class="border-t pt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Apply for this Job</h3>
            <form method="POST" action="/candidate/jobs/{{ $job->id }}/apply" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-600 mb-1 text-sm">Upload Resume (PDF, DOC, DOCX)</label>
                    <input type="file" name="resume"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('resume') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
                    Submit Application
                </button>
            </form>
        </div>
    @endif
</div>

@endsection