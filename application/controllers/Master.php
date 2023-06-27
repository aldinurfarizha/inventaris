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
	public function kantor()
	{
        $data['title']="Master Kantor";
		$data['data']=$this->Global_model->get_all('office')->result();
		$this->load->view('master/kantor',$data);
	}
	public function sub_kantor()
	{
        $data['title']="Sub Kantor";
		$param=array(
			'deleted'=>0
		);
		$data['data']=$this->Global_model->get_by_id('sub_office',$param)->result();
		$this->load->view('master/sub_kantor',$data);
	}
	public function add_sub_kantor(){
		$nama=$this->input->post('nama');
		$penanggung_jawab=$this->input->post('penanggung_jawab');
		$nik=$this->input->post('nik');
		$data=array(
			'nama'=>$nama,
			'kepala'=>$penanggung_jawab,
			'nik'=>$nik,
		);
		$this->Global_model->insert('sub_office',$data);
			return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
	}
	public function add_kantor(){
		$nama=$this->input->post('nama');
		$data=array(
			'nama'=>$nama
		);
		$this->Global_model->insert('office',$data);
			return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
	}
	
	public function add_barang(){
		$kd_barang=$this->input->post('kd_barang');
		$kd_kategori=$this->input->post('kd_kategori');
		$nama_barang=$this->input->post('nama_barang');
		$data=array(
			'kd_barang'=>$kd_kategori.'.'.$kd_barang,
			'kd_sub_barang'=>$kd_barang,
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
	public function edit_barang(){
		$kd_barang=$this->input->post('kd_barang_edit');
		$kd_kategori=$this->input->post('kd_kategori_edit');
		$nama_barang=$this->input->post('nama_barang_edit');
		$id=$this->input->post('id');
		$data=array(
			'kd_barang'=>$kd_kategori.'.'.$kd_barang,
			'kd_sub_barang'=>$kd_barang,
			'kd_kategori'=>$kd_kategori,
			'nama_barang'=>$nama_barang
		);
		$where=array(
			'id'=>$id
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
                    'messages' => 'Edit Gagal'
            )));
		}
		

	}
	public function edit_kantor(){
		$id=$this->input->post('id');
		$nama=$this->input->post('nama_kantor_edit');
		$kepala=$this->input->post('kepala_edit');
		$nik=$this->input->post('nik_edit');

		$data=array(
			'nama'=>$nama,
			'kepala'=>$kepala,
			'nik'=>$nik,
		);
		$where=array(
			'of_id'=>$id
		);
		$this->Global_model->update('office',$where,$data);
	}
	public function edit_sub_kantor(){
		$id=$this->input->post('id');
		$nama=$this->input->post('nama_kantor_edit');
		$penanggung_jawab=$this->input->post('penanggung_jawab_edit');
		$nik=$this->input->post('nik_edit');

		$data=array(
			'nama'=>$nama,
			'kepala'=>$penanggung_jawab,
			'nik'=>$nik,
		);
		$where=array(
			'sub_id'=>$id
		);
		$this->Global_model->update('sub_office',$where,$data);
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
	public function delete_kantor(){
		$id=$this->input->post('id');
		$where=array(
			'of_id'=>$id
		);
		if($this->Global_model->delete('office', $where)){
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
		public function delete_sub_kantor(){
		$id=$this->input->post('id');
		$where=array(
			'sub_id'=>$id
		);
		$data=array(
			'deleted'=>1
		);
		if($this->Global_model->update('sub_office', $where, $data)){
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

