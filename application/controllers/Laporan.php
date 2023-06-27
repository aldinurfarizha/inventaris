<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function index()
	{
		$search_param=array();
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$data['title']="Cetak Label";
		$this->load->view('cetak/index',$data);
	}
	public function berita_acara(){
		$data['data']=$this->Global_model->get_all('berita_acara')->result();
		$this->load->view('laporan/ba',$data);
	}
	public function tambah_berita_acara(){
		$data['info_perusahaan']=infoPerusahaan();
		$data['title']="Buat Berita Acara Baru";
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$this->load->view('laporan/tambah_ba',$data);
	}
	public function get_pihak_kedua(){
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		if($of_id==1){
			$data=infoPusat($sub_id);
		}else{
			$data=infoCabang($of_id);
		}
		return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($data
				));
	}
}
