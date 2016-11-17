<?php

use Faker\Generator;
use TeachMe\Entities\Ticket;

class TicketTableSeeder extends BaseSeeder{

	public function getModel()
	{
		return new Ticket();
	}

	public function getDummyData(Generator $faker, array $customValues = array())
    {
    	return[
    		'title' 	=> $faker->sentence(),
    		'status' 	=> $faker->randomElement(['open', 'open', 'closed']),
    		'user_id' 	=> $this->createFrom('UserTableSeeder')->id
    	];
    }

    public function run()
    {
    	$this->createMultiple(50);
    }
}