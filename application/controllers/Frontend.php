<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends MY_Controller
{
	protected $page = null;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('site_model');
		$this->page = $this->site_model->get_page($this->get_url());
	}

	public function get_url() {
		return base_url();
	}
}
