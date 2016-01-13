<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

	protected $_data = array();

	public function __construct(){
		parent::__construct();
		// decrypt post var
		if ($this->input->post()){
			$this->load->library('crypto');
			$ekey = $this->config->item('encryption_key');
			$cktknm = $this->config->item('csrf_token_name');
			$blacklist = array('submit',$cktknm);

			foreach ($this->input->post() as $key => $val) {
				if (!(in_array($key,$blacklist)))
					$_POST[$key] = $this->crypto->decrypt($this->input->post($key),$ekey,256);
			}
		}

		$this->_data['action'] = $this->application->_action;
		$this->_data['controller'] = $this->application->_controller;
		$this->_data['module'] = $this->application->_module;

		$username = $this->session->userdata('username');
		if (isset($username))
			redirect(site_url('home'), 'location');
	}

	public function index(){
		if($this->input->post()):
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div>', '</div>');
			$this->form_validation->set_rules('username', 'Name', 'required|alpha_numeric|max_length[50]');
			$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|max_length[50]');

			if ($this->form_validation->run() == FALSE):
				$this->session->set_flashdata('validation_errors',validation_errors());
			else:
				$this->load->model('auth');
				$auth = $this->auth->authenticate();
				if ($auth > 0):
					$login['username'] = $this->input->post('username');
					$this->session->set_userdata($login);
				else:
					$this->session->set_flashdata('validation_errors','<div>Your username and password is mismatch</div>');
				endif;
			endif;

			redirect(site_url($this->application->_module.'/login'), 'location');
		endif;

		$validation_errors = $this->session->flashdata('validation_errors');
		if (isset($validation_errors))
			$this->_data['validation_errors'] = $validation_errors;

		$this->layout->view($this->application->_module.'/login',$this->_data);
	}
}
