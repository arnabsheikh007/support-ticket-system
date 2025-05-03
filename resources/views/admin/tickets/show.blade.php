@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Ticket Details -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h1 class="text-2xl font-bold mb-4">{{ $ticket->title }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-gray-600"><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                    <p class="text-gray-600"><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
                    <p class="text-gray-600"><strong>Created by:</strong> {{ $ticket->user->name }}</p>
                    <p class="text-gray-600"><strong>Created at:</strong> {{ $ticket->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    @if ($ticket->support_engineer_id)
                        <p class="text-gray-600"><strong>Assigned to:</strong> {{ $ticket->supportEngineer->name }}</p>
                    @else
                        <p class="text-gray-600"><strong>Assigned to:</strong> Unassigned</p>
                    @endif
                </div>
            </div>
            <div class="border-t pt-4 mb-4">
                <h2 class="text-lg font-semibold mb-2">Description</h2>
                <p class="text-gray-700">{{ $ticket->description }}</p>
            </div>

            <!-- Update Status Form -->
            <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}" class="mb-4">
                @csrf
                @method('PUT')
                <div class="flex items-center space-x-4">
                    <label for="status" class="text-gray-700 font-medium">Update Status:</label>
                    <select name="status" id="status"
                        class="px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update Status
                    </button>
                </div>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </form>

            <!-- Assign Support Engineer Form -->
            <form method="POST" action="{{ route('admin.tickets.assign', $ticket->id) }}">
                @csrf
                @method('PUT')
                <div class="flex items-center space-x-4">
                    <label for="support_engineer_id" class="text-gray-700 font-medium">Assign to Support Engineer:</label>
                    <select name="support_engineer_id" id="support_engineer_id"
                        class="px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('support_engineer_id') border-red-500 @enderror">
                        <option value="" {{ !$ticket->support_engineer_id ? 'selected' : '' }}>Unassign</option>
                        @foreach ($supportEngineers as $engineer)
                            <option value="{{ $engineer->id }}"
                                {{ $ticket->support_engineer_id == $engineer->id ? 'selected' : '' }}>
                                {{ $engineer->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Assign
                    </button>
                </div>
                @error('support_engineer_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </form>
        </div>

        <!-- Comments Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Comments</h2>

            <!-- Display Existing Comments -->
            @if ($ticket->comments->isEmpty())
                <p class="text-gray-600">No comments yet.</p>
            @else
                <div class="space-y-4">
                    @foreach ($ticket->comments as $comment)
                        <div class="border-b pb-4">
                            <div class="flex justify-between items-center mb-2">
                                <p class="text-gray-600 font-medium">{{ $comment->user->name }}</p>
                                <p class="text-gray-500 text-sm">{{ $comment->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <p class="text-gray-700">{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
