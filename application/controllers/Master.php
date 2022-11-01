<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	public function barang()
	{
        $data['title']="Master Barang";
		$this->load->view('master/barang',$data);
	}
}
