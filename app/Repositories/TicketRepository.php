<?php

namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository {

	protected function selectTicketsList()
    {
        //uso with para poder usar el metodo author establecido en el la entidad Ticket
        return Ticket::selectRaw(
            'tickets.*, '
            . '(SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id) as num_comments,'
            . '(SELECT COUNT(*) FROM ticket_votes  WHERE ticket_votes.ticket_id = tickets.id) as num_votes'
        )->with('author');
    }

	public function paginateLatest()
	{
		return $this->selectTicketsList()
    		->orderBy('created_at', 'DESC')
    		->paginate(20);
	}

	public function paginateOpen()
	{
		return $this->selectTicketsList()
            ->where('status', 'open')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
	}

	public function paginateClosed()
	{
		return $this->selectTicketsList()
            ->where('status', 'closed')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
	}

	public function findOrFail($id)
	{
		return Ticket::findOrFail($id);
	}
}