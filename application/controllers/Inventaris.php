<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends CI_Controller {
	public function pilih_kantor()
	{
		$data['title']="Pilih Kantor";
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$this->load->view('inventaris/pilih',$data);
	}
	public function penghapusan(){
		$search_param=array();
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$data['title']="Penghapusan Aset";
		$this->load->view('inventaris/penghapusan',$data);
	}
	public function tambah(){
		$data['title']="Tambah Inventaris";
		$param=array(
			'deleted'=>0
		);
		$data['barang']=$this->Global_model->master_barang()->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$this->load->view('inventaris/tambah',$data);
	}
	public function mutasi(){
		$param=array(
			'inventaris.status'=>1
		);
		$data['inventaris']=$this->Global_model->inventaris($param)->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$this->load->view('inventaris/mutasi',$data);
	}
	public function load_inventaris(){
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		if($of_id==1){
			$search_param=array(
			'inventaris.of_id'=>$of_id,
			'inventaris.sub_id'=>$sub_id
		);
		}else{
			$search_param=array(
			'inventaris.of_id'=>$of_id
		);
		}
		$data=$this->Global_model->inventaris($search_param)->result();
		return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => true,
							'messages' => 'Success!',
							'data'=>$data
					)));
	}
	public function get_employee(){
		$where=array();
		$off_id=$this->input->post('off_id');
		if($off_id){
			$where['employee.off_id']=$off_id;
		}
		$dept_id=$this->input->post('dept_id');
		if($dept_id){
			$where['employee.dept_id']=$dept_id;
		}
		$subdept_id=$this->input->post('subdept_id');
		if($subdept_id){
			$where['employee.subdept_id']=$subdept_id;
		}
		$occ_id=$this->input->post('occ_id');
		if($occ_id){
			$where['employee.occ_id']=$occ_id;
		}
		$where['ishapus']=0;
		$where['ispensiun']=null;
		$data=getEmployeeSimpeg($where)->result();
		return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => true,
							'messages' => 'Success!',
							'data'=>$data
					)));
	}
	public function get_ruangan_kir(){
		$of_id=$this->input->post('of_id');
		if($of_id==1){
			$of_id=$this->input->post('sub_id');
		}else{
			$sub_id=0;
		}
		
		$data=getRuanganKirByofidandsubid($of_id,$sub_id)->result();
		if(sizeof($data)==0){
			return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
							'status' => true,
							'messages' => 'Tidak ada ruang kir pada kantor tersebut,silahkan tambahkan pada menu master ruangan kir',
					)));
		}
		return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => true,
							'messages' => 'Success!',
							'data'=>$data
					)));
	}
	public function result($of_id){

		$data['title']="Daftar Inventaris Kantor ".of_name($of_id);
		$param=array(
			'deleted'=>0
		);
		$search_param=array(
			'inventaris.of_id'=>$of_id
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
		$data['id']=$id;
		$data['data']=$this->Global_model->get_detail_inventaris($id)->row();
		$data['barang']=$this->Global_model->master_barang()->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['history']=$this->Global_model->get_history($id)->result();
		$this->load->view('inventaris/detail',$data);
	}
	public function insert_mutasi(){
		$of_id_penyerah=$this->input->post('of_id_penyerah');
		$sub_id_penyerah=$this->input->post('sub_id_penyerah');
		$of_id_penerima=$this->input->post('of_id_penerima');
		$sub_id_penerima=$this->input->post('sub_id_penerima');
		$nomor=$this->input->post('nomor');
		$tanggal=$this->input->post('tanggal');
		$id_penyerah=$this->input->post('id_penyerah');
		$id_penerima=$this->input->post('id_penerima');
		$id_kadiv_umum=$this->input->post('id_kadiv_umum');
		$item=$this->input->post('item');
		if($of_id_penyerah==''){
			echo "<script>alert('GAGAL. Kantor Asal Barang belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($of_id_penyerah==1 && $sub_id_penyerah==''){
			echo "<script>alert('GAGAL. SUB Kantor asal barang Belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($of_id_penerima==''){
			echo "<script>alert('GAGAL. Kantor Penerima Barang belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($of_id_penerima==1 && $sub_id_penerima==''){
			echo "<script>alert('GAGAL. SUB Kantor penerima barang Belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($id_penyerah==''){
			echo "<script>alert('GAGAL. Yang Menyerahkan Barang belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($id_penerima==''){
			echo "<script>alert('GAGAL. Yang Menerima Barang belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($of_id_penyerah==$of_id_penerima){
			if($sub_id_penerima==$sub_id_penyerah){
			echo "<script>alert('GAGAL. Asal Barang dan Tujuan merupakan kantor yang sama !'); window.history.go(-1);</script>";
			return;
			}
		}
		if(sizeof($item)==0){
			echo "<script>alert('GAGAL. Pilih Minimal 1 barang untuk di mutasikan !'); window.history.go(-1);</script>";
			return;
		}

		//fill penerima
		$penerima_detail=getEmployeeSimpeg(['pgw_id'=>$id_penerima])->row();
		$nama_penerima=$penerima_detail->nama;
		$nik_penerima=$penerima_detail->nik;
		if($of_id_penerima==1){
			$jabatan_penerima=$penerima_detail->jabatan.' '.$penerima_detail->sub_dep;
		}else{
			$jabatan_penerima=$penerima_detail->jabatan.' '.$penerima_detail->office;
		}

		//fill penyerah
		$penyerah_detail=getEmployeeSimpeg(['pgw_id'=>$id_penyerah])->row();
		$nama_penyerah=$penyerah_detail->nama;
		$nik_penyerah=$penyerah_detail->nik;
		if($of_id_penyerah==1){
			$jabatan_penyerah=$penyerah_detail->jabatan.' '.$penyerah_detail->sub_dep;
		}else{
			$jabatan_penyerah=$penyerah_detail->jabatan.' '.$penyerah_detail->office;
		}
		//fill kadiv umum
		$kadiv_umum_detail=getEmployeeSimpeg(['pgw_id'=>$id_kadiv_umum])->row();
		$nama_kadiv_umum=$kadiv_umum_detail->nama;
		$nik_kadiv_umum=$kadiv_umum_detail->nik;

		//fill asal kantor
		if($of_id_penyerah==1){
			$asal_kantor=detailSubOffice($sub_id_penyerah)->alias;
		}else{
			$asal_kantor=detailOfid($of_id_penyerah)->nama;
		}

		if($of_id_penyerah==1){
			$sub_id_penyerah=0;
		}
		if($of_id_penerima==1){
			$sub_id_penerima=0;
		}
		$data=array(
			'nomor'=>$nomor,
			'asal_kantor'=>$asal_kantor,
			'nama_penerima'=>$nama_penerima,
			'nik_penerima'=>$nik_penerima,
			'jabatan_penerima'=>$jabatan_penerima,
			'nama_penyerah'=>$nama_penyerah,
			'nik_penyerah'=>$nik_penyerah,
			'jabatan_penyerah'=>$jabatan_penyerah,
			'nama_kadiv_umum'=>$nama_kadiv_umum,
			'nik_kadiv_umum'=>$nik_kadiv_umum,
			'of_id_penyerah'=>$of_id_penyerah,
			'sub_id_penyerah'=>$sub_id_penyerah,
			'of_id_penerima'=>$of_id_penerima,
			'sub_id_penerima'=>$sub_id_penerima,
			'tanggal'=>$tanggal
		);
		$mutasi_id=$this->Global_model->createMutasi($data,$item);
		if(!$mutasi_id){
			echo "<script>alert('GAGAL. kesalahan sistem.'); window.history.go(-1);</script>";
			return;
		}
		$this->session->set_flashdata('status', 'success');
		redirect('laporan/detail_mutasi/'.$mutasi_id);
	}
	public function sukses($id){
		$data['title']="Sukses Tambah Inventaris";
		$param=array(
			'deleted'=>0
		);
		$data['id']=$id;
		$data['data']=$this->Global_model->get_detail_inventaris($id)->row();
		$data['barang']=$this->Global_model->get_by_id('master_barang',$param)->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['history']=$this->Global_model->get_history($id)->result();
		$this->load->view('inventaris/sukses',$data);
	}
	public function update_inventaris(){
		date_default_timezone_set('Asia/Jakarta');
		$id_inventaris=$this->input->post('id_inventaris');
		$sub_id=$this->input->post('sub_id');
		$of_id=$this->input->post('of_id');
		$id_barang=$this->input->post('id_barang');
		$admin=$this->input->post('admin');
		$y=$this->input->post('y');
		$m=$this->input->post('m');
		$d=$this->input->post('d');
		$harga=$this->input->post('harga');
		$status=$this->input->post('status');
		$now = date('Y-m-d H:i:s');
		$data=array(
			'of_id'=>$of_id,
			'id_barang'=>$id_barang,
			'admin'=>$admin,
			'sub_id'=>$sub_id,
			'y'=>$y,
			'm'=>$m,
			'd'=>$d,
			'harga'=>str_replace(".","",$harga),
			'status'=>$status,
			'last_update'=> $now
		);
		$where=array(
			'id_inventaris'=>$id_inventaris
		);
		$this->Global_model->update('inventaris',$where, $data);
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
		$id_inventaris=$this->input->post('id_inventaris');
		$foto_barang=$this->Global_model->get_detail_inventaris($id_inventaris)->row()->foto_barang;
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
					'id_inventaris'=>$id_inventaris,
				);
				if ($foto_name && file_exists(TEMP_PATH . $foto_name)) {
					unlink(TEMP_PATH . $foto_name);
				}
				if($foto_barang_exists){
					unlink(FOTO_BARANG_PATH . $foto_barang);
				}
				$this->Global_model->update('inventaris',$where, $data);
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
	public function do_penghapusan(){
		$item=$this->input->post('item');
		if(sizeof($item)==0){
				echo "<script>alert('GAGAL. Pilih Minimal 1 barang untuk di proses penghapusan aset !'); close();</script>";
			return;
		}
		$alasan=$this->input->post('alasan');
		$id_kadiv_umum=$this->input->post('id_kadiv_umum');
		$id_kasub_aset=$this->input->post('id_kasub_aset');
		$id_kadiv_spi=$this->input->post('id_kadiv_spi');
		$nomor=$this->input->post('nomor');
		//fill kadiv_umum
		$kadiv_umum_detail=getEmployeeSimpeg(['pgw_id'=>$id_kadiv_umum])->row();
		$nama_kadiv_umum=$kadiv_umum_detail->nama;
		$nik_kadiv_umum=$kadiv_umum_detail->nik;

		//fill kasub aset
		$kasub_aset_detail=getEmployeeSimpeg(['pgw_id'=>$id_kasub_aset])->row();
		$nama_kasub_aset=$kasub_aset_detail->nama;
		$nik_kasub_aset=$kasub_aset_detail->nik;

		//fill kadiv SPI
		$kadiv_spi_detail=getEmployeeSimpeg(['pgw_id'=>$id_kadiv_spi])->row();
		$nama_kadiv_spi=$kadiv_spi_detail->nama;
		$nik_kadiv_spi=$kadiv_spi_detail->nik;

		//fill Direktur
		$nama_direktur=infoPerusahaan()->direktur;
		$nik_direktur=infoPerusahaan()->nik_dirut;

		$data=array(
			'nomor'=>$nomor,
			'alasan'=>$alasan,
			'nama_kadiv_umum'=>$nama_kadiv_umum,
			'nik_kadiv_umum'=>$nik_kadiv_umum,
			'nama_kasub_aset'=>$nama_kasub_aset,
			'nik_kasub_aset'=>$nik_kasub_aset,
			'nama_kadiv_spi'=>$nama_kadiv_spi,
			'nik_kadiv_spi'=>$nik_kadiv_spi,
			'nama_direktur'=>$nama_direktur,
			'nik_direktur'=>$nik_direktur,
			'tanggal'=>date('Y-m-d')
		);
		$penghapusan_id=$this->Global_model->createPenghapusan($data,$item);
		if(!$penghapusan_id){
			echo "<script>alert('GAGAL. kesalahan sistem.'); window.history.go(-1);</script>";
			return;
		}
		$this->session->set_flashdata('status', 'success');
		redirect('laporan/detail_penghapusan/'.$penghapusan_id);
	}
	public function add(){
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$id_barang=$this->input->post('id_barang');
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		$d=$this->input->post('d');
		$m=$this->input->post('m');
		$y=$this->input->post('y');
		$harga=$this->input->post('harga');
		$keterangan=$this->input->post('keterangan');
		$admin=$this->input->post('admin');
		$status=$this->input->post('status');
		$id_ruangan_kir=$this->input->post('id_ruangan_kir');
		if($of_id==1){
			$sub_id=0;
		}
		$data=array(
			'id_barang'=>$id_barang,
			'of_id'=>$of_id,
			'sub_id'=>$sub_id,
			'd'=>$d,
			'm'=>$m,
			'y'=>$y,
			'harga'=>str_replace(".","",$harga),
			'keterangan'=>$keterangan,
			'admin'=>$admin,
			'status'=>$status,
			'id_ruangan_kir'=>$id_ruangan_kir,
			'last_update'=>$now
		);
		if($this->Global_model->insert('inventaris',$data)){
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
