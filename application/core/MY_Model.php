<?php

use MongoDB\BSON\ObjectId;

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	const VALUE_YES = 1;
	const VALUE_NO = 2;

	/**
	 * @var array
	 */
	protected $mongodb = null;
	protected $entity_configuration = array();
	protected $blade = null;
	protected $database_client = null;
	protected $data = null;

	/**
	 * MY_Model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load_database_config();
	}

	/**
	 * @return array
	 */
	public function load_database_config() {
		// Init MongoDB
		$this->entity_configuration['mongodb'] = $this->config->item('mongodb');
		$this->database_client = (new MongoDB\Client($this->get_connection_string()));
		$this->mongodb = $this->database_client->selectDatabase($this->entity_configuration['mongodb']['database']);
		return $this->entity_configuration;
	}

	/**
	 * @return string
	 */
	public function get_connection_string() {
		$connection_string = sprintf(
			'mongodb://%s:%s',
			data_get($this->entity_configuration['mongodb'], 'host'),
			data_get($this->entity_configuration['mongodb'], 'port')
		);
		return $connection_string;
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	protected function _before_save($data) {
		$data['updated_at'] = time();
		return $data;
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	protected function _after_save($data) {
		return $data;
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	protected function _before_insert($data) {
		$data['created_at'] = time();
		return $data;
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	protected function _after_insert($data) {
		return $data;
	}

	/**
	 * @param $id
	 * @return $this
	 */
	protected function _before_delete($id) {
		return $this;
	}

	/**
	 * @param $id
	 * @return $this
	 */
	protected function _after_delete($id) {
		return $this;
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
		$this->_after_save($data);
		$this->_after_insert($data);
		return $result->getInsertedId();
	}

	/**
	 * @param $id
	 * @param $data
	 * @param bool $oid
	 * @return $this
	 */
	public function update($id, $data, $oid = true) {
		if ($oid) {
			$id = new MongoDB\BSON\ObjectId($id);
		}
		$data = $this->_before_save($data);
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
	 * @param bool $oid
	 * @return $this
	 */
	public function delete($id, $oid = true) {
		if ($oid) {
			$id = new MongoDB\BSON\ObjectId($id);
		}
		$this->_before_delete($id);
		$this->get_collection()->deleteOne(array('_id' => $id));
		$this->_after_delete($id);
		return $this;
	}

	/**
	 * Get MongoDB Collection
	 */
	public function get_collection() {
		$collection = data_get($this->entity_configuration, 'collection');
		return $this->mongodb->$collection;
	}

	/**
	 * @return |null
	 */
	public function get_data() {
		return $this->data;
	}

	/**
	 * @param $id
	 * @param bool $reload
	 * @return |null
	 */
	public function find_one($id, $reload = false) {
		$id = new MongoDB\BSON\ObjectId($id);
		if (empty($this->data) || $reload) {
			$this->data = $this->get_collection()->findOne(array('_id' => $id));
			if (!empty($this->data)) {
				$this->data->id = $id;
			}
		}
		return $this->data;
	}

	/**
	 * @param null $start
	 * @param null $limit
	 * @param array $filters
	 * @param array $sorters
	 * @return mixed
	 */
	public function find_collection($start = null, $limit = null, $filters = array(), $sorters = array()) {
		$collection = $this->get_collection()->find(
			$filters,
			array(
				'skip' => $start,
				'limit' => $limit,
				'sort' => $sorters
			)
		);
		return $collection->toArray();
	}
}
