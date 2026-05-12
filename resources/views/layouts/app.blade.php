<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-blue-600">Job<span class="text-gray-800">Portal</span></a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-6">
                <a href="/" class="text-gray-600 hover:text-blue-600 transition">Home</a>
                <a href="/jobs" class="text-gray-600 hover:text-blue-600 transition">Jobs</a>

                @if(session('login_id'))
                    @if(session('login_role') == 'candidate')
                        <a href="/candidate/dashboard" class="text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                    @elseif(session('login_role') == 'employer')
                        <a href="/employer/dashboard" class="text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                    @elseif(session('login_role') == 'admin')
                        <a href="/admin/dashboard" class="text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                    @endif
                    <span class="text-gray-500">Hi, {{ session('login_name') }}</span>
                    <a href="/logout"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition">Logout</a>
                @else
                    <a href="/login"
                        class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-xl transition">Login</a>
                    <a href="/register"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition">Register</a>
                @endif
            </div>

            <!-- Mobile Hamburger -->
            <button onclick="toggleMenu()" class="md:hidden text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden px-4 pb-4 flex flex-col gap-3">
            <a href="/" class="text-gray-600 hover:text-blue-600">Home</a>
            <a href="/jobs" class="text-gray-600 hover:text-blue-600">Jobs</a>

            @if(session('login_id'))
                @if(session('login_role') == 'candidate')
                    <a href="/candidate/dashboard" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                @elseif(session('login_role') == 'employer')
                    <a href="/employer/dashboard" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                @elseif(session('login_role') == 'admin')
                    <a href="/admin/dashboard" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                @endif
                <a href="/logout" class="text-red-500">Logout</a>
            @else
                <a href="/login" class="text-blue-600">Login</a>
                <a href="/register" class="text-blue-600">Register</a>
            @endif
        </div>
    </nav>

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">

                <!-- Brand -->
                <div>
                    <a href="/" class="text-2xl font-bold text-white">Job<span class="text-yellow-400">Portal</span></a>
                    <p class="text-gray-400 text-sm mt-3 leading-relaxed">Pakistan's leading job portal connecting talented candidates with top employers.</p>
                </div>

                <!-- For Candidates -->
                <div>
                    <h4 class="font-semibold text-white mb-4">For Candidates</h4>
                    <ul class="flex flex-col gap-2">
                        <li><a href="/jobs" class="text-gray-400 hover:text-white text-sm transition">Browse Jobs</a></li>
                        <li><a href="/register" class="text-gray-400 hover:text-white text-sm transition">Create Account</a></li>
                        <li><a href="/candidate/dashboard" class="text-gray-400 hover:text-white text-sm transition">My Applications</a></li>
                    </ul>
                </div>

                <!-- For Employers -->
                <div>
                    <h4 class="font-semibold text-white mb-4">For Employers</h4>
                    <ul class="flex flex-col gap-2">
                        <li><a href="/register" class="text-gray-400 hover:text-white text-sm transition">Post a Job</a></li>
                        <li><a href="/employer/dashboard" class="text-gray-400 hover:text-white text-sm transition">Employer Dashboard</a></li>
                        <li><a href="/employer/my-jobs" class="text-gray-400 hover:text-white text-sm transition">My Jobs</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Contact Us</h4>
                    <ul class="flex flex-col gap-2">
                        <li class="text-gray-400 text-sm">📧 info@jobportal.com</li>
                        <li class="text-gray-400 text-sm">📞 +92 300 0000000</li>
                        <li class="text-gray-400 text-sm">📍 Karachi, Pakistan</li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">© 2026 JobPortal. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">Privacy Policy</a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">Terms of Service</a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">About Us</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>