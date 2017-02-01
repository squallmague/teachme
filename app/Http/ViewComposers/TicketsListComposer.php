<?php

namespace TeachMe\Http\ViewComposers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class TicketsListComposer {

	public function compose($view)
	{
        $view->title = trans(Route::currentRouteName() . '_title');
        //gracias a la variable $view obtenemos todas las variables de la vista en este caso $tickets
        $view->text_total = Lang::choice(
            'tickets.total',
            $view->tickets->total(),
            ['title' => strtolower($view->title)]
        );
	}

}