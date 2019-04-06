<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	protected $blade = null;
	protected $mongodb = null;

	public function __construct()
	{
		parent::__construct();

		// Init template engine
		$this->blade = new Philo\Blade\Blade(APPPATH . 'views', APPPATH . 'cache');
		$this->blade->loader = $this->load;
	}
}
