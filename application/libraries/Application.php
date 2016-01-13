<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Application extends CI_Router {
  public $_action       = NULL;
  public $_controller   = NULL;
  public $_module       = NULL;

  public function __construct(){
    $ci =& get_instance();
    $this->_action      = $ci->router->method;
    $this->_controller  = $ci->router->class;
    $this->_module      = $ci->router->module;
  }

  public function get_action(){
    return $ci->router->method;
  }

  public function get_controller(){
    return $ci->router->controller;
  }

  public function get_module(){
    return $ci->router->module;
  }

  public function set_action(){

  }

  public function set_controller(){

  }

  public function set_module(){

  }
}
