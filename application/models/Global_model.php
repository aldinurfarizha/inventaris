<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model{

    function insert($table,$data)
    {
      return $this->db->insert($table, $data);
    }
    function update($table,$where,$data)
    {
      $this->db->set($data);
      $this->db->where($where);
      return $this->db->update($table);
    }
     function delete($table,$data){
      $this->db->where($data);
      return $this->db->delete($table);
    }
    function get_all($table)
    {
      return $this->db->get($table);
    }
    function get_by_id($table, $param)
    {
      $this->db->select('*');
      $this->db->where($param);
      return $this->db->get($table);
    }
    function insertcallback($table,$data){
      return ($this->db->insert($table, $data))  ?   $this->db->insert_id()  :   false;
    }
   
}
?>