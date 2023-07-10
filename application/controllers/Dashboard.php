<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		$data['title']="Dashboard";
		$param=array(
			'y>'=>2018
		);
		$data['total_data_inventaris']=$this->db->query("SELECT count(id_inventaris)as total FROM inventaris")->row()->total;
		$data['inventaris_aktif']=$this->db->query("SELECT count(id_inventaris)as total FROM inventaris where status=1")->row()->total;
		$data['inventaris_tidak_aktif']=$this->db->query("SELECT count(id_inventaris)as total FROM inventaris where status=0")->row()->total;
		$data['master_barang']=$this->db->query("SELECT count(id_perkiraan)as total FROM master_perkiraan where deleted=0")->row()->total;
		$data['elektronik']=$this->db->query("SELECT count(id_inventaris)as total FROM inventaris inner join master_perkiraan on inventaris.id_barang = master_perkiraan.id_perkiraan where master_perkiraan.kd_perkiraan='31.09.20'")->row()->total;
		$data['meubelair']=$this->db->query("SELECT count(id_inventaris)as total FROM inventaris inner join master_perkiraan on inventaris.id_barang = master_perkiraan.id_perkiraan where master_perkiraan.kd_perkiraan='31.09.10'")->row()->total;
		$data['limatahun']=$this->Global_model->inventaris($param)->result();
		$this->load->view('dashboard',$data);
	}
}
