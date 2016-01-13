<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends MY_Controller {

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
		$this->load->model('gallery');
		$this->load->library('pagination');

		$this->pagination->set_my_per_page(5);
		$total_rows = $this->gallery->record_count($table);
		$this->pagination->set_my_total_rows($total_rows);
		$per_page = $this->pagination->get_my_per_page();
		$this->pagination->set_my_base_url(
			$this->_action,
			$this->_controller,
			$this->_module
		);

		$page = (int)($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if ($page > $total_rows)
			redirect(site_url($this->_module.'/'.$this->_controller), 'location'); //$page = 0;

		$this->_data["links"] 			= $this->pagination->create_links();
		$this->_data['affected_rows'] = $this->session->flashdata('affected_rows');
		$this->_data["results"] 		= $this->gallery->list_entry($table,$per_page,$page);

		foreach($this->_data["results"] as $key => $val)
			$this->_data["results"][$key]['id'] = $this->crypto->encrypt($val['id'],$this->_ekey,256);

		$this->layout->view($this->_controller, $this->_data);
	}
}
