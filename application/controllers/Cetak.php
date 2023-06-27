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
	public function prints(){
		$item=$this->input->post('item');
		if(sizeof($item)!=0){
			$data['data']=$item;
			$this->load->view('cetak/print',$data);
			return;
		}
		echo "<script>alert('GAGAL. Pilih Minimal 1 barang untuk di cetak labelna !'); close();</script>";
	}
	public function single_ba($id){
		$data['id']=$id;
		$this->load->view('cetak/single_ba',$data);
	}
	public function single_label($id){
		$data['id']=$id;
		$this->load->view('cetak/single_label',$data);
	}

}
