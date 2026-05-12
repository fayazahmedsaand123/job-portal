// @refresh reset
import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import {
    BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer,
    PieChart, Pie, Cell, Legend
} from 'recharts';

// ── Icons ──────────────────────────────────────────────────────────────────
const Icon = ({ d }) => (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
        strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"
        className="w-5 h-5">
        <path d={d} />
    </svg>
);

// ── Sidebar ────────────────────────────────────────────────────────────────
function Sidebar({ active, setActive }) {
    const links = [
        { key: 'dashboard', label: 'Overview',      icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' },
        { key: 'users',     label: 'Users',          icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z' },
        { key: 'jobs',      label: 'Jobs',           icon: 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z' },
        { key: 'post_job',  label: 'Post a Job',     icon: 'M12 4v16m8-8H4' },
        { key: 'logout',    label: 'Logout',         icon: 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1' },
    ];

    return (
        <aside className="w-64 bg-gray-900 min-h-screen fixed top-0 left-0 flex flex-col">
            {/* Brand */}
            <div className="px-6 py-6 border-b border-gray-700">
                <p className="text-white text-xl font-bold">Job<span className="text-yellow-400">Portal</span></p>
                <p className="text-gray-400 text-xs mt-1">Admin Panel</p>
            </div>

            {/* Nav */}
            <nav className="flex-1 px-4 py-6 flex flex-col gap-1">
                {links.map(link => (
                    <button
                        key={link.key}
                        onClick={() => {
                            if (link.key === 'logout') {
                                window.location.href = '/logout';
                            } else {
                                setActive(link.key);
                            }
                        }}
                        className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition w-full text-left
                            ${active === link.key
                                ? 'bg-blue-600 text-white'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'}
                            ${link.key === 'logout' ? 'mt-auto text-red-400 hover:bg-red-900 hover:text-red-300' : ''}`}
                    >
                        <Icon d={link.icon} />
                        {link.label}
                    </button>
                ))}
            </nav>
        </aside>
    );
}

// ── Stat Card ──────────────────────────────────────────────────────────────
function StatCard({ title, value, subtitle, color, icon }) {
    const colors = {
        red:    'bg-red-500',
        green:  'bg-green-500',
        orange: 'bg-orange-500',
        blue:   'bg-blue-500',
    };
    return (
        <div className="bg-white rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div>
                <p className="text-gray-500 text-xs uppercase tracking-wide mb-1">{title}</p>
                <p className="text-3xl font-bold text-gray-800">{value}</p>
                {subtitle && <p className="text-green-500 text-xs mt-1">{subtitle}</p>}
            </div>
            <div className={`w-12 h-12 ${colors[color]} rounded-full flex items-center justify-center text-white text-xl`}>
                {icon}
            </div>
        </div>
    );
}

// ── Dashboard Page ─────────────────────────────────────────────────────────
function DashboardPage({ stats }) {
    if (!stats) return <p className="text-gray-400">Loading...</p>;

    const PIE_DATA = [
        { name: 'Candidates', value: 63 },
        { name: 'Employers',  value: 25 },
        { name: 'Admins',     value: 12 },
    ];
    const PIE_COLORS = ['#6366f1', '#f59e0b', '#10b981'];

    return (
        <div>
            {/* Stats */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <StatCard title="Total Users"        value={stats.total_users}        subtitle="↑ Active members"  color="red"    icon="👥" />
                <StatCard title="Total Jobs"         value={stats.total_jobs}         subtitle="↑ Jobs posted"     color="green"  icon="💼" />
                <StatCard title="Total Applications" value={stats.total_applications} subtitle="↑ Applications"    color="orange" icon="📄" />
                <StatCard title="Success Rate"       value="95%"                      subtitle="↑ Hired candidates" color="blue"   icon="🚀" />
            </div>

            {/* Charts */}
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                {/* Bar Chart */}
                <div className="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm">
                    <div className="flex items-center justify-between mb-6">
                        <h3 className="font-semibold text-gray-800">Jobs Posted Per Month</h3>
                        <span className="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full">2026</span>
                    </div>
                    <ResponsiveContainer width="100%" height={250}>
                        <BarChart data={stats.monthly_jobs}>
                            <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
                            <XAxis dataKey="month" tick={{ fontSize: 12 }} />
                            <YAxis tick={{ fontSize: 12 }} />
                            <Tooltip />
                            <Bar dataKey="jobs" fill="#6366f1" radius={[4, 4, 0, 0]} />
                        </BarChart>
                    </ResponsiveContainer>
                </div>

                {/* Pie Chart */}
                <div className="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 className="font-semibold text-gray-800 mb-6">User Roles</h3>
                    <ResponsiveContainer width="100%" height={250}>
                        <PieChart>
                            <Pie data={PIE_DATA} cx="50%" cy="50%" innerRadius={60} outerRadius={90} dataKey="value">
                                {PIE_DATA.map((_, i) => <Cell key={i} fill={PIE_COLORS[i]} />)}
                            </Pie>
                            <Legend />
                            <Tooltip />
                        </PieChart>
                    </ResponsiveContainer>
                </div>
            </div>

            {/* Recent Users & Jobs */}
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {/* Recent Users */}
                <div className="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 className="font-semibold text-gray-800 mb-4">Recent Users</h3>
                    <table className="w-full text-sm">
                        <thead>
                            <tr className="border-b text-gray-400 text-xs">
                                <th className="pb-3 text-left">Name</th>
                                <th className="pb-3 text-left">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            {stats.recent_users.map((u, i) => (
                                <tr key={i} className="border-b hover:bg-gray-50">
                                    <td className="py-3 font-medium text-gray-700">{u.name}</td>
                                    <td className="py-3">
                                        <span className={`text-xs px-2 py-1 rounded-full
                                            ${u.role === 'admin'    ? 'bg-red-50 text-red-500'   :
                                              u.role === 'employer' ? 'bg-blue-50 text-blue-600' :
                                                                      'bg-green-50 text-green-600'}`}>
                                            {u.role}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                {/* Recent Jobs */}
                <div className="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 className="font-semibold text-gray-800 mb-4">Recent Jobs</h3>
                    <table className="w-full text-sm">
                        <thead>
                            <tr className="border-b text-gray-400 text-xs">
                                <th className="pb-3 text-left">Title</th>
                                <th className="pb-3 text-left">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            {stats.recent_jobs.map((j, i) => (
                                <tr key={i} className="border-b hover:bg-gray-50">
                                    <td className="py-3 font-medium text-gray-700">{j.title}</td>
                                    <td className="py-3">
                                        <span className="text-xs px-2 py-1 rounded-full bg-blue-50 text-blue-600">
                                            {j.job_type}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
}

// ── Users Page ─────────────────────────────────────────────────────────────
function UsersPage({ stats }) {
    if (!stats) return <p className="text-gray-400">Loading...</p>;
    return (
        <div className="bg-white rounded-2xl shadow-sm p-6">
            <h2 className="text-xl font-bold text-gray-800 mb-6">Manage Users</h2>
            <div className="overflow-x-auto">
                <table className="w-full text-sm text-left">
                    <thead>
                        <tr className="border-b text-gray-400 text-xs">
                            <th className="pb-3 pr-4">#</th>
                            <th className="pb-3 pr-4">Name</th>
                            <th className="pb-3 pr-4">Email</th>
                            <th className="pb-3 pr-4">Role</th>
                            <th className="pb-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {stats.recent_users.map((u, i) => (
                            <tr key={i} className="border-b hover:bg-gray-50">
                                <td className="py-3 pr-4 text-gray-400">{i + 1}</td>
                                <td className="py-3 pr-4 font-medium text-gray-800">{u.name}</td>
                                <td className="py-3 pr-4 text-gray-500">{u.email}</td>
                                <td className="py-3 pr-4">
                                    <span className={`text-xs px-2 py-1 rounded-full
                                        ${u.role === 'admin'    ? 'bg-red-50 text-red-500'   :
                                          u.role === 'employer' ? 'bg-blue-50 text-blue-600' :
                                                                  'bg-green-50 text-green-600'}`}>
                                        {u.role}
                                    </span>
                                </td>
                                <td className="py-3">
                                    {u.role !== 'admin' && (
                                        <a href={`/admin/users/delete/${u.id}`}
                                            onClick={e => { if (!confirm('Delete this user?')) e.preventDefault(); }}
                                            className="bg-red-100 hover:bg-red-200 text-red-600 text-xs px-3 py-1 rounded-lg transition">
                                            Delete
                                        </a>
                                    )}
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
                <p className="text-gray-400 text-xs mt-4">Showing recent 5 users. <a href="/admin/users" className="text-blue-500 hover:underline">View all →</a></p>
            </div>
        </div>
    );
}

// ── Jobs Page ──────────────────────────────────────────────────────────────
function JobsPage({ stats }) {
    if (!stats) return <p className="text-gray-400">Loading...</p>;
    return (
        <div className="bg-white rounded-2xl shadow-sm p-6">
            <div className="flex items-center justify-between mb-6">
                <h2 className="text-xl font-bold text-gray-800">Manage Jobs</h2>
                <a href="/admin/post-job"
                    className="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-xl transition">
                    ➕ Post a Job
                </a>
            </div>
            <div className="overflow-x-auto">
                <table className="w-full text-sm text-left">
                    <thead>
                        <tr className="border-b text-gray-400 text-xs">
                            <th className="pb-3 pr-4">#</th>
                            <th className="pb-3 pr-4">Title</th>
                            <th className="pb-3 pr-4">Employer</th>
                            <th className="pb-3 pr-4">Type</th>
                            <th className="pb-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {stats.recent_jobs.map((j, i) => (
                            <tr key={i} className="border-b hover:bg-gray-50">
                                <td className="py-3 pr-4 text-gray-400">{i + 1}</td>
                                <td className="py-3 pr-4 font-medium text-gray-800">{j.title}</td>
                                <td className="py-3 pr-4 text-gray-500">{j.employer?.name}</td>
                                <td className="py-3 pr-4">
                                    <span className="text-xs px-2 py-1 rounded-full bg-blue-50 text-blue-600">{j.job_type}</span>
                                </td>
                                <td className="py-3">
                                    <a href={`/admin/jobs/delete/${j.id}`}
                                        onClick={e => { if (!confirm('Delete this job?')) e.preventDefault(); }}
                                        className="bg-red-100 hover:bg-red-200 text-red-600 text-xs px-3 py-1 rounded-lg transition">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
                <p className="text-gray-400 text-xs mt-4">Showing recent 5 jobs. <a href="/admin/jobs" className="text-blue-500 hover:underline">View all →</a></p>
            </div>
        </div>
    );
}

// ── Post Job Page ──────────────────────────────────────────────────────────
function PostJobPage() {
    const [form, setForm] = useState({ title: '', location: '', salary: '', job_type: 'Full-time', description: '' });
    const [msg, setMsg] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        const res = await fetch('/admin/api/post-job', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.cookie.match(/XSRF-TOKEN=([^;]+)/)?.[1]?.replace(/%3D/g, '=') || '',
            },
            body: JSON.stringify(form),
        });
        const data = await res.json();
        if (data.success) {
            setMsg('✅ Job posted successfully!');
            setForm({ title: '', location: '', salary: '', job_type: 'Full-time', description: '' });
        } else {
            setMsg('❌ Something went wrong.');
        }
    };

    return (
        <div className="bg-white rounded-2xl shadow-sm p-8 max-w-2xl">
            <h2 className="text-xl font-bold text-gray-800 mb-6">Post a New Job</h2>
            {msg && <div className="bg-green-50 text-green-600 px-4 py-3 rounded-xl mb-4">{msg}</div>}
            <form onSubmit={handleSubmit}>
                {[
                    { label: 'Job Title',  key: 'title',    type: 'text',   placeholder: 'e.g. Laravel Developer' },
                    { label: 'Location',   key: 'location', type: 'text',   placeholder: 'e.g. Islamabad' },
                    { label: 'Salary',     key: 'salary',   type: 'text',   placeholder: 'e.g. 50,000 PKR' },
                ].map(f => (
                    <div key={f.key} className="mb-4">
                        <label className="block text-gray-600 text-sm mb-1">{f.label}</label>
                        <input type={f.type} placeholder={f.placeholder} value={form[f.key]}
                            onChange={e => setForm({ ...form, [f.key]: e.target.value })}
                            className="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>
                ))}
                <div className="mb-4">
                    <label className="block text-gray-600 text-sm mb-1">Job Type</label>
                    <select value={form.job_type} onChange={e => setForm({ ...form, job_type: e.target.value })}
                        className="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option>Full-time</option>
                        <option>Part-time</option>
                        <option>Remote</option>
                        <option>Freelance</option>
                    </select>
                </div>
                <div className="mb-6">
                    <label className="block text-gray-600 text-sm mb-1">Job Description</label>
                    <textarea rows="4" value={form.description}
                        onChange={e => setForm({ ...form, description: e.target.value })}
                        className="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>
                <button type="submit"
                    className="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
                    Publish Job
                </button>
            </form>
        </div>
    );
}

// ── Main App ───────────────────────────────────────────────────────────────
function AdminApp() {
    const [active, setActive] = useState('dashboard');
    const [stats, setStats]   = useState(null);

    useEffect(() => {
        fetch('/admin/api/stats')
            .then(r => r.json())
            .then(setStats);
    }, []);

    const pages = {
        dashboard: <DashboardPage stats={stats} />,
        users:     <UsersPage stats={stats} />,
        jobs:      <JobsPage stats={stats} />,
        post_job:  <PostJobPage />,
    };

    return (
        <div className="flex bg-gray-100 min-h-screen">
            <Sidebar active={active} setActive={setActive} />
            <main className="flex-1 ml-64 p-8">
                {/* Top Bar */}
                <div className="flex items-center justify-between mb-8">
                    <h1 className="text-2xl font-bold text-gray-800 capitalize">{active.replace('_', ' ')}</h1>
                    <div className="flex items-center gap-3">
                        <span className="text-sm text-gray-500 bg-white px-4 py-2 rounded-xl shadow-sm">👤 Admin</span>
                    </div>
                </div>
                {pages[active]}
            </main>
        </div>
    );
}

// ── Mount ──────────────────────────────────────────────────────────────────
const root = createRoot(document.getElementById('admin-root'));
root.render(<AdminApp />);