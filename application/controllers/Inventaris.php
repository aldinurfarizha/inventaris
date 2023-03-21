<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends CI_Controller {
	public function index()
	{
		$data['title']="Daftar Inventaris";
		$param=array(
			'deleted'=>0
		);
		$search_param=array();
		if($master_barang_id=$this->input->get('master_barang_id')){
			$search_param['master_barang_id']=$master_barang_id;
		}
		
		if($y=$this->input->get('y')){
			$search_param['y']=$y;
		}
		if($m=$this->input->get('m')){
			$search_param['m']=$m;
		}
		if($d=$this->input->get('d')){
			$search_param['d']=$d;
		}
		if($of_id=$this->input->get('of_id')){
			$search_param['barang.of_id']=$of_id;
		}
		if($sub_id=$this->input->get('sub_id')){
			$search_param['barang.sub_id']=$sub_id;
		}
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$this->load->view('inventaris/index',$data);
	}
	public function detail($id){
		$param=array(
			'deleted'=>0
		);
		$data['data']=$this->Global_model->get_detail_barang($id)->row();
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['history']=$this->Global_model->get_history($id)->result();
		$this->load->view('inventaris/detail',$data);
	}
	public function add(){
		$master_barang_id=$this->input->post('master_barang_id');
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		$d=$this->input->post('d');
		$m=$this->input->post('m');
		$y=$this->input->post('y');
		$merk=$this->input->post('merk');
		$spek=$this->input->post('spek');
		$satuan=$this->input->post('satuan');
		$harga=$this->input->post('harga');
		$keterangan=$this->input->post('keterangan');
		$admin=$this->input->post('admin');
		$status=$this->input->post('status');
		$data=array(
			'master_barang_id'=>$master_barang_id,
			'of_id'=>$of_id,
			'sub_id'=>$sub_id,
			'd'=>$d,
			'm'=>$m,
			'y'=>$y,
			'merk'=>$merk,
			'spek'=>$spek,
			'satuan'=>$satuan,
			'harga'=>str_replace(".","",$harga),
			'keterangan'=>$keterangan,
			'admin'=>$admin,
			'status'=>$status
		);
		if($this->Global_model->insert('barang',$data)){
		return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => true,
							'messages' => 'Success!'
					)));
		}else{
			return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
							'status' => false,
							'messages' => 'Gagal'
					)));
		}

					
	}
}
