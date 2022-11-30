<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function profil()
	{
		$data['title']="Profil Perusahaan";
        $param=array(
            'id'=>1
        );
        $data['data']=$this->Global_model->get_by_id('profile_perusahaan',$param)->row();
		$this->load->view('setting/profil',$data);
	}
	public function user(){
		$data['title']="User Pengguna";
        $data['data']=$this->Global_model->get_all('user')->result();
		$this->load->view('setting/user',$data);
	}
	public function add_user(){
		$nama=$this->input->post('nama');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$data=array(
			'nama'=>$nama,
			'username'=>$username,
			'password'=>$password
		);
		$this->Global_model->insert('user',$data);
			return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
	}
	public function edit_user(){
		$id=$this->input->post('id');
		$username=$this->input->post('username_edit');
		$nama=$this->input->post('nama_edit');
		$password=$this->input->post('password_edit');
		$data=array(
			'username'=>$username,
			'password'=>$password,
			'nama'=>$nama,
		);
		$where=array(
			'id_user'=>$id
		);
		if($this->Global_model->update('user', $where, $data)){
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
	public function update_profil(){
		$id=1;
		$judul1=$this->input->post('judul1');
		$judul2=$this->input->post('judul2');
		$judul3=$this->input->post('judul3');
		$logo=$this->input->post('logo');
		$kota=$this->input->post('kota');
		$direktur=$this->input->post('direktur');
		$kadiv_umum=$this->input->post('kadiv_umum');
		$kasub_logistik=$this->input->post('kasub_logistik');
		$nik_dirut=$this->input->post('nik_dirut');
		$nik_kadiv=$this->input->post('nik_kadiv');
		$nik_subdiv=$this->input->post('nik_subdiv');
		$data=array(
			'judul1'=>$judul1,
			'judul2'=>$judul2,
			'judul3'=>$judul3,
			'logo'=>$logo,
			'kota'=>$kota,
			'direktur'=>$direktur,
			'kadiv_umum'=>$kadiv_umum,
			'kasub_logistik'=>$kasub_logistik,
			'nik_dirut'=>$nik_dirut,
			'nik_kadiv'=>$nik_kadiv,
			'nik_subdiv'=>$nik_subdiv,
		);
		$where=array(
			'id'=>$id
		);
		if($this->Global_model->update('profile_perusahaan', $where, $data)){
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
                    'messages' => 'Update Gagal'
            )));
		}
	}
	public function delete_user(){
		$id=$this->input->post('id');
		$where=array(
			'id_user'=>$id
		);
		if($this->Global_model->delete('user', $where)){
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
