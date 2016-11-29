<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Http\Request;
use TeachMe\Entities\Ticket;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Http\Requests;

class VotesController extends Controller
{
    public function submit($id)
    {
    	$ticket = Ticket::findOrFail($id);

    	currentUser()->vote($ticket);

    	return redirect()->back();
    }

    public function destroy($id)
    {
    	$ticket = Ticket::findOrFail($id);
    	currentUser()->unvote($ticket);

    	return redirect()->back();
    }
}
