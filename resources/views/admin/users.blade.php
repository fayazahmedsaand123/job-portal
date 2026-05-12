@extends('layouts.admin')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Manage Users</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="pb-3 pr-4">#</th>
                        <th class="pb-3 pr-4">Name</th>
                        <th class="pb-3 pr-4">Email</th>
                        <th class="pb-3 pr-4">Role</th>
                        <th class="pb-3 pr-4">Joined</th>
                        <th class="pb-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 pr-4 text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3 pr-4 font-medium text-gray-800">{{ $user->name }}</td>
                        <td class="py-3 pr-4 text-gray-500">{{ $user->email }}</td>
                        <td class="py-3 pr-4">
                            @if($user->role == 'admin')
                                <span class="bg-red-50 text-red-500 text-xs px-3 py-1 rounded-full">Admin</span>
                            @elseif($user->role == 'employer')
                                <span class="bg-blue-50 text-blue-600 text-xs px-3 py-1 rounded-full">Employer</span>
                            @else
                                <span class="bg-green-50 text-green-600 text-xs px-3 py-1 rounded-full">Candidate</span>
                            @endif
                        </td>
                        <td class="py-3 pr-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="py-3">
                            @if($user->role != 'admin')
                                <a href="/admin/users/delete/{{ $user->id }}"
                                    onclick="return confirm('Delete this user?')"
                                    class="bg-red-100 hover:bg-red-200 text-red-600 text-xs px-3 py-1 rounded-lg transition">
                                    Delete
                                </a>
                            @else
                                <span class="text-gray-300 text-xs">Protected</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection