<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
// use function Laravel\Prompts\search;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::orderBy('created_at', 'desc')->get();
        // return view('tickets.index', compact('tickets'));
        return view('tickets.index', compact('tickets')); // For testing purposes, you can return all tickets directly
    }

    /**
     * Show the create ticket form.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:open,in_progress,closed',
        ]);

        Ticket::create($request->all());
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket->update($request->all());
        
        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}

// $id = search(
//     label: 'Search for the user that should receive the mail',
//     options: fn (string $ticket) => strlen($ticket) > 0
//         ? Ticket::whereLike('name', "%{$ticket}%")->pluck('name', 'id')->all()
//         : []
// );