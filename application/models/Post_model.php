<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class post_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->entity_configuration['collection'] = 'post';
	}

	protected function _before_save($data)
	{
		if (empty($data['url'])) {
			$data['url'] = render_to_alias($data['title']);
		} else {
			$data['url'] = render_to_alias($data['url']);
		}
		if (empty($data['category_ids'])) {
			$data['category_ids'] = array();
		}
		$data['publish_at'] = time();
		$data['updated_at'] = time();
		return $data;
	}
}
