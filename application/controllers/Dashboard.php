<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		$data['title']="Dashboard";
		$param=array(
			'y>'=>2018
		);
		$data['total_data_inventaris']=$this->db->query("SELECT count(id_barang)as total FROM barang")->row()->total;
		$data['inventaris_aktif']=$this->db->query("SELECT count(id_barang)as total FROM barang where status=1")->row()->total;
		$data['inventaris_tidak_aktif']=$this->db->query("SELECT count(id_barang)as total FROM barang where status=0")->row()->total;
		$data['master_barang']=$this->db->query("SELECT count(id)as total FROM master_barang where deleted=0")->row()->total;
		$data['elektronik']=$this->db->query("SELECT count(id)as total FROM barang inner join master_barang on barang.master_barang_id = master_barang.id where master_barang.kd_kategori='31.09.20'")->row()->total;
		$data['meubelair']=$this->db->query("SELECT count(id)as total FROM barang inner join master_barang on barang.master_barang_id = master_barang.id where master_barang.kd_kategori='31.09.10'")->row()->total;
		$data['limatahun']=$this->Global_model->inventaris($param)->result();
		$this->load->view('dashboard',$data);
	}
}
