<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Layout {
  var $obj;
  var $layout;

  function Layout($layout="default"){
    $this->obj =& get_instance();
    $this->layout = $layout;
  }

  function setLayout($layout){
    $this->layout = $layout;
  }

  function view($view,$data=null,$return=false){
    $loadedData['content_for_layout'] = $this->obj->load->view($view,$data,true);
    if($return):
      return $this->obj->load->view('layouts/'.$this->layout, $loadedData, true);
    else:
      $this->obj->load->view('layouts/'.$this->layout, $loadedData, false);
    endif;
  }
}
?>
