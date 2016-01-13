<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Model {

   var $name       = '';
   var $address    = '';
   var $phone      = '';
   var $note       = '';

   function __construct()
   {
      parent::__construct();
   }

   function insert_entry($table=NULL)
   {
      $this->name     = $this->input->post('name');
      $this->address  = $this->input->post('address');
      $this->phone    = $this->input->post('phone');
      $this->note     = $this->input->post('note');

      if (!(isset($table)) || !($this->db->table_exists($table)))
         return 0;

      $this->db->insert($table, $this);
      return $this->db->affected_rows();
   }

   function update_entry($table=NULL,$item=array(),$username=NULL)
   {
      if (!(isset($table)) || !($this->db->table_exists($table)))
         return 0;

      if(isset($item['id'])):
         $this->db->where('id',$item['id']);
         unset($item['id']);
         $this->db->update($table,$item);
         return $this->db->affected_rows();
      endif;
   }

   function delete_entry($table=NULL,$item=NULL,$username=NULL)
   {
      // $this->db->query("DELETE FROM entries WHERE md5(CONCAT(entries.id,'".$username."')) = '".$item."'");
      if (!(isset($table)) || !($this->db->table_exists($table)))
         return 0;

      $this->db->delete($table,array('id'=>$item));
      return $this->db->affected_rows();
   }

   function list_entry($table=NULL,$limit=1,$offset=1,$where=NULL,$like=NULL)
   {
      if (!(isset($table)) || !($this->db->table_exists($table)))
         return array();

      $this->db->order_by('id','DESC');
      $this->db->limit($limit,$offset);

      if (isset($where)):
         $array = array('id' => $where);
         $this->db->where($array);
      endif;

      return $this->db->get($table)->result_array();
   }

   function record_count($table=NULL)
   {
      if (!(isset($table)) || !($this->db->table_exists($table)))
         return 0;

      return $this->db->count_all($table);
   }
}
?>
