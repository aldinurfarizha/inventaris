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
	public function print(){
		$item=$this->input->post('item');
		if(sizeof($item)!=0){
			$data['data']=$item;
			$this->load->view('cetak/print',$data);
			return;
		}
		echo "<script>alert('GAGAL. Pilih Minimal 1 barang untuk di cetak labelna !'); close();</script>";
	}

}
