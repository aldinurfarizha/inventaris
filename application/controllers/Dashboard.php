<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$data['title'] = "Dashboard";
		$param = array(
			'y<' => 2018
		);
		$data['total_data_inventaris'] = $this->db->query("SELECT count(id_inventaris)as total FROM inventaris")->row()->total;
		$data['inventaris_aktif'] = $this->db->query("SELECT count(id_inventaris)as total FROM inventaris where status=1")->row()->total;
		$data['inventaris_tidak_aktif'] = $this->db->query("SELECT count(id_inventaris)as total FROM inventaris where status=0")->row()->total;
		$data['master_barang'] = $this->db->query("SELECT count(id_barang)as total FROM master_barang where deleted=0")->row()->total;
		$data['perkiraan_dasar'] = $this->db->query("SELECT * from master_perkiraan_dasar")->result();
		$data['limatahun'] = $this->Global_model->inventaris($param)->result();
		$this->load->view('dashboard', $data);
	}
}
