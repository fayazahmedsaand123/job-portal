<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Job Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar { width: 220px; min-height: 100vh; background: #fff; border-right: 1px solid #f0f0f0; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 20px; color: #6c757d; font-size: 14px; text-decoration: none; border-radius: 8px; margin: 2px 10px; transition: all 0.2s; }
        .nav-link:hover, .nav-link.active { background: #f4f0ff; color: #7c3aed; }
        .nav-link.active { font-weight: 600; }
        .card-pink    { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .card-blue    { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .card-teal    { background: linear-gradient(135deg, #43e97b, #38f9d7); }
        .card-purple  { background: linear-gradient(135deg, #a18cd1, #fbc2eb); }
        .stat-card    { border-radius: 16px; padding: 28px; color: white; position: relative; overflow: hidden; }
        .stat-card::after { content: ''; position: absolute; right: -20px; top: -20px; width: 120px; height: 120px; background: rgba(255,255,255,0.1); border-radius: 50%; }
        .stat-card::before { content: ''; position: absolute; right: 20px; bottom: -30px; width: 80px; height: 80px; background: rgba(255,255,255,0.08); border-radius: 50%; }
    </style>
</head>
<body style="background:#f8f7ff; margin:0;">

    <div style="display:flex; min-height:100vh;">

        <!-- Sidebar -->
        <aside class="sidebar" style="position:fixed; top:0; left:0; height:100vh; overflow-y:auto; z-index:100;">

            <!-- Brand -->
            <div style="padding: 24px 20px; border-bottom: 1px solid #f0f0f0;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:36px; height:36px; background:linear-gradient(135deg,#7c3aed,#a78bfa); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <span style="color:white; font-weight:bold; font-size:16px;">J</span>
                    </div>
                    <div>
                        <p style="font-weight:700; color:#1a1a2e; margin:0; font-size:15px;">JobPortal</p>
                        <p style="color:#a0aec0; font-size:11px; margin:0;">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Admin Info -->
            <div style="padding: 16px 20px; border-bottom: 1px solid #f0f0f0;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:38px; height:38px; background:linear-gradient(135deg,#7c3aed,#a78bfa); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-weight:bold;">
                        {{ strtoupper(substr(session('login_name'), 0, 1)) }}
                    </div>
                    <div>
                        <p style="font-weight:600; color:#1a1a2e; margin:0; font-size:13px;">{{ session('login_name') }}</p>
                        <p style="color:#7c3aed; font-size:11px; margin:0;">Super Admin</p>
                    </div>
                </div>
            </div>

            <!-- Nav Links -->
            <nav style="padding: 16px 0;">
                <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <span>🏠</span> Dashboard
                </a>
                <a href="/admin/users" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                    <span>👥</span> Manage Users
                </a>
                <a href="/admin/jobs" class="nav-link {{ request()->is('admin/jobs') ? 'active' : '' }}">
                    <span>💼</span> Manage Jobs
                </a>
                <a href="/admin/post-job" class="nav-link {{ request()->is('admin/post-job') ? 'active' : '' }}">
                    <span>➕</span> Post a Job
                </a>
                <div style="margin: 16px 10px; border-top: 1px solid #f0f0f0;"></div>
                <a href="/logout" class="nav-link" style="color:#f56565;">
                    <span>🚪</span> Logout
                </a>
            </nav>
        </aside>

        <!-- Main -->
        <main style="flex:1; margin-left:220px; padding:0;">

            <!-- Top Navbar -->
            <div style="background:white; padding:16px 32px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #f0f0f0; position:sticky; top:0; z-index:99;">
            
                <!-- Search -->
                <div style="position:relative; width:320px;">
                    <div style="display:flex; align-items:center; gap:12px; background:#f8f7ff; padding:8px 16px; border-radius:10px;">
                        <span style="color:#a0aec0;">🔍</span>
                        <input type="text" id="adminSearch" placeholder="Search users or jobs..."
                            autocomplete="off"
                            style="border:none; background:transparent; outline:none; font-size:13px; color:#4a5568; width:100%;">
                    </div>

                    <!-- Dropdown Results -->
                    <div id="searchResults"
                        style="display:none; position:absolute; top:48px; left:0; width:100%; background:white; border-radius:12px; box-shadow:0 8px 30px rgba(0,0,0,0.12); z-index:999; overflow:hidden; border:1px solid #f0f0f0;">
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:16px;">
                    <span style="font-size:20px; cursor:pointer;">🔔</span>
                    <span style="font-size:20px; cursor:pointer;">✉️</span>
                    <div style="width:36px; height:36px; background:linear-gradient(135deg,#7c3aed,#a78bfa); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; cursor:pointer;">
                        {{ strtoupper(substr(session('login_name'), 0, 1)) }}
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div style="padding:32px;">

                <!-- Flash Messages -->
                @if(session('success'))
                    <div style="background:#f0fff4; color:#38a169; padding:12px 20px; border-radius:12px; margin-bottom:24px; border-left:4px solid #38a169;">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        const searchInput = document.getElementById('adminSearch');
        const searchResults = document.getElementById('searchResults');
        var searchTimer = null;

        searchInput.addEventListener('input', function () {
            const q = this.value.trim();

            clearTimeout(searchTimer);

            if (q.length === 0) {
                searchResults.style.display = 'none';
                return;
            }

            // Debounce — wait 300ms after typing stops
            searchTimer = setTimeout(() => {
                fetch(`/admin/api/search?q=${encodeURIComponent(q)}`)
                    .then(res => res.json())
                    .then(data => {
                        renderResults(data, q);
                    });
            }, 300);
        });

        function renderResults(data, q) {
            const { users, jobs } = data;

            if (users.length === 0 && jobs.length === 0) {
                searchResults.innerHTML = `
                    <div style="padding:16px; text-align:center; color:#a0aec0; font-size:13px;">
                        No results found for "<strong>${q}</strong>"
                    </div>`;
                searchResults.style.display = 'block';
                return;
            }

            var html = '';

            if (users.length > 0) {
                html += `<div style="padding:10px 16px; font-size:11px; color:#a0aec0; font-weight:600; text-transform:uppercase; background:#f8f7ff;">👥 Users</div>`;
                users.forEach(user => {
                    const roleColor = user.role === 'admin' ? '#d53f8c' : user.role === 'employer' ? '#3182ce' : '#38a169';
                    const roleBg = user.role === 'admin' ? '#fff0f6' : user.role === 'employer' ? '#ebf8ff' : '#f0fff4';
                    html += `
                        <a href="/admin/users" style="display:flex; align-items:center; justify-content:space-between; padding:10px 16px; text-decoration:none; border-bottom:1px solid #f7f7f7; transition:background 0.15s;"
                            onmouseover="this.style.background='#f8f7ff'" onmouseout="this.style.background='white'">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; background:linear-gradient(135deg,#7c3aed,#a78bfa); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:12px; font-weight:bold;">
                                    ${user.name.charAt(0).toUpperCase()}
                                </div>
                                <div>
                                    <p style="margin:0; font-size:13px; font-weight:500; color:#1a1a2e;">${highlightMatch(user.name, q)}</p>
                                    <p style="margin:0; font-size:11px; color:#a0aec0;">${user.email}</p>
                                </div>
                            </div>
                            <span style="background:${roleBg}; color:${roleColor}; font-size:10px; padding:2px 8px; border-radius:20px;">${user.role}</span>
                        </a>`;
                    });
                }

            if (jobs.length > 0) {
                html += `<div style="padding:10px 16px; font-size:11px; color:#a0aec0; font-weight:600; text-transform:uppercase; background:#f8f7ff;">💼 Jobs</div>`;
                    jobs.forEach(job => {
                    html += `
                        <a href="/admin/jobs" style="display:flex; align-items:center; justify-content:space-between; padding:10px 16px; text-decoration:none; border-bottom:1px solid #f7f7f7; transition:background 0.15s;"
                            onmouseover="this.style.background='#f8f7ff'" onmouseout="this.style.background='white'">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; background:linear-gradient(135deg,#4facfe,#00f2fe); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:14px;">
                                    💼
                                </div>
                                <div>
                                    <p style="margin:0; font-size:13px; font-weight:500; color:#1a1a2e;">${highlightMatch(job.title, q)}</p>
                                    <p style="margin:0; font-size:11px; color:#a0aec0;">📍 ${job.location}</p>
                                </div>
                            </div>
                            <span style="background:#ebf8ff; color:#3182ce; font-size:10px; padding:2px 8px; border-radius:20px;">${job.job_type}</span>
                        </a>`;
                    });
                }

            // View all link
            html += `
            <a href="/admin/search?q=${encodeURIComponent(q)}"
                style="display:block; padding:12px 16px; text-align:center; font-size:12px; color:#7c3aed; text-decoration:none; font-weight:600; border-top:1px solid #f0f0f0;"
                onmouseover="this.style.background='#f8f7ff'" onmouseout="this.style.background='white'">
                View all results for "${q}" →
            </a>`;

            searchResults.innerHTML = html;
            searchResults.style.display = 'block';
        }

        function highlightMatch(text, query) {
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<mark style="background:#f4f0ff; color:#7c3aed; border-radius:3px; padding:0 2px;">$1</mark>');
        }

        // Hide results when clicking outside
        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });

        // Show results again when clicking search input
        searchInput.addEventListener('focus', function () {
            if (this.value.trim().length > 0 && searchResults.innerHTML) {
                searchResults.style.display = 'block';
            }
        }); 
    </script>
</body>
</html>