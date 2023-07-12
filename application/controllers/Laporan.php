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
	public function mutasi(){
		$data['data']=$this->Global_model->get_all('mutasi')->result();
		$this->load->view('laporan/mutasi',$data);
	}
	public function tambah_berita_acara(){
		$search_param=array();
		$data['info_perusahaan']=infoPerusahaan();
		$data['title']="Buat Berita Acara Baru";
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$this->load->view('laporan/tambah_ba',$data);
	}
	public function insert_ba(){
		$nomor=$this->input->post('nomor');
		$tanggal=$this->input->post('tanggal');
		$kadiv_umum=$this->input->post('kadiv_umum');
		$nik_kadiv=$this->input->post('nik_kadiv');
		$pihak_kedua=$this->input->post('pihak_kedua');
		$nik_kedua=$this->input->post('nik_kedua');
		$kasub_rt=$this->input->post('kasub_rt');
		$nik_rt=$this->input->post('nik_rt');
		$item=$this->input->post('item');
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');

		if($of_id==''){
			echo "<script>alert('GAGAL. Kantor Belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($of_id==1 && $sub_id==''){
			echo "<script>alert('GAGAL. SUB Kantor Belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if(sizeof($item)==0){
			echo "<script>alert('GAGAL. Pilih Minimal 1 barang untuk di cetak labelna !'); window.history.go(-1);</script>";
			return;
		}
		$berita_acara=array(
			'nomor'=>$nomor,
			'sub_div_rt_nama'=>$kasub_rt,
			'sub_div_rt_nik'=>$nik_rt,
			'pihak_kedua_nama'=>$pihak_kedua,
			'pihak_kedua_nik'=>$nik_kedua,
			'kadiv_umum_nama'=>$kadiv_umum,
			'kadiv_umum_nik'=>$nik_kadiv,
			'tanggal'=>$tanggal,
			'sub_office'=>$sub_id,
			'of_id'=>$of_id
		);
		$berita_acara_id=$this->Global_model->createBA($berita_acara,$item);
		if(!$berita_acara_id){
			echo "<script>alert('GAGAL. kesalahan sistem.'); window.history.go(-1);</script>";
			return;
		}
		$this->session->set_flashdata('status', 'success');
		redirect('laporan/detail_ba/'.$berita_acara_id);
		
		
	}
	public function detail_ba($berita_acara_id){
		$param=array(
			'id'=>$berita_acara_id
		);
		$param_inventaris=array(
			'id_berita_acara'=>$berita_acara_id
		);
		$data['berita_acara']=$this->Global_model->get_by_id('berita_acara',$param)->row();
		$data['berita_acara_barang']=$this->Global_model->getBarangBA($berita_acara_id)->result();
		$this->load->view('laporan/detail_ba',$data);
	}
	public function detail_mutasi($id_mutasi){
		$param=array(
			'id_mutasi'=>$id_mutasi
		);
		$data['mutasi']=$this->Global_model->get_by_id('mutasi',$param)->row();
		$data['mutasi_inventaris']=$this->Global_model->getInventarisMutasi($id_mutasi)->result();
		$this->load->view('laporan/detail_mutasi',$data);
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
	public function delete_ba(){
		$id=$this->input->post('id');
		$where_ba=array(
			'id'=>$id
		);
		$where_ba_inv=array(
			'id_berita_acara'=>$id
		);
		$this->Global_model->delete('berita_acara',$where_ba);
		$this->Global_model->delete('berita_acara_inventaris',$where_ba_inv);
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
		}
}
