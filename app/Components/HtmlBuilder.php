<?php

namespace TeachMe\Components;

use Collective\Html\HtmlBuilder as CollectiveHtmlBuilder;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Routing\UrlGenerator;

class HtmlBuilder extends CollectiveHtmlBuilder{
	
	private $config;

	private $view;

	public function __construct(Config $config, View $view, UrlGenerator $url)
	{
		$this->config = $config;
		$this->view = $view;
		$this->url = $url;
	}




	public function menu($items)
	{
		if (! is_array($items))
		{
			$items = $this->config->get($items, array());
		}

		return $this->view->make('partials/menu', compact('items'));
	}

	/**
     * Builds an HTML class attribute dynamically
     * Usage:
     * {!! Html::classes(['home' => true, 'main', 'dont-use-this' => false]) !!}
     * Returns:
     *  class="home main".
     *
     * @param array $classes
     *
     * @return string
     */
    public function classes(array $classes)
    {
        $html = '';
        foreach ($classes as $name => $bool) {
            if (is_int($name)) {
                $name = $bool;
                $bool = true;
            }
            if ($bool) {
                $html .= $name.' ';
            }
        }
        if (! empty($html)) {
            return ' class="'.trim($html).'"';
        }
        return '';
    }
}