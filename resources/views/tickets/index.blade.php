@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Tickets Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">My Tickets</h1>
                <a href="{{ route('tickets.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create New Ticket
                </a>
            </div>
            @if ($tickets->isEmpty())
                <p class="text-gray-600">You have no tickets yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Ticket Title</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Priority</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Status</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Created</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Assigned To</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $ticket->title }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="@if ($ticket->priority == 'low') text-green-600 @elseif($ticket->priority == 'medium') text-yellow-600 @else text-red-600 @endif font-medium">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="@if ($ticket->status == 'open') text-blue-600 @elseif($ticket->status == 'in_progress') text-orange-600 @else text-gray-600 @endif font-medium">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $ticket->created_at->format('M d, Y H:i') }}</td>
                                    <td class="px-4 py-2">
                                        @if ($ticket->support_engineer_id)
                                            {{ $ticket->supportEngineer->name }}
                                        @else
                                            Unassigned
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('tickets.show', $ticket->id) }}"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $tickets->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
