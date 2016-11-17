<?php

use Faker\Generator;
use TeachMe\Entities\TicketVote;

class TicketVoteTableSeeder extends BaseSeeder
{
    //agrego 100 comentarios a la tabla ticket_votes, si no agrego esta linea, se cargarían 50 ya que es el valor predeterminado definido en BaseSeeder.php
    protected $total = 100;

    public function getModel()
    {
        return new TicketVote();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            // un usuario podría votar por el mismo ticket si la la función aleatoria getRandom() trae al mismo usuario y el mismo ticket en mas de una ocasión
            //lo dejo así por que son datos de prueba, pero cuando este el sistema en producción no podemos dejar que un usuario vote mas de dos veces por el mismo ticket
            'user_id' => $this->getRandom('User')->id,
            'ticket_id' => $this->getRandom('Ticket')->id,
        ];
    }
}
