<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
   protected $_action = NULL;
   protected $_controller = NULL;
   protected $_module = NULL;
   protected $_data = array();
   protected $_ekey = NULL;

   public function __construct(){
      parent::__construct();

   	// $this->output->enable_profiler(TRUE);

      $this->_ekey = $this->config->item('encryption_key');

      // decrypt post var
      $this->load->library('crypto');
      if ($this->input->post()):
         $cktknm = $this->config->item('csrf_token_name');
         $blacklist = array('submit',$cktknm);

         foreach ($this->input->post() as $key => $val) {
            if (!(in_array($key,$blacklist))):
               if (!(is_array($_POST[$key])))
                  $_POST[$key] = $this->crypto->decrypt($this->input->post($key),$this->_ekey,256);
            endif;
         }
      endif;

      $this->_data['action'] = $this->_action = $this->application->_action;
      $this->_data['controller'] = $this->_controller = $this->application->_controller;
      $this->_data['module'] = $this->_module = $this->application->_module;

      $username = $this->session->userdata('username');
      if (!(isset($username)) || empty($username)):
         redirect(site_url('user/login'), 'location');
      else:
         $this->_data['username']	= $username;
      endif;
   }
}
