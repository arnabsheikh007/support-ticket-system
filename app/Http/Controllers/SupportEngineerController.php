<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Http\Request;

class SupportEngineerController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('support_engineer_id', auth()->id())->get();
        return view('support.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('support.tickets.show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,closed,in_progress',
        ]);

        $ticket->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }

    public function claim(Request $request, Ticket $ticket)
    {
        $ticket->update(['support_engineer_id' => auth()->id()]);
        return redirect()->back()->with('success', 'Ticket claimed successfully.');
    }

    public function storeComment(Request $request, Ticket $ticket)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
