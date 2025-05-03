@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Ticket Details -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h1 class="text-2xl font-bold mb-4">{{ $ticket->title }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 mb-2">
                        <span class="font-medium">Description:</span>
                        <span class="block mt-1">{{ $ticket->description }}</span>
                    </p>
                    <p class="text-gray-600 mb-2">
                        <span class="font-medium">Priority:</span>
                        <span
                            class="@if ($ticket->priority == 'low') text-green-600 @elseif($ticket->priority == 'medium') text-yellow-600 @else text-red-600 @endif font-medium">
                            {{ ucwords(str_replace('_', ' ', $ticket->priority)) }}
                        </span>
                    </p>
                    <p class="text-gray-600 mb-2">
                        <span class="font-medium">Status:</span>
                        <span
                            class="@if ($ticket->status == 'open') text-blue-600 @elseif($ticket->status == 'in_progress') text-orange-600 @else text-gray-600 @endif font-medium">
                            {{ ucwords(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 mb-2">
                        <span class="font-medium">Created:</span>
                        {{ $ticket->created_at->format('M d, Y H:i') }}
                    </p>
                    <p class="text-gray-600 mb-2">
                        <span class="font-medium">Updated:</span>
                        {{ $ticket->updated_at->format('M d, Y H:i') }}
                    </p>
                    <p class="text-gray-600 mb-2">
                        <span class="font-medium">Assigned To:</span>
                        @if ($ticket->support_engineer_id)
                            {{ $ticket->supportEngineer->name }}
                        @else
                            Unassigned
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-bold mb-4">Comments</h2>
            @if ($comments->isEmpty())
                <p class="text-gray-600">No comments yet.</p>
            @else
                <div class="space-y-4">
                    @foreach ($comments as $comment)
                        <div class="border-b pb-4">
                            <div class="flex justify-between items-center mb-2">
                                <p class="text-gray-700 font-medium">
                                    {{ $comment->user->name }}
                                </p>
                                <p class="text-gray-500 text-sm">
                                    {{ $comment->created_at->format('M d, Y H:i') }}
                                </p>
                            </div>
                            <p class="text-gray-600">{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Add Comment Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Add a Comment</h2>
            <form method="POST" action="{{ route('tickets.comments.store', $ticket->id) }}">
                @csrf
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700 font-medium mb-2">Your Comment:</label>
                    <textarea name="comment" id="comment" rows="4"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Submit Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
