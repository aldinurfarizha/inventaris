<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Model{
    function login($data)
    {
      $this->db->select('user.*');
      $this->db->from('user');
      $this->db->where($data);
      return $this->db->get();
    }
}
?>