@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        

        <!-- Create User Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6">Create New User</h1>
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password" id="password"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                           required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password_confirmation') border-red-500 @enderror"
                           required>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="role" class="block text-gray-700 font-medium mb-2">Role</label>
                    <select name="role" id="role"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                            required>
                        <option value="">Select Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="support_engineer" {{ old('role') == 'support_engineer' ? 'selected' : '' }}>Support Engineer</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.users.index') }}"
                       class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection