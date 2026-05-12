<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Panel - Job Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-sm fixed top-0 left-0 h-full hidden md:block">
            <div class="p-6 border-b">
                <a href="/" class="text-xl font-bold text-blue-600">Job<span class="text-gray-800">Portal</span></a>
                <p class="text-sm text-gray-500 mt-1">{{ session('login_name') }}</p>
            </div>
            <nav class="p-4 flex flex-col gap-2">
                <a href="/employer/dashboard"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                    📊 Dashboard
                </a>
                <a href="/employer/my-jobs"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                    💼 My Jobs
                </a>
                <a href="/employer/post-job"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                    ➕ Post a New Job
                </a>
                <a href="/logout"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 transition mt-4">
                    🚪 Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64 p-6">

            <!-- Top Bar -->
            <div class="bg-white rounded-2xl shadow-sm px-6 py-4 mb-6 flex items-center justify-between">
                <h1 class="text-lg font-semibold text-gray-800">Employer Panel</h1>
                <span class="text-sm text-gray-500">Welcome, {{ session('login_name') }}</span>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    
</body>
</html>