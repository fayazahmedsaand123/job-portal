@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-700 text-white py-24 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <span class="bg-white/20 text-white text-sm px-4 py-1 rounded-full mb-6 inline-block">🚀 #1 Job Portal in Pakistan</span>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">Find Your <span class="text-yellow-300">Dream Job</span> Today</h1>
        <p class="text-blue-100 text-lg md:text-xl mb-10 max-w-2xl mx-auto">Thousands of top companies are hiring. Take the next step in your career journey with JobPortal.</p>

        <!-- Search Bar -->
        <form action="/jobs" method="GET"
            class="bg-white rounded-2xl shadow-2xl p-3 flex flex-col md:flex-row gap-3 max-w-3xl mx-auto">
            <input type="text" name="title" placeholder="Job Title or Keyword"
                class="flex-1 px-4 py-3 text-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400">
            <input type="text" name="location" placeholder="Location e.g. Karachi"
                class="flex-1 px-4 py-3 text-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl transition">
                🔍 Search Jobs
            </button>
        </form>

        <!-- Quick Stats -->
        <div class="flex flex-wrap justify-center gap-8 mt-12">
            <div class="text-center">
                <p class="text-3xl font-bold text-yellow-300">500+</p>
                <p class="text-blue-100 text-sm">Jobs Posted</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-bold text-yellow-300">200+</p>
                <p class="text-blue-100 text-sm">Companies</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-bold text-yellow-300">1000+</p>
                <p class="text-blue-100 text-sm">Candidates</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-bold text-yellow-300">95%</p>
                <p class="text-blue-100 text-sm">Success Rate</p>
            </div>
        </div>
    </div>
</section>

<!-- High Demand Jobs Section -->
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Trending Now</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">High Demand Job Categories</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">These are the most in-demand skills employers are looking for right now.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <div class="text-4xl mb-3">💻</div>
                <p class="font-semibold text-gray-700 text-sm">Web Dev</p>
                <p class="text-blue-500 text-xs mt-1">120+ Jobs</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <div class="text-4xl mb-3">📱</div>
                <p class="font-semibold text-gray-700 text-sm">Mobile Dev</p>
                <p class="text-blue-500 text-xs mt-1">80+ Jobs</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <div class="text-4xl mb-3">🎨</div>
                <p class="font-semibold text-gray-700 text-sm">UI/UX Design</p>
                <p class="text-blue-500 text-xs mt-1">60+ Jobs</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <div class="text-4xl mb-3">📊</div>
                <p class="font-semibold text-gray-700 text-sm">Data Science</p>
                <p class="text-blue-500 text-xs mt-1">90+ Jobs</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <div class="text-4xl mb-3">🔒</div>
                <p class="font-semibold text-gray-700 text-sm">Cybersecurity</p>
                <p class="text-blue-500 text-xs mt-1">45+ Jobs</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <div class="text-4xl mb-3">☁️</div>
                <p class="font-semibold text-gray-700 text-sm">Cloud / DevOps</p>
                <p class="text-blue-500 text-xs mt-1">70+ Jobs</p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Jobs Section -->
<section class="py-16 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Fresh Opportunities</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">Latest Job Listings</h2>
            </div>
            <a href="/jobs" class="bg-blue-50 hover:bg-blue-100 text-blue-600 px-5 py-2 rounded-xl text-sm font-medium transition">
                View All Jobs →
            </a>
        </div>

        @if($jobs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                <div class="border border-gray-100 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($job->employer->name, 0, 1)) }}
                        </div>
                        <span class="bg-green-50 text-green-600 text-xs px-3 py-1 rounded-full">{{ $job->status }}</span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-blue-600 transition">{{ $job->title }}</h3>
                    <p class="text-gray-500 text-sm mb-4">{{ $job->employer->name }}</p>

                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="bg-blue-50 text-blue-600 text-xs px-3 py-1 rounded-full">{{ $job->job_type }}</span>
                        <span class="bg-gray-100 text-gray-500 text-xs px-3 py-1 rounded-full">📍 {{ $job->location }}</span>
                        <span class="bg-yellow-50 text-yellow-600 text-xs px-3 py-1 rounded-full">💰 {{ $job->salary }}</span>
                    </div>

                    <a href="/jobs/{{ $job->id }}"
                        class="block text-center border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold text-sm py-2 rounded-xl transition">
                        View Job
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 rounded-2xl">
                <p class="text-5xl mb-4">💼</p>
                <p class="text-gray-400 text-lg">No jobs posted yet. Check back soon!</p>
            </div>
        @endif
    </div>
</section>

<!-- How It Works Section -->
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-5xl mx-auto text-center">
        <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Simple Process</span>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2 mb-12">How It Works</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-sm">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">📝</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">1. Create Account</h3>
                <p class="text-gray-500 text-sm">Register as a Candidate or Employer in just a few seconds.</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">🔍</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">2. Find a Job</h3>
                <p class="text-gray-500 text-sm">Search thousands of jobs by title, location or category.</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">🚀</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">3. Apply & Get Hired</h3>
                <p class="text-gray-500 text-sm">Upload your resume and apply. Get hired by top companies.</p>
            </div>
        </div>
    </div>
</section>

<!-- Market Competition Section -->
<section class="py-16 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Why Choose Us</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">We Beat The Competition</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">See why thousands of job seekers and employers choose JobPortal over others.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 text-center">
                <p class="text-4xl font-bold text-blue-600 mb-2">100%</p>
                <p class="text-gray-600 font-medium">Free for Candidates</p>
                <p class="text-gray-400 text-sm mt-1">No hidden charges ever</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 text-center">
                <p class="text-4xl font-bold text-green-600 mb-2">24/7</p>
                <p class="text-gray-600 font-medium">Always Online</p>
                <p class="text-gray-400 text-sm mt-1">Apply anytime anywhere</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-6 text-center">
                <p class="text-4xl font-bold text-yellow-600 mb-2">Fast</p>
                <p class="text-gray-600 font-medium">Quick Applications</p>
                <p class="text-gray-400 text-sm mt-1">Apply in under 1 minute</p>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 text-center">
                <p class="text-4xl font-bold text-purple-600 mb-2">Safe</p>
                <p class="text-gray-600 font-medium">Verified Employers</p>
                <p class="text-gray-400 text-sm mt-1">Only trusted companies</p>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section class="py-16 px-4 bg-gradient-to-br from-blue-700 to-indigo-700 text-white">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="bg-white/20 text-white text-sm px-4 py-1 rounded-full mb-6 inline-block">About Us</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-6">We Connect Talent With Opportunity</h2>
                <p class="text-blue-100 mb-4 leading-relaxed">JobPortal was built to solve one problem — making job search easy and fast for everyone in Pakistan. We believe every talented person deserves a great opportunity.</p>
                <p class="text-blue-100 leading-relaxed">Whether you are a fresh graduate or an experienced professional, we have the right job for you. And if you are an employer, we help you find the best talent quickly.</p>
                <a href="/register"
                    class="inline-block mt-8 bg-yellow-400 hover:bg-yellow-300 text-gray-800 font-bold px-8 py-3 rounded-xl transition">
                    Get Started Free →
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/10 rounded-2xl p-6 text-center">
                    <p class="text-3xl font-bold text-yellow-300">500+</p>
                    <p class="text-blue-100 text-sm mt-1">Active Jobs</p>
                </div>
                <div class="bg-white/10 rounded-2xl p-6 text-center">
                    <p class="text-3xl font-bold text-yellow-300">200+</p>
                    <p class="text-blue-100 text-sm mt-1">Companies</p>
                </div>
                <div class="bg-white/10 rounded-2xl p-6 text-center">
                    <p class="text-3xl font-bold text-yellow-300">1000+</p>
                    <p class="text-blue-100 text-sm mt-1">Candidates</p>
                </div>
                <div class="bg-white/10 rounded-2xl p-6 text-center">
                    <p class="text-3xl font-bold text-yellow-300">95%</p>
                    <p class="text-blue-100 text-sm mt-1">Success Rate</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Ready to Find Your Dream Job?</h2>
        <p class="text-gray-500 mb-8">Join thousands of candidates and employers already using JobPortal.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="/register"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition text-lg">
                Register as Candidate
            </a>
            <a href="/jobs"
                class="bg-white hover:bg-gray-50 text-blue-600 border-2 border-blue-600 font-bold px-8 py-4 rounded-xl transition text-lg">
                Browse Jobs
            </a>
        </div>
    </div>
</section>

@endsection