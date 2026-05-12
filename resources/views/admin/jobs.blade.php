@extends('layouts.admin')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Manage Jobs</h2>

        @if($jobs->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b text-gray-500">
                            <th class="pb-3 pr-4">#</th>
                            <th class="pb-3 pr-4">Job Title</th>
                            <th class="pb-3 pr-4">Employer</th>
                            <th class="pb-3 pr-4">Location</th>
                            <th class="pb-3 pr-4">Type</th>
                            <th class="pb-3 pr-4">Status</th>
                            <th class="pb-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $index => $job)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 pr-4 text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-3 pr-4 font-medium text-gray-800">{{ $job->title }}</td>
                            <td class="py-3 pr-4 text-gray-500">{{ $job->employer->name }}</td>
                            <td class="py-3 pr-4 text-gray-500">{{ $job->location }}</td>
                            <td class="py-3 pr-4">
                                <span class="bg-blue-50 text-blue-600 text-xs px-3 py-1 rounded-full">{{ $job->job_type }}</span>
                            </td>
                            <td class="py-3 pr-4">
                                <span class="bg-green-50 text-green-600 text-xs px-3 py-1 rounded-full">{{ $job->status }}</span>
                            </td>
                            <td class="py-3">
                                <a href="/admin/jobs/delete/{{ $job->id }}"
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
                <p class="text-gray-400">No jobs found.</p>
            </div>
        @endif
    </div>

@endsection