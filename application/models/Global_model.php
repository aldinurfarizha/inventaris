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
      $this->db->select('inventaris.*, master_barang.*, office.*, office.nama as nama_kantor, sub_office.nama as nama_sub_kantor,master_perkiraan.*, master_perkiraan_dasar.*, master_ruangan_kir.nama_ruangan');
      $this->db->from('inventaris');
      $this->db->join('master_barang','master_barang.id_barang=inventaris.id_barang', 'left');
      $this->db->join('master_perkiraan','master_barang.id_perkiraan=master_perkiraan.id_perkiraan');
      $this->db->join('master_perkiraan_dasar', 'master_perkiraan.kd_perkiraan_dasar = master_perkiraan_dasar.kd_perkiraan_dasar');
      $this->db->join('office','office.of_id=inventaris.of_id', 'left');
      $this->db->join('sub_office','sub_office.sub_id=inventaris.sub_id', 'left');
      $this->db->join('master_ruangan_kir','inventaris.id_ruangan_kir=master_ruangan_kir.id_ruangan_kir', 'left');
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
      $this->db->select('inventaris.*, master_barang.*, office.*, office.nama as nama_kantor, sub_office.nama as nama_sub_kantor,master_perkiraan.*, master_perkiraan_dasar.*, master_ruangan_kir.nama_ruangan');
      $this->db->from('inventaris');
      $this->db->join('master_barang','master_barang.id_barang=inventaris.id_barang');
      $this->db->join('master_perkiraan','master_barang.id_perkiraan=master_perkiraan.id_perkiraan');
      $this->db->join('master_perkiraan_dasar', 'master_perkiraan.kd_perkiraan_dasar = master_perkiraan_dasar.kd_perkiraan_dasar');
      $this->db->join('office','office.of_id=inventaris.of_id');
      $this->db->join('sub_office','sub_office.sub_id=inventaris.sub_id','left');
      $this->db->join('master_ruangan_kir','inventaris.id_ruangan_kir=master_ruangan_kir.id_ruangan_kir', 'left');
      $this->db->where(['id_inventaris'=>$id]);
      return $this->db->get();
    }
    function get_history($id){
      $this->db->select('history_update.*');
      $this->db->from('history_update');
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
    function getInventarisMutasi($id_mutasi){
      $this->db->select('mutasi_inventaris.*, inventaris.*, count(inventaris.id_barang)as total,master_barang.*');
      $this->db->from('mutasi_inventaris');
      $this->db->join('inventaris', 'mutasi_inventaris.id_inventaris = inventaris.id_inventaris');
      $this->db->join('master_barang','master_barang.id_barang=inventaris.id_barang', 'left');
      $this->db->where(['mutasi_inventaris.id_mutasi'=>$id_mutasi]);
      return $this->db->get();
    }
    function getInventarisPenghapusan($id_penghapusan){
      $this->db->select('penghapusan_inventaris.*, inventaris.*, count(inventaris.id_barang)as total,master_barang.*');
      $this->db->from('penghapusan_inventaris');
      $this->db->join('inventaris', 'penghapusan_inventaris.id_inventaris = inventaris.id_inventaris');
      $this->db->join('master_barang','master_barang.id_barang=inventaris.id_barang', 'left');
      $this->db->where(['penghapusan_inventaris.id_penghapusan'=>$id_penghapusan]);
      return $this->db->get();
    }
    function getKIRBarang($id_kartu_inventaris){
      $this->db->select('kartu_inventaris_barang.*, inventaris.*,master_barang.*');
      $this->db->from('kartu_inventaris_barang');
      $this->db->join('inventaris', 'kartu_inventaris_barang.id_inventaris = inventaris.id_inventaris');
      $this->db->join('master_barang','master_barang.id_barang=inventaris.id_barang', 'left');
      $this->db->where(['kartu_inventaris_barang.id_kartu_inventaris'=>$id_kartu_inventaris]);
      return $this->db->get();
    }
    function createMutasi($data,$item_barang){
      $this->db->insert('mutasi', $data) ?   $id_mutasi=$this->db->insert_id()  :   $id_mutasi=false;
     if($id_mutasi){
      foreach($item_barang as $barang):
        $detail_barang=get_detail_barang($barang);
        if($detail_barang->kondisi_baik){
          $kondisi="Baik";
        }{
          $kondisi="Rusak";
        }
        if($detail_barang->pernah_servis){
          $servis="Pernah Servis";
        }else{
          $servis="Blm Pernah Service";
        }
        $kondisi_terakhir=$kondisi.', '.$servis;
        $mutasi_inventaris=array(
          'id_mutasi'=>$id_mutasi,
          'id_inventaris'=>$barang,
          'kondisi_terakhir'=>$kondisi_terakhir
        );
        $this->db->insert('mutasi_inventaris',$mutasi_inventaris);

        //pemindahan kantor pada data inventaris
        $new_office=array(
          'of_id'=>$data['of_id_penerima'],
          'sub_id'=>$data['sub_id_penerima']
        );
        $where=array(
          'id_inventaris'=>$barang
        );
        $this->db->set($new_office);
        $this->db->where($where);
        $this->db->update('inventaris');
      endforeach;
     }
     return $id_mutasi;
    }
    function createPenghapusan($data,$item_barang){
      $this->db->insert('penghapusan', $data) ?   $id_penghapusan=$this->db->insert_id()  :   $id_penghapusan=false;
     if($id_penghapusan){
      foreach($item_barang as $barang):
        $detail_barang=get_detail_barang($barang);
        if($detail_barang->kondisi_baik){
          $kondisi="Baik";
        }{
          $kondisi="Rusak";
        }
        if($detail_barang->pernah_servis){
          $servis="Pernah Servis";
        }else{
          $servis="Blm Pernah Service";
        }
        $kondisi_terakhir=$kondisi.', '.$servis;
        $penghapusan_inventaris=array(
          'id_penghapusan'=>$id_penghapusan,
          'id_inventaris'=>$barang,
          'kondisi_terakhir'=>$kondisi_terakhir
        );
        $this->db->insert('penghapusan_inventaris',$penghapusan_inventaris);

        //perubahan status pada inventaris
        $new_office=array(
          'status'=>0,
        );
        $where=array(
          'id_inventaris'=>$barang
        );
        $this->db->set($new_office);
        $this->db->where($where);
        $this->db->update('inventaris');
      endforeach;
     }
     return $id_penghapusan;
    }
    function createKIR($data){
      $this->db->insert('kartu_inventaris', $data) ?   $id_kartu_inventaris=$this->db->insert_id()  :   $id_kartu_inventaris=false;
     if($id_kartu_inventaris){
      $inventaris=getInventarisByIdRuanganKir($data['id_ruangan_kir'])->result();
      foreach($inventaris as $inven):
       if($inven->kondisi_baik){
          $kondisi="Baik";
        }else{
          $kondisi="Rusak";
        }
        if($inven->pernah_servis){
          $servis="Pernah Servis";
        }else{
          $servis="Blm Pernah Service";
        }
        $kondisi_terakhir=$kondisi.', '.$servis;
        $data=array(
          'id_kartu_inventaris'=>$id_kartu_inventaris,
          'id_inventaris'=>$inven->id_inventaris,
          'kondisi_terakhir'=>$kondisi_terakhir
        );
        $this->db->insert('kartu_inventaris_barang',$data);
      endforeach;
     }
     return $id_kartu_inventaris;
    }
    function dashboard(){
      $bulanini=date('m');
      $tahunini=date('Y');
      $data=$this->db->query("SELECT 
      (SELECT COUNT(id_inventaris) as total_inventaris FROM inventaris WHERE status = 1) as total_inventaris,
      (SELECT COUNT(id_inventaris) as total_perolehan FROM inventaris WHERE status = 1 AND y = $tahunini AND m = $bulanini) as total_perolehan,
      (SELECT COUNT(id_penghapusan_inventaris) as total_penghapusan FROM penghapusan inner join penghapusan_inventaris ON penghapusan.id_penghapusan=penghapusan_inventaris.id_penghapusan WHERE month(tanggal)=$bulanini and year(tanggal)=$tahunini) as total_penghapusan;")->row();
      return $data;
    }
}
?>