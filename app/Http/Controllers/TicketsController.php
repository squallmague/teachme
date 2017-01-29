<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use TeachMe\Entities\Ticket;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Http\Requests;
use TeachMe\Repositories\TicketRepository;

class TicketsController extends Controller
{
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }



    public function latest()
    {
        //ya no instanciamos manualmente el repositorio ($repository = new TicketRepository();) si no que vamos a llamar al que tenemos disponible como una propiedaddentro de nuestra clase ($this->ticketRepository)

        $tickets = $this->ticketRepository->paginateLatest();

    	return view('tickets/list', compact('tickets'));
        //dd('latest');
    }

    public function popular()
    {
    	return view('tickets/list');
    }

    public function open()
    {
        $tickets = $this->ticketRepository->paginateOpen();
    	return view('tickets/list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = $this->ticketRepository->paginateClosed();
    	return view('tickets/list', compact('tickets'));
    }

    public function details($id)
    {
        $ticket = $this->ticketRepository->findOrFail($id);
    	return view('tickets/details', compact('ticket'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120'
        ]);

        $ticket = $this->ticketRepository->openNew(
            currentUser(),
            $request->get('title')
        );

        //forma anterior de guardar
        // $ticket = new Ticket();
        // $ticket->title = $request->get('title');
        // $ticket->status = 'open';
        // $ticket->user_id = $auth->user()->id;
        // $ticket->save();

        return Redirect::route('tickets.details', $ticket->id);
    }


}
