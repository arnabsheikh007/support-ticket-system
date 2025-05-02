<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class SupportEngineerController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('support_engineer_id', auth()->id())->get();
        return view('support.tickets.index', compact('tickets'));
    }
}
