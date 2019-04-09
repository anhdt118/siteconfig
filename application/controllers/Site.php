<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller
{
	/**
	 * Site constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('site_model');
	}

	/**
	 * List Sites
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
		$collection = $this->site_model->find_collection(null, null, $conditions);
		$data = array(
			'title' => 'Manage Categories',
			'grid' => 'Categories',
			'filters' => $filters,
			'conditions' => $conditions,
			'collection' => $collection
		);
		
		echo $this->blade->view()->make('admin/site/index', $data)->render();
	}

	/**
	 * Create Configuration
	 */
	public function create()
	{

		global $client_css, $client_js;

		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/jquery-minicolors/jquery.minicolors.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/dropzone/dropzone.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/lib/codemirror.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/theme/neat.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/theme/ambiance.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/theme/material.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/theme/neo.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/dropzone/basic.min.css';
		$client_css[] = base_url() . 'themes/admin/custom.css';

		$client_js[] = base_url() . 'themes/admin/theme/assets/pages/scripts/components-color-pickers.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/dropzone/dropzone.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/lib/codemirror.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/mode/javascript/javascript.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/mode/htmlmixed/htmlmixed.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/mode/css/css.js';
		$client_js[] = 'https://cloud.tinymce.com/5/tinymce.min.js?apiKey=' . TINY_KEY;
		$client_js[] = base_url() . 'client/js/admin/site.js';

		$data = array(
			'entity' => new stdClass(),
			'title' => 'Create new site'
		);

		echo $this->blade->view()->make('admin/site/edit', $data)->render();
	}

	/**
	 * Edit Configuration
	 */
	public function edit($key = null, $id = null)
	{
		if (empty($key) || empty($id)) {
			return redirect(site_url('category/index'));
		}

		global $client_css, $client_js;

		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/jquery-minicolors/jquery.minicolors.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/dropzone/dropzone.min.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/lib/codemirror.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/theme/neat.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/theme/ambiance.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/theme/material.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/theme/neo.css';
		$client_css[] = base_url() . 'themes/admin/theme/assets/global/plugins/dropzone/basic.min.css';
		$client_css[] = base_url() . 'themes/admin/custom.css';

		$client_js[] = base_url() . 'themes/admin/theme/assets/pages/scripts/components-color-pickers.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/dropzone/dropzone.min.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/lib/codemirror.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/mode/javascript/javascript.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/mode/htmlmixed/htmlmixed.js';
		$client_js[] = base_url() . 'themes/admin/theme/assets/global/plugins/codemirror/mode/css/css.js';
		$client_js[] = 'https://cloud.tinymce.com/5/tinymce.min.js?apiKey=' . TINY_KEY;
		$client_js[] = base_url() . 'client/js/admin/site.js';

		$data = array(
			'entity' => $this->site_model->find_one($id)
		);
		if (empty($data['entity']->id)) {
			return redirect(site_url('site/index'));
		}
		$data['title'] = (!empty($data['entity'])) ? data_get($data['entity'], 'name') : 'Manage Sites';

		echo $this->blade->view()->make('admin/site/edit', $data)->render();
	}

	/**
	 * Save
	 */
	public function save()
	{
		$id = $this->input->post('id');
		$data = $this->input->post('data');
		if (empty($id)) {
			$id = $this->site_model->add($data);
		} else {
			$this->site_model->update($id, $data);
		}
		return redirect(site_url('site/edit/id/') . $id);
	}

	/**
	 * Upload Logo
	 */
	public function upload_logo()
	{
		$ds = DIRECTORY_SEPARATOR;
		$folder = './media/uploaded/sites/logo';
		if (!empty($_FILES)) {
			$temp = $_FILES['file']['tmp_name'];
			$path = $folder . $ds;
			$file = $path . render_file_name($_FILES['file']['name']);
			move_uploaded_file($temp, $file);
			echo render_src(str_replace('\\', '/', $file));
		}
	}
}
