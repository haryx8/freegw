<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends MY_Controller {

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
			$lists = $this->input->post('lists');
			if (count($lists)):
				foreach($lists as $key => $val){
					$val = $this->crypto->decrypt($val,$this->_ekey,256);
					$this->load->model('gallery');
					$affected_rows += $this->gallery->delete_entry($table,$val);
				}
			endif;
		endif;
		$this->session->set_flashdata('affected_rows', $affected_rows);
		redirect(site_url($this->_module.'/view'), 'location');
	}
}
