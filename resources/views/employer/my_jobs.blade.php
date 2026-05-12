@extends('layouts.employer')

@section('content')

<div class="bg-white rounded-2xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">My Jobs</h2>
        <a href="/employer/post-job"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm transition">
            ➕ Post New Job
        </a>
    </div>

    @if($jobs->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b text-gray-500 text-sm">
                        <th class="pb-3 pr-4">#</th>
                        <th class="pb-3 pr-4">Title</th>
                        <th class="pb-3 pr-4">Location</th>
                        <th class="pb-3 pr-4">Type</th>
                        <th class="pb-3 pr-4">Status</th>
                        <th class="pb-3 pr-4">Applicants</th>
                        <th class="pb-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $index => $job)
                    <tr class="border-b hover:bg-gray-50 text-sm">
                        <td class="py-3 pr-4 text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3 pr-4 font-medium text-gray-800">{{ $job->title }}</td>
                        <td class="py-3 pr-4 text-gray-500">{{ $job->location }}</td>
                        <td class="py-3 pr-4">
                            <span class="bg-blue-50 text-blue-600 text-xs px-2 py-1 rounded-full">{{ $job->job_type }}</span>
                        </td>
                        <td class="py-3 pr-4">
                            <span class="bg-green-50 text-green-600 text-xs px-2 py-1 rounded-full">{{ $job->status }}</span>
                        </td>
                        <td class="py-3 pr-4">
                            <a href="/employer/applicants/{{ $job->id }}"
                                class="text-blue-500 hover:underline text-xs">
                                {{ $job->applications->count() }} applicants
                            </a>
                        </td>
                        <td class="py-3">
                            <a href="/employer/delete-job/{{ $job->id }}"
                                onclick="return confirm('Delete this job?')"
                                class="bg-red-100 hover:bg-red-200 text-red-600 text-xs px-3 py-1 rounded-lg transition">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-16">
            <p class="text-4xl mb-4">💼</p>
            <p class="text-gray-400 text-lg">You have not posted any jobs yet.</p>
            <a href="/employer/post-job"
                class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">
                Post Your First Job
            </a>
        </div>
    @endif
</div>

@endsection