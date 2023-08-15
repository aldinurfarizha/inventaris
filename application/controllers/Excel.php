<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {
	public function barang(){
		$id_barang=$this->input->post('id_barang');
		$status=$this->input->post('status');
		$y=$this->input->post('y');
		$m=$this->input->post('m');
		$d=$this->input->post('d');
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		$id_ruangan_kir=$this->input->post('id_ruangan_kir');
		$param=array();
		if($id_barang){
			$param['inventaris.id_barang']=$id_barang;
		}
		if($y){
			$param['y']=$y;
		}
		if($m){
			$param['m']=$m;
		}
		if($d){
			$param['d']=$d;
		}
		if($of_id){
			$param['inventaris.of_id']=$of_id;
		}
		if($sub_id){
			$param['inventaris.sub_id']=$sub_id;
		}
		if($id_ruangan_kir){
			$param['inventaris.id_ruangan_kir']=$id_ruangan_kir;
		}
		if($status){
			$param['inventaris.status']=$status;
		}
		$data['data']=$this->Global_model->inventaris($param)->result();
		$this->load->view('excel/barang',$data);
	}

}
