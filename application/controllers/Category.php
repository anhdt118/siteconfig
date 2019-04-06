<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{
	/**
	 * Category constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
	}

	/**
	 * List Categorys
	 */
	public function index()
	{
		global $client_css, $client_js;
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/datatables/datatables.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/scripts/datatable.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/datatables/datatables.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/pages/scripts/table-datatables-scroller.min.js';
		$collection = $this->category_model->find_collection();
		$data = array(
			'title' => 'Manage Categories',
			'grid' => 'Categories',
			'collection' => $collection
		);
		echo $this->blade->view()->make('admin/category/index', $data)->render();
	}

	/**
	 * Create Configuration
	 */
	public function create()
	{
		global $client_css;
		$client_css[] = base_url() . 'themes/admin/custom.css';
		$data = array(
			'entity' => new stdClass(),
			'parents' => $this->category_model->find_collection(),
			'title' => 'Create new category'
		);
		echo $this->blade->view()->make('admin/category/edit', $data)->render();
	}

	/**
	 * Edit Configuration
	 */
	public function edit($key = null, $id = null)
	{
		if (empty($key) || empty($id)) {
			return redirect(site_url('category/index'));
		}
		global $client_css;
		$client_css[] = base_url() . 'themes/admin/custom.css';
		$data = array(
			'entity' => $this->category_model->find_one($id)
		);
		if (empty($data['entity']->id)) {
			return redirect(site_url('category/index'));
		}
		$data['parents'] = $this->category_model->find_collection(null, null, array('_id' => array('$ne' => new \MongoDB\BSON\ObjectId($id))));
		$data['title'] = (!empty($data['entity'])) ? data_get($data['entity'], 'name') : 'Manage categories';
		echo $this->blade->view()->make('admin/category/edit', $data)->render();
	}

	/**
	 * Save entity
	 */
	public function save()
	{
		$id = $this->input->post('id');
		$data = $this->input->post('data');
		if (empty($id)) {
			$id = $this->category_model->add($data);
			echo $id;
		} else {
			$this->category_model->update($id, $data);
		}
		return redirect(site_url('category/edit/id/') . $id);
	}

	/**
	 * Delete entity
	 * @param null $key
	 * @param null $id
	 */
	public function delete($key = null, $id = null)
	{
		if (empty($key) || empty($id)) {
			return redirect(site_url('category/index'));
		}
		$entity = $this->category_model->find_one($id);
		if (empty($entity->id)) {
			return redirect(site_url('category/index'));
		}
		$this->category_model->delete($id);
		return redirect(site_url('category/index'));
	}
}
