<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $supportEngineers = User::where('role', 'support_engineer')->get();
        return view('admin.tickets.show', compact('ticket', 'supportEngineers'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,closed,in_progress',
        ]);

        $ticket->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'support_engineer_id' => 'nullable|exists:users,id',
        ]);

        $ticket->update(['support_engineer_id' => $request->support_engineer_id ?: null]);
        return redirect()->back()->with('success', 'Ticket assigned successfully.');
    }
}
