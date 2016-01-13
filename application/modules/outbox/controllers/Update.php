<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends MY_Controller {
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
		if($this->input->post()):
			$this->load->library('form_validation');

			$editData = $this->input->post();
			$editId = $this->crypto->decrypt($editData['editId'],$this->_ekey,256);

			if ($this->form_validation->run($table) == FALSE):
				$editData['id'] = $editData['editId'];
				unset($editData['editId']);
				$this->session->set_flashdata('validation_errors', validation_errors());
				$this->session->set_flashdata('editId',$editId);
				$this->session->set_flashdata('editData',$editData);
				redirect(site_url($this->_module.'/edit'), 'location');
			else:
				$editData['id'] = $editId;
				unset($editData['editId']);
				$this->session->set_flashdata('editData',$editData);
				redirect(site_url($this->_module.'/'.$this->_controller), 'location');
			endif;
		endif;

		$editData = $this->session->flashdata('editData');
		if(isset($editData)):
			$this->load->model('gallery');
			$affected_rows = $this->gallery->update_entry($table,$editData);
		endif;

		$this->session->set_flashdata('affected_rows', $affected_rows);
		redirect(site_url($this->_module.'/view'), 'location');
	}
}
