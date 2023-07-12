<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {
	public function index()
	{
		$search_param=array();
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$data['title']="Cetak Label";
		$this->load->view('cetak/index',$data);
	}
	public function multi_label(){
		$item=$this->input->post('item');
		if(sizeof($item)!=0){
			$data['data']=$item;
			$this->load->view('cetak/multi_label',$data);
			return;
		}
		echo "<script>alert('GAGAL. Pilih Minimal 1 barang untuk di cetak labelna !'); close();</script>";
	}
	public function berita_acara($berita_acara_id){
		$param=array(
			'id'=>$berita_acara_id
		);
		$param_barang=array(
			'id_berita_acara'=>$berita_acara_id
		);
		$data['berita_acara']=$this->Global_model->get_by_id('berita_acara',$param)->row();
		$data['berita_acara_barang']=$this->Global_model->getBarangBA($berita_acara_id)->result();
		$this->load->view('cetak/berita_acara',$data);
	}
	public function single_label($id){
		$data['id']=$id;
		$this->load->view('cetak/single_label',$data);
	}
	public function mutasi($id_mutasi){
		$param=array(
			'id_mutasi'=>$id_mutasi
		);
		$data['mutasi']=$this->Global_model->get_by_id('mutasi',$param)->row();
		$data['mutasi_inventaris']=$this->Global_model->getInventarisMutasi($id_mutasi)->result();
		$this->load->view('cetak/mutasi',$data);
	}

}
