@extends('layouts.employer')

@section('content')

<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-2">Applicants for: {{ $job->title }}</h2>
    <p class="text-gray-500 text-sm mb-6">{{ $applications->count() }} total applicants</p>

    @if($applications->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="pb-3 pr-4">#</th>
                        <th class="pb-3 pr-4">Candidate Name</th>
                        <th class="pb-3 pr-4">Email</th>
                        <th class="pb-3 pr-4">Resume</th>
                        <th class="pb-3 pr-4">Applied Date</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $index => $app)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 pr-4 text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3 pr-4 font-medium text-gray-800">{{ $app->candidate->name }}</td>
                        <td class="py-3 pr-4 text-gray-500">{{ $app->candidate->email }}</td>
                        <td class="py-3 pr-4">
                            <a href="/storage/{{ $app->resume_path }}" target="_blank"
                                class="text-blue-500 hover:underline">Download</a>
                        </td>
                        <td class="py-3 pr-4 text-gray-500">{{ $app->created_at->format('d M Y') }}</td>
                        <td class="py-3">
                            <form method="POST" action="/employer/applicants/status/{{ $app->id }}">
                                @csrf
                                <select name="status" onchange="this.form.submit()"
                                    class="border border-gray-200 rounded-lg px-2 py-1 text-sm focus:outline-none">
                                    <option value="pending" {{ $app->application_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="accepted" {{ $app->application_status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                    <option value="rejected" {{ $app->application_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-16">
            <p class="text-4xl mb-4">📭</p>
            <p class="text-gray-400">No one has applied for this job yet.</p>
        </div>
    @endif
</div>

@endsection