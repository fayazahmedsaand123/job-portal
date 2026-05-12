@extends('layouts.admin')

@section('content')

    <div style="display:flex; align-items:center; gap:12px; margin-bottom:28px;">
        <div style="width:36px; height:36px; background:linear-gradient(135deg,#7c3aed,#a78bfa); border-radius:10px; display:flex; align-items:center; justify-content:center;">
            <span style="color:white; font-size:16px;">🔍</span>
        </div>
        <h1 style="font-size:22px; font-weight:700; color:#1a1a2e; margin:0;">Search Results for "{{ $q }}"</h1>
    </div>

    <!-- Users Results -->
    <div style="background:white; border-radius:16px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.06); margin-bottom:24px;">
        <h3 style="margin:0 0 16px; font-size:15px; font-weight:600; color:#1a1a2e;">👥 Users ({{ $users->count() }})</h3>

        @if($users->count() > 0)
            <table style="width:100%; border-collapse:collapse; font-size:13px;">
                <thead>
                    <tr style="border-bottom:2px solid #f7f7f7;">
                        <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Name</th>
                        <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Email</th>
                        <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Role</th>
                        <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr style="border-bottom:1px solid #f7f7f7;">
                        <td style="padding:12px 10px; font-weight:500; color:#1a1a2e;">{{ $user->name }}</td>
                        <td style="padding:12px 10px; color:#718096;">{{ $user->email }}</td>
                        <td style="padding:12px 10px;">
                            @if($user->role == 'admin')
                                <span style="background:#fff0f6; color:#d53f8c; font-size:11px; padding:4px 10px; border-radius:20px;">Admin</span>
                            @elseif($user->role == 'employer')
                                <span style="background:#ebf8ff; color:#3182ce; font-size:11px; padding:4px 10px; border-radius:20px;">Employer</span>
                            @else
                                <span style="background:#f0fff4; color:#38a169; font-size:11px; padding:4px 10px; border-radius:20px;">Candidate</span>
                            @endif
                        </td>
                        <td style="padding:12px 10px;">
                            @if($user->role != 'admin')
                                <a href="/admin/users/delete/{{ $user->id }}"
                                    onclick="return confirm('Delete this user?')"
                                    style="background:#fff5f5; color:#e53e3e; font-size:11px; padding:4px 12px; border-radius:8px; text-decoration:none;">
                                    Delete
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color:#a0aec0; font-size:13px;">No users found for "{{ $q }}"</p>
        @endif
    </div>

    <!-- Jobs Results -->
    <div style="background:white; border-radius:16px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
        <h3 style="margin:0 0 16px; font-size:15px; font-weight:600; color:#1a1a2e;">💼 Jobs ({{ $jobs->count() }})</h3>

        @if($jobs->count() > 0)
            <table style="width:100%; border-collapse:collapse; font-size:13px;">
                <thead>
                    <tr style="border-bottom:2px solid #f7f7f7;">
                        <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Title</th>
                        <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Employer</th>
                        <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Location</th>
                        <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr style="border-bottom:1px solid #f7f7f7;">
                        <td style="padding:12px 10px; font-weight:500; color:#1a1a2e;">{{ $job->title }}</td>
                        <td style="padding:12px 10px; color:#718096;">{{ $job->employer->name }}</td>
                        <td style="padding:12px 10px; color:#718096;">{{ $job->location }}</td>
                        <td style="padding:12px 10px;">
                            <a href="/admin/jobs/delete/{{ $job->id }}"
                                onclick="return confirm('Delete this job?')"
                                style="background:#fff5f5; color:#e53e3e; font-size:11px; padding:4px 12px; border-radius:8px; text-decoration:none;">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color:#a0aec0; font-size:13px;">No jobs found for "{{ $q }}"</p>
        @endif
    </div>
@endsection