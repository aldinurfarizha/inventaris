<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lihat extends CI_Controller {
	public function index($id)
	{
		$this->load->view('dashboard');
	}
}
