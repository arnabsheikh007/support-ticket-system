@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Create New Ticket</h1>

        <!-- Form for creating a ticket -->
        <form id="create-ticket-form" method="POST" action="{{ route('tickets.store') }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p id="title-error" class="text-red-500 text-sm mt-1 hidden">Title is required.</p>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="5"
                          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p id="description-error" class="text-red-500 text-sm mt-1 hidden">Description is required.</p>
            </div>

            <!-- Priority -->
            <div class="mb-4">
                <label for="priority" class="block text-gray-700 font-medium mb-2">Priority</label>
                <select name="priority" id="priority"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('priority') border-red-500 @enderror">
                    <option value="" disabled selected>Select priority</option>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
                @error('priority')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p id="priority-error" class="text-red-500 text-sm mt-1 hidden">Please select a priority.</p>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Submit Ticket
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('create-ticket-form').addEventListener('submit', function (event) {
            // Reset error messages
            const errorElements = document.querySelectorAll('.text-red-500');
            errorElements.forEach(element => element.classList.add('hidden'));

            let hasError = false;

            // Validate Title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                document.getElementById('title-error').classList.remove('hidden');
                hasError = true;
            }

            // Validate Description
            const description = document.getElementById('description').value.trim();
            if (!description) {
                document.getElementById('description-error').classList.remove('hidden');
                hasError = true;
            }

            // Validate Priority
            const priority = document.getElementById('priority').value;
            if (!priority || !['low', 'medium', 'high'].includes(priority)) {
                document.getElementById('priority-error').classList.remove('hidden');
                hasError = true;
            }

            // Prevent form submission if there are errors
            if (hasError) {
                event.preventDefault();
            }
        });
    </script>
@endsection