<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function index()
	{
		$search_param=array();
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$data['title']="Cetak Label";
		$this->load->view('cetak/index',$data);
	}
	public function berita_acara(){
		$data['data']=$this->Global_model->get_all('berita_acara')->result();
		$this->load->view('laporan/ba',$data);
	}
	public function barang(){
		$data['barang']=$this->Global_model->master_barang()->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$this->load->view('laporan/barang',$data);
	}
	public function mutasi(){
		$data['data']=$this->Global_model->get_all('mutasi')->result();
		$this->load->view('laporan/mutasi',$data);
	}
	public function penghapusan(){
		$data['data']=$this->Global_model->get_all('penghapusan')->result();
		$this->load->view('inventaris/segera',$data);
	}
	public function pengembalian(){
		$data['data']=$this->Global_model->get_all('pengembalian')->result();
		$this->load->view('laporan/pengembalian',$data);
	}
	public function kartu_inventaris(){
		$data['title']="Laporan Kartu inventaris";
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$this->load->view('laporan/kartu_inventaris',$data);
	}
	public function kartu_inventaris_pusat(){
		$data['title']="Laporan Kartu inventaris";
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$this->load->view('laporan/kartu_inventaris_pusat',$data);
	}
	public function kartu_inventaris_list($of_id,$sub_id=null){
		$data['title']="Master Ruangan KIR";
		$data['of_id']=$of_id;
		$data['sub_id']=$sub_id;
		$data['data']=getRuanganKIR($of_id,$sub_id);
		$this->load->view('laporan/kartu_inventaris_list',$data);
	}
	public function kartu_inventaris_detail($id_ruangan_kir,$of_id=null,$sub_id=null){
		$data['title']="Data KIR";
		$param=array(
			'id_ruangan_kir'=>$id_ruangan_kir
		);
		$data['id_ruangan_kir']=$id_ruangan_kir;
		$data['of_id']=$of_id;
		$data['sub_id']=$sub_id;
		$data['data']=$this->Global_model->get_by_id('kartu_inventaris',$param)->result();
		$this->load->view('laporan/kartu_inventaris_detail',$data);
	}
	public function detail_kir($id_kartu_inventaris){
		$param=array(
			'id_kartu_inventaris'=>$id_kartu_inventaris
		);
		$data['kartu_inventaris']=$this->Global_model->get_by_id('kartu_inventaris',$param)->row();
		$data['kartu_inventaris_barang']=$this->Global_model->getKIRBarang($id_kartu_inventaris)->result();
		$this->load->view('laporan/detail_kir',$data);
	}
	public function tambah_berita_acara(){
		$search_param=array();
		$data['info_perusahaan']=infoPerusahaan();
		$data['title']="Buat Berita Acara Baru";
		$data['sub_kantor']=$this->Global_model->get_all('sub_office')->result();
		$data['kantor']=$this->Global_model->get_all('office')->result();
		$data['data']=$this->Global_model->inventaris($search_param)->result();
		$this->load->view('laporan/tambah_ba',$data);
	}
	public function insert_kir(){
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		$id_ruangan_kir=$this->input->post('id_ruangan_kir');
		$id_penanggung_jawab=$this->input->post('id_penanggung_jawab');
		$id_kasub_aset=$this->input->post('id_kasub_aset');
		$id_kadiv_umum=$this->input->post('id_kadiv_umum');
		if($of_id==''){
			echo "<script>alert('GAGAL. Kantor Asal Barang belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($of_id==1 && $sub_id==''){
			echo "<script>alert('GAGAL. SUB Kantor asal barang Belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($id_penanggung_jawab==''){
			echo "<script>alert('GAGAL. Penanggung jawab belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($id_kasub_aset==''){
			echo "<script>alert('GAGAL. Kasub Aset belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($id_kadiv_umum==''){
			echo "<script>alert('GAGAL. Kadiv Umum belum di pilih !'); window.history.go(-1);</script>";
			return;
		}

		$kadiv_umum_detail=getEmployeeSimpeg(['pgw_id'=>$id_kadiv_umum])->row();
		$nama_kadiv_umum=$kadiv_umum_detail->nama;
		$nik_kadiv_umum=$kadiv_umum_detail->nik;

		$kasub_aset_detail=getEmployeeSimpeg(['pgw_id'=>$id_kasub_aset])->row();
		$nama_kasub_aset=$kasub_aset_detail->nama;
		$nik_kasub_aset=$kasub_aset_detail->nik;

		$penanggung_jawab_detail=getEmployeeSimpeg(['pgw_id'=>$id_penanggung_jawab])->row();
		$nama_penanggung_jawab=$penanggung_jawab_detail->nama;
		$nik_penanggung_jawab=$penanggung_jawab_detail->nik;
		$jabatan_penanggung_jawab=$penanggung_jawab_detail->jabatan;

		$direktur_detail=infoPerusahaan();
		$nama_direktur=$direktur_detail->direktur;
		$nik_dirut=$direktur_detail->nik_dirut;

		$data=array(
			'id_ruangan_kir'=>$id_ruangan_kir,
			'of_id'=>$of_id,
			'sub_id'=>$sub_id,
			'nama_kadiv_umum'=>$nama_kadiv_umum,
			'nik_kadiv_umum'=>$nik_kadiv_umum,
			'nama_kasub_aset'=>$nama_kasub_aset,
			'nik_kasub_aset'=>$nik_kasub_aset,
			'nama_penanggung_jawab'=>$nama_penanggung_jawab,
			'jabatan_penanggung_jawab'=>$jabatan_penanggung_jawab,
			'nik_penanggung_jawab'=>$nik_penanggung_jawab,
			'nama_direktur'=>$nama_direktur,
			'nik_direktur'=>$nik_dirut,
			'tanggal'=>date('Y-m-d')
		);
		$kartu_inventaris_id=$this->Global_model->createKIR($data);
		if(!$kartu_inventaris_id){
			echo "<script>alert('GAGAL. kesalahan sistem.'); window.history.go(-1);</script>";
			return;
		}
		$this->session->set_flashdata('status', 'success');
		redirect('laporan/detail_kir/'.$kartu_inventaris_id);
	}
	public function insert_ba(){
		$nomor=$this->input->post('nomor');
		$tanggal=$this->input->post('tanggal');
		$id_kadiv_umum=$this->input->post('id_kadiv_umum');
		$id_pihak_kedua=$this->input->post('id_pihak_kedua');
		$id_kasub_rt=$this->input->post('id_kasub_rt');
		$item=$this->input->post('item');
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');

		if($of_id==''){
			echo "<script>alert('GAGAL. Kantor Belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if($of_id==1 && $sub_id==''){
			echo "<script>alert('GAGAL. SUB Kantor Belum di pilih !'); window.history.go(-1);</script>";
			return;
		}
		if(sizeof($item)==0){
			echo "<script>alert('GAGAL. Pilih Minimal 1 barang untuk pembuatan BA !'); window.history.go(-1);</script>";
			return;
		}
		if($id_pihak_kedua==''){
			echo "<script>alert('GAGAL Pihak Kedua masih kosong. Pilih Pihak Kedua !'); window.history.go(-1);</script>";
			return;
		}
		$kadiv_umum_detail=getEmployeeSimpeg(['pgw_id'=>$id_kadiv_umum])->row();
		$nama_kadiv_umum=$kadiv_umum_detail->nama;
		$nik_kadiv_umum=$kadiv_umum_detail->nik;

		$kasub_rt_detail=getEmployeeSimpeg(['pgw_id'=>$id_kasub_rt])->row();
		$nama_kasub_rt=$kasub_rt_detail->nama;
		$nik_kasub_rt=$kasub_rt_detail->nik;

		$pihak_kedua_detail=getEmployeeSimpeg(['pgw_id'=>$id_pihak_kedua])->row();
		$nama_pihak_kedua=$pihak_kedua_detail->nama;
		$nik_pihak_kedua=$pihak_kedua_detail->nik;
		if ($pihak_kedua_detail->off_id == 1) {
			$jabatan_pihak_kedua = $pihak_kedua_detail->sub_dep . ' (' . $pihak_kedua_detail->dept . ' - ' . $pihak_kedua_detail->office . ')';
		} else {
			$jabatan_pihak_kedua = $pihak_kedua_detail->jabatan . ' - ' . $pihak_kedua_detail->dept . ' ' . $pihak_kedua_detail->office;
		}
		if($of_id==1){
			$sub_id=0;
		}
		$berita_acara=array(
			'nomor'=>$nomor,
			'sub_div_rt_nama'=>$nama_kasub_rt,
			'sub_div_rt_nik'=>$nik_kasub_rt,
			'pihak_kedua_nama'=>$nama_pihak_kedua,
			'pihak_kedua_nik'=>$nik_pihak_kedua,
			'pihak_kedua_jabatan'=>$jabatan_pihak_kedua,
			'kadiv_umum_nama'=>$nama_kadiv_umum,
			'kadiv_umum_nik'=>$nik_kadiv_umum,
			'tanggal'=>$tanggal,
			'sub_office'=>$sub_id,
			'of_id'=>$of_id
		);
		$berita_acara_id=$this->Global_model->createBA($berita_acara,$item);
		if(!$berita_acara_id){
			echo "<script>alert('GAGAL. kesalahan sistem.'); window.history.go(-1);</script>";
			return;
		}
		$this->session->set_flashdata('status', 'success');
		redirect('laporan/detail_ba/'.$berita_acara_id);
		
		
	}
	public function detail_ba($berita_acara_id){
		$param=array(
			'id'=>$berita_acara_id
		);
		$data['berita_acara']=$this->Global_model->get_by_id('berita_acara',$param)->row();
		$data['berita_acara_barang']=$this->Global_model->getBarangBA($berita_acara_id)->result();
		$this->load->view('laporan/detail_ba',$data);
	}
	public function detail_mutasi($id_mutasi){
		$param=array(
			'id_mutasi'=>$id_mutasi
		);
		$data['mutasi']=$this->Global_model->get_by_id('mutasi',$param)->row();
		$data['mutasi_inventaris']=$this->Global_model->getInventarisMutasi($id_mutasi)->result();
		$this->load->view('laporan/detail_mutasi',$data);
	}
	public function detail_penghapusan($id_penghapusan){
		$param=array(
			'id_penghapusan'=>$id_penghapusan
		);
		$data['penghapusan']=$this->Global_model->get_by_id('penghapusan',$param)->row();
		$data['penghapusan_inventaris']=$this->Global_model->getInventarisPenghapusan($id_penghapusan)->result();
		$this->load->view('laporan/detail_penghapusan',$data);
	}
	public function detail_pengembalian($id_pengembalian){
		$param=array(
			'id_pengembalian'=>$id_pengembalian
		);
		$data['pengembalian']=$this->Global_model->get_by_id('pengembalian',$param)->row();
		$data['pengembalian_inventaris']=$this->Global_model->getInventarisPengembalian($id_pengembalian)->result();
		$this->load->view('laporan/detail_pengembalian',$data);
	}
	public function get_pihak_kedua(){
		$of_id=$this->input->post('of_id');
		$sub_id=$this->input->post('sub_id');
		if($of_id==1){
			$data=infoPusat($sub_id);
		}else{
			$data=infoCabang($of_id);
		}
		return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($data
				));
	}
	public function delete_ba(){
		$id=$this->input->post('id');
		$where_ba=array(
			'id'=>$id
		);
		$where_ba_inv=array(
			'id_berita_acara'=>$id
		);
		$this->Global_model->delete('berita_acara',$where_ba);
		$this->Global_model->delete('berita_acara_inventaris',$where_ba_inv);
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
		}
	public function delete_mutasi(){
		$id=$this->input->post('id');
		$where=array(
			'id_mutasi'=>$id
		);
		$this->Global_model->delete('mutasi',$where);
		$this->Global_model->delete('mutasi_inventaris',$where);
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
		}
		public function delete_penghapusan(){
		$id=$this->input->post('id');
		$where=array(
			'id_penghapusan'=>$id
		);
		$this->Global_model->delete('penghapusan',$where);
		$this->Global_model->delete('penghapusan_inventaris',$where);
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Success!'
            )));
		}
}
