<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends CI_Controller {
	public function index()
	{
		$data['title']="Daftar Inventaris";
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$this->load->view('inventaris/pilih',$data);
	}
	public function tambah(){
		$data['title']="Tambah Inventaris";
		$param=array(
			'deleted'=>0
		);
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$this->load->view('inventaris/tambah',$data);
	}
	public function dulu(){
		$data['title']="Daftar Inventaris";
		$param=array(
			'deleted'=>0
		);
		$search_param=array();
		if($master_barang_id=$this->input->get('master_barang_id')){
			$search_param['master_barang_id']=$master_barang_id;
		}
		
		if($y=$this->input->get('y')){
			$search_param['y']=$y;
		}
		if($m=$this->input->get('m')){
			$search_param['m']=$m;
		}
		if($d=$this->input->get('d')){
			$search_param['d']=$d;
		}
		if($of_id=$this->input->get('of_id')){
			$search_param['barang.of_id']=$of_id;
		}
		if($sub_id=$this->input->get('sub_id')){
			$search_param['barang.sub_id']=$sub_id;
		}
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$this->load->view('inventaris/index',$data);
	}
	public function result($of_id){

		$data['title']="Daftar Inventaris Kantor ".of_name($of_id);
		$param=array(
			'deleted'=>0
		);
		$search_param=array(
			'barang.of_id'=>$of_id
		);
		
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['of_id']=$of_id;
		$this->load->view('inventaris/index',$data);
	}
	public function detail($id){
		$param=array(
			'deleted'=>0
		);
		$data['data']=$this->Global_model->get_detail_barang($id)->row();
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['history']=$this->Global_model->get_history($id)->result();
		$this->load->view('inventaris/detail',$data);
	}
	public function sukses($id){
		$data['title']="Sukses Tambah Inventaris";
		$param=array(
			'deleted'=>0
		);
		$data['id']=$id;
		$data['data']=$this->Global_model->get_detail_barang($id)->row();
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['history']=$this->Global_model->get_history($id)->result();
		$this->load->view('inventaris/sukses',$data);
	}
	public function update_inventaris(){
		date_default_timezone_set('Asia/Jakarta');
		$id_barang=$this->input->post('id');
		$sub_id=$this->input->post('sub_id');
		$of_id=$this->input->post('of_id');
		$master_barang_id=$this->input->post('master_barang_id');
		$admin=$this->input->post('admin');
		$y=$this->input->post('y');
		$m=$this->input->post('m');
		$d=$this->input->post('d');
		$merk=$this->input->post('merk');
		$spek=$this->input->post('spek');
		$satuan=$this->input->post('satuan');
		$harga=$this->input->post('harga');
		$status=$this->input->post('status');
		$now = date('Y-m-d H:i:s');
		$data=array(
			'of_id'=>$of_id,
			'master_barang_id'=>$master_barang_id,
			'admin'=>$admin,
			'sub_id'=>$sub_id,
			'y'=>$y,
			'm'=>$m,
			'd'=>$d,
			'merk'=>$merk,
			'spek'=>$spek,
			'satuan'=>$satuan,
			'harga'=>str_replace(".","",$harga),
			'status'=>$status,
			'last_update'=> $now
		);
		$where=array(
			'id_barang'=>$id_barang
		);
		$this->Global_model->update('barang',$where, $data);
		$response=array(
			'message'=>'Success'
		);
		return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($response
				));
	}
	public function upload_foto(){
		$id=$this->input->post('id');
		$foto_barang=$this->Global_model->get_detail_barang($id)->row()->foto_barang;
		if($foto_barang==null){
			$foto_barang_exists=false;
		}else{
			$foto_barang_exists=true;
		}
			$config["upload_path"]   = TEMP_PATH;
			$config["allowed_types"] = "gif|jpg|png|jpeg";
			$config['encrypt_name'] = TRUE;
			$config['max_size'] = '10000';
			$this->load->library('image_lib');
			$conf_resize['image_library'] = 'gd2';
			$conf_resize['maintain_ratio'] = true;
			$conf_resize['width'] = 1000;
			$this->load->library('upload', $config);			
			if ( ! $this->upload->do_upload("file")) {
				$response=array(
					'message'=>"Gagal,Ukuran File terlalu besar Maksimal 10 mb"
				);
				return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode($response
				));
			}else{
				$data_file = array('upload_data' => $this->upload->data());
				$foto_name= $data_file['upload_data']['file_name'];
				$conf_resize['source_image'] = TEMP_PATH.$foto_name;
				$conf_resize['new_image'] = FOTO_BARANG_PATH.$foto_name;
				$this->image_lib->initialize($conf_resize);
				$this->image_lib->resize();
				$data=array(
					'foto_barang'=>$foto_name,
				);
				$where=array(
					'id_barang'=>$id,
				);
				if ($foto_name && file_exists(TEMP_PATH . $foto_name)) {
					unlink(TEMP_PATH . $foto_name);
				}
				if($foto_barang_exists){
					unlink(FOTO_BARANG_PATH . $foto_barang);
				}
				$this->Global_model->update('barang',$where, $data);
				$response=array(
					'filename'=>$foto_name,
					'message'=>"success"
				);
				return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($response
				));
			}
	}
	
	public function add(){
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$master_barang_id=$this->input->post('master_barang_id');
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		$d=$this->input->post('d');
		$m=$this->input->post('m');
		$y=$this->input->post('y');
		$merk=$this->input->post('merk');
		$spek=$this->input->post('spek');
		$satuan=$this->input->post('satuan');
		$harga=$this->input->post('harga');
		$keterangan=$this->input->post('keterangan');
		$admin=$this->input->post('admin');
		$status=$this->input->post('status');
		$data=array(
			'master_barang_id'=>$master_barang_id,
			'of_id'=>$of_id,
			'sub_id'=>$sub_id,
			'd'=>$d,
			'm'=>$m,
			'y'=>$y,
			'merk'=>$merk,
			'spek'=>$spek,
			'satuan'=>$satuan,
			'harga'=>str_replace(".","",$harga),
			'keterangan'=>$keterangan,
			'admin'=>$admin,
			'status'=>$status,
			'last_update'=>$now
		);
		if($this->Global_model->insert('barang',$data)){
			$this->load->library('ciqrcode');
			$id = $this->db->insert_id();
			$fill=base_url().'lihat/'.$id;
			$config['cacheable']    = true;
			$config['cachedir']     = './assets/';
			$config['errorlog']     = './assets/';
			$config['imagedir']     = '.'.QR_PATH;
			$config['quality']      = true;
			$config['size']         = '1024';
			$config['black']        = array(224,255,255);
			$config['white']        = array(70,130,180);
			$this->ciqrcode->initialize($config);
			$image_name=$id.'.png';
			$params['data'] = $fill;
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name;
			$this->ciqrcode->generate($params);
		return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => true,
							'messages' => 'Success!',
							'id'=>$id
					)));
		}else{
			return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
							'status' => false,
							'messages' => 'Gagal'
					)));
		}

					
	}
}
