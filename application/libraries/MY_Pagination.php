<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Pagination extends CI_Pagination {
   private $_config = array(
      'base_url' => NULL,
      'total_rows' => 0,
      'per_page' => 5,
      'full_tag_open' => '<div><ul class="pagination">',
      'full_tag_close' => '</ul></div>',
      'first_tag_open' => '<li>',
      'first_tag_close' => '</li>',
      'next_tag_open' => '<li>',
      'next_tag_close' => '</li>',
      'cur_tag_open' => '<li class="active"><a href="javascript:void(0);">',
      'cur_tag_close' => '</a></li>',
      'num_tag_open' => '<li>',
      'num_tag_close' => '</li>',
      'prev_tag_open' => '<li>',
      'prev_tag_close' => '</li>',
      'last_tag_open' => '<li>',
      'last_tag_close' => '</li>',
   );

   public function __construct(){
      parent::__construct();

      $this->initialize($this->_config);
   }

   public function set_my_per_page($val = NULL){
      if (isset($val))
         $this->_config['per_page'] = (string)$val;

      $this->initialize($this->_config);
   }

   public function get_my_per_page(){
      return (string)$this->_config['per_page'];
   }

   public function set_my_total_rows($val = NULL){
      if (isset($val))
         $this->_config['total_rows'] = (string)$val;

      $this->initialize($this->_config);
   }

   public function get_my_total_rows(){
      return (string)$this->_config['total_rows'];
   }

   public function set_my_base_url($action=NULL,$controller=NULL,$module=NULL){
      $url = NULL;

      if(isset($action) && !(empty($action)))
         $url = $action;

      if(isset($controller) && !(empty($controller))){
         if(isset($action) && !(empty($action)))
            $url = $controller.'/'.$action;
      }

      if(isset($module) && !(empty($module))){
         if(isset($controller) && !(empty($controller))){
            if(isset($action) && !(empty($action)))
               $url = $module.'/'.$controller.'/'.$action;
         }
      }

      $this->_config['base_url'] = site_url($url);
      $this->initialize($this->_config);
   }

   public function get_my_base_url(){
      return (string)$this->_config['base_url'];
   }

}
