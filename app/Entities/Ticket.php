<?php

namespace TeachMe\Entities;

class Ticket extends Entity
{
    protected $fillable = ['title', 'status'];

    //al colocar el nombre author para esta relación estamos rompiendo con la convención de laravel. es por eso que tenemos que agregar el parámetro user_id para especificar el campo

	public function author()
    {
    	return $this->belongsTo(User::getClass(), 'user_id');
    }

	public function comments()
	{
		return $this->hasMany(TicketComment::getClass());
	}

	public function voters()
    {
    	return $this->belongsToMany(User::getClass(), 'ticket_votes')->withTimestamps();
    }

    public function getOpenAttribute()
    {
    	return $this->status == 'open';
    }
}
