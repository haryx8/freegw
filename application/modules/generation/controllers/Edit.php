<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends MY_Controller {

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
		if($this->input->post()):
			$editId = $this->input->post('editId');
			$editId = $this->crypto->decrypt($editId[0],$this->_ekey,256);
			$this->session->set_flashdata('editId',$editId);
			redirect(site_url($this->_module.'/edit'), 'location');
		endif;
		$editId = $this->session->flashdata('editId');
		if(isset($editId)):
			$validation_errors = $this->session->flashdata('validation_errors');
			$editData = $this->session->flashdata('editData');
			if(isset($validation_errors)){
				$this->_data["validation_errors"] = $validation_errors;
				if(isset($editData))
					$this->_data['results'] = $editData;
			}else{
				$this->load->model('gallery');
				$this->_data['results'] = $this->gallery->list_entry($table,0,1,$editId);
				foreach($this->_data["results"] as $key => $val)
					$this->_data["results"][$key]['id'] = $this->crypto->encrypt($val['id'],$this->_ekey,256);
				$this->_data['results'] = reset($this->_data['results']);
			}
			$this->layout->view($this->_controller, $this->_data);
		else:
			redirect(site_url($this->_module.'/view'), 'location');
		endif;
	}
}
