<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	public function perkiraan()
	{
        $data['title']="Master Perkiraan";
		$param=array(
			'deleted'=>0
		);
		$data['kategori']=$this->Global_model->get_all('master_perkiraan_dasar')->result();
		$data['data']=$this->Global_model->master_perkiraan()->result();
		$this->load->view('master/perkiraan',$data);
	}
	public function barang()
	{
        $data['title']="Master Barang";
		$param=array(
			'deleted'=>0
		);
		$data['kategori']=$this->Global_model->get_all('master_perkiraan')->result();
		$data['data']=$this->Global_model->master_barang()->result();
		$this->load->view('master/barang',$data);
	}
	public function v_edit_barang($id_barang){
		$data['title']="Edit Master Barang";
		$data['data']=$this->Global_model->master_barang_detail($id_barang)->row();
		$this->load->view('master/edit_barang',$data);
	}
	public function kantor()
	{
        $data['title']="Master Kantor";
		$data['data']=$this->Global_model->get_all('office')->result();
		$this->load->view('master/kantor',$data);
	}
	public function ruangan_kir(){
		$data['title']="Master Ruangan KIR";
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$this->load->view('master/ruangan_kir',$data);
	}
	public function ruangan_kir_detail($of_id,$sub_id=null){
		$data['title']="Master Ruangan KIR";
		$data['of_id']=$of_id;
		$data['sub_id']=$sub_id;
		$data['data']=getRuanganKIR($of_id,$sub_id);
		$this->load->view('master/ruangan_kir_detail',$data);
	}
	public function ruangan_kir_pusat(){
		$data['title']="Master Ruangan KIR Pusat";
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$this->load->view('master/ruangan_kir_pusat',$data);
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
	public function add_ruangan_kir(){
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		$nama_ruangan=$this->input->post('nama_ruangan');
		$data=array(
			'of_id'=>$of_id,
			'sub_id'=>$sub_id,
			'nama_ruangan'=>$nama_ruangan
		);
		$this->Global_model->insert('master_ruangan_kir',$data);
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
	public function edit_barang(){
		$id_barang=$this->input->post('id_barang');
		$id_perkiraan=$this->input->post('id_perkiraan');
		$merk=$this->input->post('merk');
		$tipe=$this->input->post('tipe');
		$spek=$this->input->post('spek');
		$satuan=$this->input->post('satuan');
		$where=array(
			'id_barang'=>$id_barang
		);
		$data=array(
			'id_perkiraan'=>$id_perkiraan,
			'merk'=>$merk,
			'tipe'=>$tipe,
			'spek'=>$spek,
			'satuan'=>$satuan,
		);
		$this->Global_model->update('master_barang',$where,$data);
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
	}
	
	public function add_perkiraan(){
		$kd_sub_perkiraan=$this->input->post('kd_sub_perkiraan');
		$kd_perkiraan_dasar=$this->input->post('kd_perkiraan_dasar');
		$nama_perkiraan=$this->input->post('nama_perkiraan');
		$data=array(
			'kd_perkiraan'=>$kd_perkiraan_dasar.'.'.$kd_sub_perkiraan,
			'kd_sub_perkiraan'=>$kd_sub_perkiraan,
			'kd_perkiraan_dasar'=>$kd_perkiraan_dasar,
			'nama_perkiraan'=>$nama_perkiraan
		);
		
		if($this->Global_model->is_kode_perkiraan_available($data['kd_perkiraan'])){
			$this->Global_model->insert('master_perkiraan',$data);
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
                    'messages' => 'Kode Perkiraan ini sudah di pakai,Gunakan Kode perkiraan lain !'
            )));
		}
	}
	public function add_barang(){
		$id_perkiraan=$this->input->post('id_perkiraan');
		$merk=$this->input->post('merk');
		$spek=$this->input->post('spek');
		$satuan=$this->input->post('satuan');
		$tipe=$this->input->post('tipe');
		$data=array(
			'id_perkiraan'=>$id_perkiraan,
			'merk'=>$merk,
			'spek'=>$spek,
			'satuan'=>$satuan,
			'tipe'=>$tipe,
			'deleted'=>0
		);
		$this->Global_model->insert('master_barang',$data);
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
	}
	
	public function edit_perkiraan(){
		$kd_sub_perkiraan=$this->input->post('kd_sub_perkiraan');
		$kd_perkiraan_dasar=$this->input->post('kd_perkiraan_dasar');
		$nama_perkiraan=$this->input->post('nama_perkiraan');
		$id=$this->input->post('id');
		$data=array(
			'kd_perkiraan'=>$kd_perkiraan_dasar.'.'.$kd_sub_perkiraan,
			'kd_sub_perkiraan'=>$kd_sub_perkiraan,
			'kd_perkiraan_dasar'=>$kd_perkiraan_dasar,
			'nama_perkiraan'=>$nama_perkiraan
		);
		$where=array(
			'id_perkiraan'=>$id
		);
		if($this->Global_model->update('master_perkiraan', $where, $data)){
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
	public function delete_perkiraan(){
		$id=$this->input->post('id');
		$where=array(
			'id_perkiraan'=>$id
		);
		$data=array(
			'deleted'=>1
		);
		if($this->Global_model->update('master_perkiraan', $where, $data)){
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
		public function delete_barang(){
		$id=$this->input->post('id');
		$where=array(
			'id_barang'=>$id
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
		public function delete_ruangan_kir(){
		$id_ruangan_kir=$this->input->post('id_ruangan_kir');
		$where=array(
			'id_ruangan_kir'=>$id_ruangan_kir
		);
		$data=array(
			'is_deleted'=>1
		);
		if($this->Global_model->update('master_ruangan_kir', $where,$data)){
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
		public function edit_ruangan_kir(){
		$id_ruangan_kir=$this->input->post('id_ruangan_kir');
		$nama_ruangan=$this->input->post('nama_ruangan_edit');
		$where=array(
			'id_ruangan_kir'=>$id_ruangan_kir
		);
		$data=array(
			'nama_ruangan'=>$nama_ruangan
		);
		if($this->Global_model->update('master_ruangan_kir', $where,$data)){
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

