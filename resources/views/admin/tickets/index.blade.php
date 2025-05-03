@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Tickets Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">All Tickets</h1>
            @if ($tickets->isEmpty())
                <p class="text-gray-600">No tickets available.</p>
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
                                    <td class="px-4 py-2">
                                        @if ($ticket->support_engineer_id)
                                            {{ $ticket->supportEngineer->name }}
                                        @else
                                            Unassigned
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('admin.tickets.show', $ticket->id) }}"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Details
                                        </a>
                                        <button onclick="openAssignModal('{{ $ticket->id }}')"
                                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                                            {{ $ticket->support_engineer_id ? 'Re-assign' : 'Assign' }}
                                        </button>
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

    <!-- Assign Modal -->
    <div id="assignModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Assign Ticket</h2>
                <button onclick="closeAssignModal()" class="text-gray-600 hover:text-gray-800">
                    ✕
                </button>
            </div>
            <form id="assignForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="support_engineer_id" class="block text-gray-700 font-medium mb-2">Select Support
                        Engineer:</label>
                    <select name="support_engineer_id" id="support_engineer_id"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Unassign</option>
                        @foreach ($supportEngineers as $engineer)
                            <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeAssignModal()"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Assign
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function openAssignModal(ticketId) {
                const modal = document.getElementById('assignModal');
                const form = document.getElementById('assignForm');
                form.action = `/admin/tickets/${ticketId}/assign`;
                modal.classList.remove('hidden');
            }

            function closeAssignModal() {
                const modal = document.getElementById('assignModal');
                modal.classList.add('hidden');
            }

            // Close modal if clicking outside of it
            document.getElementById('assignModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeAssignModal();
                }
            });
        </script>
    @endpush
@endsection
