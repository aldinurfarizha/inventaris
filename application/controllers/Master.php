<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	public function barang()
	{
        $data['title']="Master Barang";
		$param=array(
			'deleted'=>0
		);
		$data['kategori']=$this->Global_model->get_all('kategori_barang')->result();
		$data['data']=$this->Global_model->master_barang()->result();
		$this->load->view('master/barang',$data);
	}
	public function add_barang(){
		$kd_barang=$this->input->post('kd_barang');
		$kd_kategori=$this->input->post('kd_kategori');
		$nama_barang=$this->input->post('nama_barang');
		$data=array(
			'kd_barang'=>$kd_kategori.'.'.$kd_barang,
			'kd_kategori'=>$kd_kategori,
			'nama_barang'=>$nama_barang
		);
		
		if($this->Global_model->is_kode_barang_available($data['kd_barang'])){
			$this->Global_model->insert('master_barang',$data);
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
                    'status' => False,
                    'messages' => 'Kode Barang tidak boleh sama dengan yang sudah ada!'
            )));
		}
	}
	public function delete_barang(){
		$id=$this->input->post('id');
		$where=array(
			'id'=>$id
		);
		$data=array(
			'deleted'=>1
		);
		if($this->Global_model->update('master_barang', $where, $data)){
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
                    'status' => False,
                    'messages' => 'Hapus Gagal'
            )));
		}
		}
	}

