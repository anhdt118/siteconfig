<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class site_model extends MY_Model
{
	/**
	 * site_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->entity_configuration['collection'] = 'site';
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	protected function _before_save($data)
	{
		if (empty($data['status'])) {
			$data['status'] = self::VALUE_NO;
		}
		$data['updated_at'] = time();
		return $data;
	}

	/**
	 * @param $domain
	 * @param bool $reload
	 * @return |null
	 */
	public function get_page($domain, $reload = true)
	{
		if (empty($this->data) || $reload) {
			$this->data = $this->get_collection()->findOne(array('url' => $domain));
		}
		return $this->data;
	}
}
