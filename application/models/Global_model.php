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
    function is_kode_barang_available($kd_barang){
      if($this->db->where(["kd_barang"=>$kd_barang])->from('master_barang')->count_all_results()==0){
        return true;
      }else{
        return false;
      }
    }
    function master_barang(){
      $this->db->select('*');
      $this->db->from('master_barang');
      $this->db->join('kategori_barang', 'master_barang.kd_kategori = kategori_barang.kd_kategori');
      $this->db->where(['deleted'=>0]);
      return $this->db->get();
    }
    function sub_bagian(){
      $this->db->select('sub_office_bagian.nama as nama_sub_bagian,sub_office_bagian.*, sub_office.nama as nama_sub_office,sub_office.*');
      $this->db->from('sub_office_bagian');
      $this->db->join('sub_office', 'sub_office_bagian.sub_id=sub_office.sub_id', 'left');
      return $this->db->get();

    }
}
?>