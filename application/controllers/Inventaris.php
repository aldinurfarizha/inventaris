<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends CI_Controller {
	public function index()
	{
		$data['title']="Daftar Inventaris";
		$param=array(
			'deleted'=>0
		);
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$this->load->view('inventaris/index',$data);
	}
}
