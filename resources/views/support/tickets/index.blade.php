@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Support Tickets</h1>
        @if ($tickets->isEmpty())
            <p class="text-gray-600">No assigned tickets.</p>
        @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach ($tickets as $ticket)
                            <li class="mb-2">
                                <a href="{{ route('support.tickets.show', $ticket->id) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $ticket->title }} (Status: {{ $ticket->status }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection
