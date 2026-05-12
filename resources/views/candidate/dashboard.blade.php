@extends('layouts.candidate')

@section('content')

<div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-800 mb-2">My Applications</h2>
    <p class="text-gray-500 text-sm">Track all your job applications here.</p>
</div>

@if($applications->count() > 0)
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="pb-3 pr-4">#</th>
                        <th class="pb-3 pr-4">Job Title</th>
                        <th class="pb-3 pr-4">Company</th>
                        <th class="pb-3 pr-4">Applied Date</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $index => $app)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 pr-4 text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3 pr-4 font-medium text-gray-800">{{ $app->job->title }}</td>
                        <td class="py-3 pr-4 text-gray-500">{{ $app->job->employer->name }}</td>
                        <td class="py-3 pr-4 text-gray-500">{{ $app->created_at->format('d M Y') }}</td>
                        <td class="py-3">
                            @if($app->application_status == 'pending')
                                <span class="bg-yellow-50 text-yellow-600 text-xs px-3 py-1 rounded-full">Pending</span>
                            @elseif($app->application_status == 'accepted')
                                <span class="bg-green-50 text-green-600 text-xs px-3 py-1 rounded-full">Accepted</span>
                            @else
                                <span class="bg-red-50 text-red-500 text-xs px-3 py-1 rounded-full">Rejected</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="bg-white rounded-2xl shadow-sm p-16 text-center">
        <p class="text-4xl mb-4">📭</p>
        <p class="text-gray-400 text-lg">You have not applied for any jobs yet.</p>
        <a href="/candidate/jobs"
            class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">
            Browse Jobs
        </a>
    </div>
@endif

@endsection