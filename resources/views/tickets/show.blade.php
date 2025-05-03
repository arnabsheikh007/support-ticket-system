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
            <div class="border-t pt-4">
                <h2 class="text-lg font-semibold mb-2">Description</h2>
                <p class="text-gray-700">{{ $ticket->description }}</p>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Comments</h2>

            <!-- Display Existing Comments -->
            @if ($comments->isEmpty())
                <p class="text-gray-600">No comments yet.</p>
            @else
                <div class="space-y-4 mb-6">
                    @foreach ($comments as $comment)
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

            <!-- Add Comment Form -->
            <form method="POST" action="{{ route('tickets.comments.store', $ticket->id) }}" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700 font-medium mb-2">Add a Comment</label>
                    <textarea name="comment" id="comment" rows="3"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('comment') border-red-500 @enderror">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Post Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
