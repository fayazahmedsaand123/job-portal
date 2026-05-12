@extends('layouts.app')

@section('content')

<!-- Jobs Hero -->
<section class="bg-gradient-to-br from-blue-700 to-indigo-700 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Browse All Jobs</h1>
        <p class="text-blue-100 mb-8">Find the perfect job that matches your skills and passion.</p>

        <!-- Search -->
        <form method="GET" action="/jobs"
            class="bg-white rounded-2xl p-3 flex flex-col md:flex-row gap-3 max-w-3xl mx-auto">
            <input type="text" name="title" value="{{ request('title') }}" placeholder="Job Title or Keyword"
                class="flex-1 px-4 py-3 text-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400">
            <input type="text" name="location" value="{{ request('location') }}" placeholder="Location"
                class="flex-1 px-4 py-3 text-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl transition">
                Search
            </button>
        </form>
    </div>
</section>

<!-- Jobs Grid -->
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">

        <!-- Results Count -->
        <div class="flex items-center justify-between mb-8">
            <p class="text-gray-600"><span class="font-bold text-blue-600">{{ $jobs->count() }}</span> jobs found</p>
            @if(request('title') || request('location'))
                <a href="/jobs" class="text-sm text-red-500 hover:underline">Clear Search ✕</a>
            @endif
        </div>

        @if($jobs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 group">

                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($job->employer->name, 0, 1)) }}
                        </div>
                        <span class="bg-green-50 text-green-600 text-xs px-3 py-1 rounded-full">Active</span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-blue-600 transition">{{ $job->title }}</h3>
                    <p class="text-gray-500 text-sm mb-4">{{ $job->employer->name }}</p>

                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="bg-blue-50 text-blue-600 text-xs px-3 py-1 rounded-full">{{ $job->job_type }}</span>
                        <span class="bg-gray-100 text-gray-500 text-xs px-3 py-1 rounded-full">📍 {{ $job->location }}</span>
                        <span class="bg-yellow-50 text-yellow-600 text-xs px-3 py-1 rounded-full">💰 {{ $job->salary }}</span>
                    </div>

                    <p class="text-gray-400 text-xs mb-5">{{ Str::limit($job->description, 80) }}</p>

                    <a href="/jobs/{{ $job->id }}"
                        class="block text-center border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold text-sm py-2 rounded-xl transition">
                        View & Apply
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl">
                <p class="text-5xl mb-4">🔍</p>
                <p class="text-gray-400 text-lg">No jobs found. Try different keywords.</p>
                <a href="/jobs" class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded-xl">View All Jobs</a>
            </div>
        @endif
    </div>
</section>

@endsection