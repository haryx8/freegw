<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$table = $this->_module;
		$affected_rows = 0;
		$view = $this->_controller;
		if($this->input->post()){
			$inputData = $this->input->post();
			$this->load->library('form_validation');
			if ($this->form_validation->run($table) == FALSE):
				$this->session->set_flashdata('validation_errors', validation_errors());
				$this->session->set_flashdata('inputData', $inputData);
			else:
				$this->load->model('gallery');
				$affected_rows = $this->gallery->insert_entry($table);
			endif;
			$this->session->set_flashdata('affected_rows', $affected_rows);
			redirect(site_url($this->_module.'/'.$view), 'location');
		}
		$affected_rows = $this->session->flashdata('affected_rows');
		if ($affected_rows > 0):
			$this->session->set_flashdata('affected_rows', $affected_rows);
			redirect(site_url($this->_module.'/view'), 'location');
		else:
			$validation_errors = $this->session->flashdata('validation_errors');
			$inputData = $this->session->flashdata('inputData');
			if (isset($validation_errors)):
				$this->_data['validation_errors'] = $validation_errors;
				$this->_data['results'] = $inputData;
			endif;
			$this->layout->view($view, $this->_data);
		endif;
	}
}
