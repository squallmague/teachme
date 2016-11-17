<?php

use Faker\Generator;
use TeachMe\Entities\TicketComment;

class TicketCommentTableSeeder extends BaseSeeder{

	//agrego 100 comentarios a la tabla ticket_comments, si no agrego esta linea, se cargarían 50 ya que es el valor predeterminado definido en BaseSeeder.php
	protected $total = 100;

	public function getModel()
	{
		return new TicketComment();
	}

	public function getDummyData(Generator $faker, array $customValues = array())
	{
		return [
			'user_id' 	=> $this->getRandom('User')->id, 
			'ticket_id' => $this->getRandom('Ticket')->id,
			'comment'	=> $faker->paragraph(),
			'link'		=> $faker->randomElement(['','', $faker->url])
		];
	}
}