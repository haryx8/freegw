<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Model {

   function __construct()
   {
      parent::__construct();
   }

   function authenticate()
   {
      $access['username'] = $_POST['username'];
      $access['password'] = md5($_POST['password']);

      if (!(isset($access['username'])))
         return false;

      if (!(isset($access['password'])))
         return false;

      $this->db->get_where('users', $access)->result_array();
      return $this->db->affected_rows();
   }
}
?>
