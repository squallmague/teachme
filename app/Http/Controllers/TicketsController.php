<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use TeachMe\Entities\Ticket;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Http\Requests;

class TicketsController extends Controller
{
    protected function selectTicketsList()
    {
        //uso with para poder usar el metodo author establecido en el la entidad Ticket
        return Ticket::selectRaw(
            'tickets.*, '
            . '(SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id) as num_comments,'
            . '(SELECT COUNT(*) FROM ticket_votes  WHERE ticket_votes.ticket_id = tickets.id) as num_votes'
        )->with('author');
    }

    public function latest()
    {

        $tickets = $this->selectTicketsList()
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

    	return view('tickets/list', compact('tickets'));
        //dd('latest');
    }

    public function popular()
    {
    	return view('tickets/list');
    }

    public function open()
    {
        $tickets = $this->selectTicketsList()
            ->where('status', 'open')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    	return view('tickets/list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = $this->selectTicketsList()
            ->where('status', 'closed')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    	return view('tickets/list', compact('tickets'));
    }

    public function details($id)
    {
        $ticket = Ticket::findOrFail($id);
    	return view('tickets/details', compact('ticket'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request, Guard $auth)
    {
        $this->validate($request, [
            'title' => 'required|max:120'
        ]);

        //guardar el ticket con el ORM elocuent, no se necesita traer el usuario por que ya esta incluido al usar el modelo user
        $ticket = $auth->user()->tickets()->create([
            'title'     => $request->get('title'),
            'status'    =>'open'
        ]);

        //forma anterior de guardar
        // $ticket = new Ticket();
        // $ticket->title = $request->get('title');
        // $ticket->status = 'open';
        // $ticket->user_id = $auth->user()->id;
        // $ticket->save();

        return Redirect::route('tickets.details', $ticket->id);
    }


}
