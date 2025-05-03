@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Manage Users</h2>
            <a href="{{ route('admin.users.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Create New User
            </a>
        </div>
        <!-- Users Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">All Users</h1>
            @if ($users->isEmpty())
                <p class="text-gray-600">No users available.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Name</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Email</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Role</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Created</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="@if ($user->role == 'admin') text-purple-600 @elseif($user->role == 'support_engineer') text-green-600 @else text-blue-600 @endif font-medium">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $user->created_at->format('M d, Y H:i') }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <button onclick="openEditRoleModal('{{ $user->id }}', '{{ $user->role }}')"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Edit Role
                                        </button>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                            class="inline-block" onsubmit="return confirmDelete('{{ $user->name }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div id="editRoleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit User Role</h2>
                <button onclick="closeEditRoleModal()" class="text-gray-600 hover:text-gray-800">
                    ✕
                </button>
            </div>
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 font-medium mb-2">Select Role:</label>
                    <select name="role" id="role"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="support_engineer">Support Engineer</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEditRoleModal()"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function openEditRoleModal(userId, currentRole) {
                const modal = document.getElementById('editRoleModal');
                const form = document.getElementById('editRoleForm');
                const roleSelect = document.getElementById('role');
                form.action = `/admin/users/${userId}`;
                roleSelect.value = currentRole;
                modal.classList.remove('hidden');
            }

            function closeEditRoleModal() {
                const modal = document.getElementById('editRoleModal');
                modal.classList.add('hidden');
            }

            // Close modal if clicking outside of it
            document.getElementById('editRoleModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeEditRoleModal();
                }
            });

            function confirmDelete(userName) {
                return confirm(`Are you sure you want to delete the user "${userName}"? This action cannot be undone.`);
            }
        </script>
    @endpush
@endsection
