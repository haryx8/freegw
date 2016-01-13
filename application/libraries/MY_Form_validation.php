<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

   public function __construct(){
      parent::__construct();
      parent::set_error_delimiters('<div>','</div>');
   }

   public function run($group = ''){
      // Is there a validation rule for the particular URI being accessed?
      $uri = ($group == '') ? trim($this->CI->uri->ruri_string(), '/') : $group;

      if ($uri != '' AND !isset($this->_config_rules[$uri]))
         $this->load_rules_from_database($uri);

      return parent::run($group);
   }

   public function load_rules_from_database($form_key){
      $this->CI->load->database();
      $qry = $this->CI->db->get_where(
         'form_validation',
         array('form_key'=>$form_key)
      );

      foreach ($qry->result() as $row)
         $this->set_rules($row->field, $row->title, $row->rules);
   }
}
