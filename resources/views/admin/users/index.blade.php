@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- User List -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Manage Users</h2>
                <a href="{{ route('admin.users.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create New User
                </a>
            </div>
            @if ($users->isEmpty())
                <p class="text-gray-600">No users found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Name</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Email</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Role</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                                    <td class="px-4 py-2">
                                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}"
                                            class="flex items-center space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="role"
                                                class="px-3 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User
                                                </option>
                                                <option value="support_engineer"
                                                    {{ $user->role == 'support_engineer' ? 'selected' : '' }}>Support
                                                    Engineer</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                                </option>
                                            </select>
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Update Role
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
