@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Assigned Tickets Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h1 class="text-2xl font-bold mb-4">Assigned Tickets</h1>
            @if ($assignedTickets->isEmpty())
                <p class="text-gray-600">No tickets assigned to you yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Ticket Title</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Priority</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Status</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Created</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignedTickets as $ticket)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $ticket->title }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="@if ($ticket->priority == 'low') text-green-600 @elseif($ticket->priority == 'medium') text-yellow-600 @else text-red-600 @endif font-medium">
                                            {{ ucwords(str_replace('_', ' ', $ticket->priority)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="@if ($ticket->status == 'open') text-blue-600 @elseif($ticket->status == 'in_progress') text-orange-600 @else text-gray-600 @endif font-medium">
                                            {{ ucwords(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $ticket->created_at->format('M d, Y H:i') }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('support.tickets.show', $ticket->id) }}"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $assignedTickets->links() }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Unassigned Tickets Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Unassigned Tickets</h1>
            @if ($unassignedTickets->isEmpty())
                <p class="text-gray-600">No unassigned tickets available.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full table-auto align-text">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Ticket Title</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Priority</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Status</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Created</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unassignedTickets as $ticket)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $ticket->title }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="@if ($ticket->priority == 'low') text-green-600 @elseif($ticket->priority == 'medium') text-yellow-600 @else text-red-600 @endif font-medium">
                                            {{ ucwords(str_replace('_', ' ', $ticket->priority)) }}


                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="@if ($ticket->status == 'open') text-blue-600 @elseif($ticket->status == 'in_progress') text-orange-600 @else text-gray-600 @endif font-medium">
                                            {{ ucwords(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $ticket->created_at->format('M d, Y H:i') }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('support.tickets.show', $ticket->id) }}"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Details
                                        </a>
                                        <form id="claim-form-{{ $ticket->id }}" method="POST"
                                            action="{{ route('support.tickets.claim', $ticket->id) }}"
                                            class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500"
                                                onclick="return confirmClaim(event, '{{ $ticket->id }}')">
                                                Claim
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $unassignedTickets->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmClaim(event, ticketId) {
                event.preventDefault();
                if (confirm('Are you sure you want to claim this ticket?')) {
                    document.getElementById('claim-form-' + ticketId).submit();
                }
            }
        </script>
    @endpush
@endsection
