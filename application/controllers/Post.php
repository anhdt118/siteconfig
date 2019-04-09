<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller
{
	/**
	 * Post constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('post_model');
	}

	/**
	 * List Posts
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

		// Filters
		$filters = $this->input->get_post('filters');
		$conditions = array();
		if ($filters) {
			$conditions = analyze_filters($filters);
		}
		$collection = $this->post_model->find_collection(null, null, $conditions);
		$data = array(
			'title' => 'Manage Categories',
			'grid' => 'Categories',
			'filters' => $filters,
			'conditions' => $conditions,
			'collection' => $collection
		);
		
		echo $this->blade->view()->make('admin/post/index', $data)->render();
	}

	/**
	 * Create Configuration
	 */
	public function create()
	{
		global $client_css, $client_js;

		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/select2/css/select2.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/clockface/css/clockface.css';
		$client_css[] = base_url() . 'themes/admin/custom.css';

		$client_js[] = 'https://cloud.tinymce.com/5/tinymce.min.js?apiKey=' . TINY_KEY;
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/select2/js/select2.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/moment.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/clockface/js/clockface.js';
		$client_js[] = base_url() . 'client/js/admin/post.js';

		$data = array(
			'entity' => new stdClass(),
			'title' => 'Create new post',
			'categories' => $this->category_model->find_collection(null, null, array('status' => MY_Model::VALUE_YES))
		);

		echo $this->blade->view()->make('admin/post/edit', $data)->render();
	}

	/**
	 * Edit Configuration
	 */
	public function edit($key = null, $id = null)
	{
		if (empty($key) || empty($id)) {
			return redirect(site_url('post/index'));
		}
		global $client_css, $client_js;

		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/select2/css/select2.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/clockface/css/clockface.css';
		$client_css[] = base_url() . 'themes/admin/custom.css';

		$client_js[] = 'https://cloud.tinymce.com/5/tinymce.min.js?apiKey=' . TINY_KEY;
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/select2/js/select2.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/moment.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/clockface/js/clockface.js';
		$client_js[] = base_url() . 'client/js/admin/post.js';

		$data = array(
			'entity' => $this->post_model->find_one($id)
		);
		$data['categories'] = $this->category_model->find_collection(null, null, array('status' => MY_Model::VALUE_YES));
		if (empty($data['entity']->id)) {
			return redirect(site_url('post/index'));
		}
		$data['title'] = (!empty($data['entity'])) ? data_get($data['entity'], 'name') : 'Manage posts';

		echo $this->blade->view()->make('admin/post/edit', $data)->render();
	}

	/**
	 * Save
	 */
	public function save()
	{
		$id = $this->input->post('id');
		$data = $this->input->post('data');
		if (empty($id)) {
			$id = $this->post_model->add($data);
			echo $id;
		} else {
			$this->post_model->update($id, $data);
		}
		return redirect(site_url('post/edit/id/') . $id);
	}
}
