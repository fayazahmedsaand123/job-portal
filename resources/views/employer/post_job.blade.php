@extends('layouts.employer')

@section('content')

<div class="bg-white rounded-2xl shadow-sm p-8 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Post a New Job</h2>

    <form method="POST" action="/employer/post-job">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-600 mb-1 text-sm">Job Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 mb-1 text-sm">Location</label>
            <input type="text" name="location" value="{{ old('location') }}"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 mb-1 text-sm">Salary</label>
            <input type="text" name="salary" value="{{ old('salary') }}" placeholder="e.g. 50,000 PKR"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('salary') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 mb-1 text-sm">Job Type</label>
            <select name="job_type"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Remote">Remote</option>
                <option value="Freelance">Freelance</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-600 mb-1 text-sm">Job Description</label>
            <textarea name="description" rows="5"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
            Publish Job
        </button>
    </form>
</div>

@endsection