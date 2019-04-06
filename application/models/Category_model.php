<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class category_model extends MY_Model
{
	/**
	 * category_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->entity_configuration['collection'] = 'category';
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	protected function _before_save($data)
	{
		if (empty($data['url'])) {
			$data['url'] = render_to_alias($data['name']);
		} else {
			$data['url'] = render_to_alias($data['url']);
		}
		if (empty($data['status'])) {
			$data['status'] = self::VALUE_NO;
		} else {
			$data['status'] = self::VALUE_YES;
		}
		$data['updated_at'] = time();
		return $data;
	}

	/**
	 * @param $data
	 * @return $this
	 */
	public function add($data) {
		$data = $this->_before_insert($data);
		$data = $this->_before_save($data);
		// Add Record
		$result = ($this->get_collection())->insertOne($data);
		$id = $result->getInsertedId();
		if (empty($data['parent_id'])) {
			$update_data['path'] = '/' . $id . '/';
		} else {
			$update_data['path'] = $this->get_path($data['parent_id']) . $id . '/';
		}
		$this->update($id, $update_data);
		$this->_after_save($data);
		$this->_after_insert($data);
		return $result->getInsertedId();
	}

	/**
	 * @param $id
	 * @param $data
	 * @param bool $oid
	 * @return $this|MY_Model
	 */
	public function update($id, $data, $oid = true) {
		if ($oid) {
			$id = new MongoDB\BSON\ObjectId($id);
		}
		$data = $this->_before_save($data);
		if (empty($data['parent_id'])) {
			$data['path'] = '/' . $id . '/';
		} else {
			$data['path'] = $this->get_path($data['parent_id']) . $id . '/';
		}
		// Update Record
		($this->get_collection())->updateOne(
			array('_id' => $id),
			array('$set' => $data)
		);
		$this->_after_save($data);
		return $this;
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function get_path($id)
	{
		$entity = $this->find_one($id);
		return data_get($entity, 'path');
	}
}
