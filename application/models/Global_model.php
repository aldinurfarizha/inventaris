<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model{

    function insert($table,$data)
    {
      $this->db->insert($table, $data);
      return $this->db->affected_rows();
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
    function is_kode_perkiraan_available($kd_barang){
      if($this->db->where(["kd_perkiraan"=>$kd_barang])->from('master_perkiraan')->count_all_results()==0){
        return true;
      }else{
        return false;
      }
    }
    function inventaris($where){
      $this->db->select('inventaris.*, master_barang.*, office.*, office.nama as nama_kantor, sub_office.nama as nama_sub_kantor,master_perkiraan.*, master_perkiraan_dasar.*');
      $this->db->from('inventaris');
      $this->db->join('master_barang','master_barang.id_barang=inventaris.id_barang', 'left');
      $this->db->join('master_perkiraan','master_barang.id_perkiraan=master_perkiraan.id_perkiraan');
      $this->db->join('master_perkiraan_dasar', 'master_perkiraan.kd_perkiraan_dasar = master_perkiraan_dasar.kd_perkiraan_dasar');
      $this->db->join('office','office.of_id=inventaris.of_id', 'left');
      $this->db->join('sub_office','sub_office.sub_id=inventaris.sub_id', 'left');
      $this->db->where($where);
      return $this->db->get();

    }
    function master_perkiraan(){
      $this->db->select('master_perkiraan.*,master_perkiraan_dasar.*');
      $this->db->from('master_perkiraan');
      $this->db->join('master_perkiraan_dasar', 'master_perkiraan.kd_perkiraan_dasar = master_perkiraan_dasar.kd_perkiraan_dasar');
      $this->db->where(['deleted'=>0]);
      return $this->db->get();
    }
     function master_barang(){
      $this->db->select('master_barang.*, master_perkiraan.*, master_perkiraan_dasar.*');
      $this->db->from('master_barang');
      $this->db->join('master_perkiraan', 'master_barang.id_perkiraan = master_perkiraan.id_perkiraan');
      $this->db->join('master_perkiraan_dasar', 'master_perkiraan.kd_perkiraan_dasar = master_perkiraan_dasar.kd_perkiraan_dasar');
      $this->db->where(['master_barang.deleted'=>0]);
      return $this->db->get();
    }
     function master_barang_detail($id){
      $this->db->select('master_barang.*, master_perkiraan.*, master_perkiraan_dasar.*');
      $this->db->from('master_barang');
      $this->db->join('master_perkiraan', 'master_barang.id_perkiraan = master_perkiraan.id_perkiraan');
      $this->db->join('master_perkiraan_dasar', 'master_perkiraan.kd_perkiraan_dasar = master_perkiraan_dasar.kd_perkiraan_dasar');
      $this->db->where(['master_barang.id_barang'=>$id]);
      return $this->db->get();
    }
    function sub_bagian(){
      $this->db->select('sub_office_bagian.nama as nama_sub_bagian,sub_office_bagian.*, sub_office.nama as nama_sub_office,sub_office.*');
      $this->db->from('sub_office_bagian');
      $this->db->join('sub_office', 'sub_office_bagian.sub_id=sub_office.sub_id', 'left');
      return $this->db->get();
    }
    function get_detail_inventaris($id){
      $this->db->select('inventaris.*, master_barang.*, office.*, office.nama as nama_kantor, sub_office.nama as nama_sub_kantor,master_perkiraan.*, master_perkiraan_dasar.*');
      $this->db->from('inventaris');
      $this->db->join('master_barang','master_barang.id_barang=inventaris.id_barang');
      $this->db->join('master_perkiraan','master_barang.id_perkiraan=master_perkiraan.id_perkiraan');
      $this->db->join('master_perkiraan_dasar', 'master_perkiraan.kd_perkiraan_dasar = master_perkiraan_dasar.kd_perkiraan_dasar');
      $this->db->join('office','office.of_id=inventaris.of_id');
      $this->db->join('sub_office','sub_office.sub_id=inventaris.sub_id','left');
      $this->db->where(['id_inventaris'=>$id]);
      return $this->db->get();
    }
    function get_history($id){
      $this->db->select('history_update.*, office.*');
      $this->db->from('history_update');
      $this->db->join('office', 'history_update.of_id = office.of_id');
      $this->db->where(['id_inventaris'=>$id]);
      return $this->db->get();
    }
    function createBA($berita_acara,$item_barang){
      $this->db->insert('berita_acara', $berita_acara) ?   $id_berita_acara=$this->db->insert_id()  :   $id_berita_acara=false;
     if($id_berita_acara){
      foreach($item_barang as $barang):
        $data=array(
          'id_berita_acara'=>$id_berita_acara,
          'id_inventaris'=>$barang
        );
        $this->db->insert('berita_acara_inventaris',$data);
      endforeach;
     }
     return $id_berita_acara;
    }
    function getBarangBA($id_berita_acara){
      $this->db->select('berita_acara_inventaris.*, inventaris.*, count(inventaris.id_barang)as total,master_barang.*');
      $this->db->from('berita_acara_inventaris');
      $this->db->join('inventaris', 'berita_acara_inventaris.id_inventaris = inventaris.id_inventaris');
      $this->db->join('master_barang','master_barang.id_barang=inventaris.id_barang', 'left');
      $this->db->where(['berita_acara_inventaris.id_berita_acara'=>$id_berita_acara]);
      $this->db->group_by('inventaris.id_barang'); 
      return $this->db->get();
    }
}
?>