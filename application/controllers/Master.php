<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	public function barang()
	{
        $data['title']="Master Barang";
		$data['kategori']=$this->Global_model->get_all('kategori_barang')->result();
		$data['data']=$this->Global_model->get_all('master_barang')->result();
		$this->load->view('master/barang',$data);
	}
}
