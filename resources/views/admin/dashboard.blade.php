@extends('layouts.admin')

@section('content')

    <!-- Page Title -->
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:28px;">
        <div style="width:36px; height:36px; background:linear-gradient(135deg,#7c3aed,#a78bfa); border-radius:10px; display:flex; align-items:center; justify-content:center;">
            <span style="color:white; font-size:16px;">🏠</span>
        </div>
        <h1 style="font-size:22px; font-weight:700; color:#1a1a2e; margin:0;">Dashboard</h1>
    </div>

    <!-- Stat Cards -->
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px; margin-bottom:32px;">

        <a href="/admin/users" style="text-decoration:none;">
            <div class="stat-card card-pink" style="cursor:pointer;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="margin:0 0 8px; font-size:13px; opacity:0.9;">Total Users</p>
                        <h2 style="margin:0 0 12px; font-size:32px; font-weight:700;">{{ $total_users }}</h2>
                        <p style="margin:0; font-size:12px; opacity:0.85;">↑ Active members</p>
                    </div>
                    <span style="font-size:36px; z-index:1;">👥</span>
                </div>
            </div>
        </a>

        <a href="/admin/jobs" style="text-decoration:none;">
            <div class="stat-card card-blue" style="cursor:pointer;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="margin:0 0 8px; font-size:13px; opacity:0.9;">Total Jobs</p>
                        <h2 style="margin:0 0 12px; font-size:32px; font-weight:700;">{{ $total_jobs }}</h2>
                        <p style="margin:0; font-size:12px; opacity:0.85;">↑ Jobs posted</p>
                    </div>
                    <span style="font-size:36px; z-index:1;">💼</span>
                </div>
            </div>
        </a>

        <a href="/admin/jobs" style="text-decoration:none;">
            <div class="stat-card card-teal" style="cursor:pointer;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="margin:0 0 8px; font-size:13px; opacity:0.9;">Total Applications</p>
                        <h2 style="margin:0 0 12px; font-size:32px; font-weight:700;">{{ $total_applications }}</h2>
                        <p style="margin:0; font-size:12px; opacity:0.85;">↑ Applications received</p>
                    </div>
                    <span style="font-size:36px; z-index:1;">📄</span>
                </div>
            </div>
        </a>

    </div>
    <!-- Charts Row -->
    <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px; margin-bottom:32px;">

        <!-- Bar Chart -->
        <div style="background:white; border-radius:16px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h3 style="margin:0; font-size:15px; font-weight:600; color:#1a1a2e;">Visit And Job Statistics</h3>
                <div style="display:flex; gap:12px; font-size:12px; color:#a0aec0;">
                    <span>🟣 Jobs</span>
                    <span>🔵 Users</span>
                    <span>🟠 Apps</span>
                </div>
            </div>
            <canvas id="barChart" height="100"></canvas>
        </div>

        <!-- Donut Chart -->
        <div style="background:white; border-radius:16px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
            <h3 style="margin:0 0 20px; font-size:15px; font-weight:600; color:#1a1a2e;">Traffic Sources</h3>
            <canvas id="donutChart" height="180"></canvas>
            <div style="margin-top:16px; display:flex; flex-direction:column; gap:8px;">
                <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#4a5568;">
                    <span style="width:12px; height:12px; background:#43e97b; border-radius:50%; display:inline-block;"></span> Candidates 60%
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#4a5568;">
                    <span style="width:12px; height:12px; background:#4facfe; border-radius:50%; display:inline-block;"></span> Employers 25%
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#4a5568;">
                    <span style="width:12px; height:12px; background:#f093fb; border-radius:50%; display:inline-block;"></span> Admins 15%
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    <div style="background:white; border-radius:16px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h3 style="margin:0; font-size:15px; font-weight:600; color:#1a1a2e;">Recent Users</h3>
            <a href="/admin/users" style="font-size:12px; color:#7c3aed; text-decoration:none;">View All →</a>
        </div>
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="border-bottom:2px solid #f7f7f7;">
                    <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Name</th>
                    <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Email</th>
                    <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Role</th>
                    <th style="text-align:left; padding:10px; color:#a0aec0; font-weight:500;">Joined</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recent_users as $user)
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
                    <td style="padding:12px 10px; color:#718096;">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Chart.js Scripts -->
    <script>
        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [
                    {
                        label: 'Jobs',
                        data: [4, 7, 5, 9, 12, 8, 15, 11, 18, 14, 20, {{ $total_jobs }}],
                        backgroundColor: 'rgba(124,58,237,0.7)',
                        borderRadius: 6,
                    },
                    {
                        label: 'Users',
                        data: [10, 15, 12, 18, 22, 17, 25, 20, 30, 24, 35, {{ $total_users }}],
                        backgroundColor: 'rgba(79,172,254,0.7)',
                        borderRadius: 6,
                    },
                    {
                        label: 'Applications',
                        data: [2, 5, 3, 7, 9, 6, 11, 8, 14, 10, 16, {{ $total_applications }}],
                        backgroundColor: 'rgba(240,147,251,0.7)',
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#f7f7f7' }, ticks: { font: { size: 11 } } },
                    x: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });

        // Donut Chart
        const donutCtx = document.getElementById('donutChart').getContext('2d');
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Candidates', 'Employers', 'Admins'],
                datasets: [{
                    data: [60, 25, 15],
                    backgroundColor: ['#43e97b', '#4facfe', '#f093fb'],
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: { legend: { display: false } }
            }
        });
    </script>
@endsection