<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
	public function index()
	{
		$search_param = array();
		$data['data'] = $this->Global_model->inventaris($search_param)->result();
		$data['title'] = "Cetak Label";
		$this->load->view('cetak/index', $data);
	}
	public function multi_label()
	{
		$item = $this->input->post('item');
		if (sizeof($item) != 0) {
			$data['data'] = $item;
			$this->load->view('cetak/multi_label', $data);
			return;
		}
		echo "<script>alert('GAGAL. Pilih Minimal 1 barang untuk di cetak labelna !'); close();</script>";
	}
	public function berita_acara($berita_acara_id)
	{
		$param = array(
			'id' => $berita_acara_id
		);
		$data['berita_acara'] = $this->Global_model->get_by_id('berita_acara', $param)->row();
		$data['berita_acara_barang'] = $this->Global_model->getBarangBA($berita_acara_id)->result();
		$this->load->view('cetak/berita_acara', $data);
	}
	public function penghapusan($id_penghapusan)
	{
		$param = array(
			'id_penghapusan' => $id_penghapusan
		);
		$data['penghapusan'] = $this->Global_model->get_by_id('penghapusan', $param)->row();
		$data['penghapusan_inventaris'] = $this->Global_model->getInventarisPenghapusan($id_penghapusan)->result();
		$this->load->view('cetak/penghapusan', $data);
	}
	public function single_label($id)
	{
		$data['id'] = $id;
		$this->load->view('cetak/single_label', $data);
	}
	public function mutasi($id_mutasi)
	{
		$param = array(
			'id_mutasi' => $id_mutasi
		);
		$data['mutasi'] = $this->Global_model->get_by_id('mutasi', $param)->row();
		$data['mutasi_inventaris'] = $this->Global_model->getInventarisMutasi($id_mutasi)->result();
		$this->load->view('cetak/mutasi', $data);
	}
	public function kir($id_kartu_inventaris)
	{
		$param = array(
			'id_kartu_inventaris' => $id_kartu_inventaris
		);
		$data['kartu_inventaris'] = $this->Global_model->get_by_id('kartu_inventaris', $param)->row();
		$data['kartu_inventaris_barang'] = $this->Global_model->getKIRBarang($id_kartu_inventaris)->result();
		$this->load->view('cetak/kir', $data);
	}
	public function pembelian($id_pembelian)
	{
		$param = array(
			'id_pembelian' => $id_pembelian
		);
		$data['pembelian'] = $this->Global_model->get_by_id('pembelian', $param)->row();
		$data['pembelian_inventaris'] = $this->Global_model->getInventarisPembelianByIdPembelian($id_pembelian)->result();
		$this->load->view('cetak/pembelian', $data);
	}
	public function barang()
	{
		$id_barang = $this->input->post('id_barang');
		$status = $this->input->post('status');
		$y = $this->input->post('y');
		$m = $this->input->post('m');
		$d = $this->input->post('d');
		$of_id = $this->input->post('of_id');
		$sub_id = $this->input->post('sub_id');
		$id_ruangan_kir = $this->input->post('id_ruangan_kir');
		$param = array();
		if ($id_barang) {
			$param['inventaris.id_barang'] = $id_barang;
		}
		if ($y) {
			$param['y'] = $y;
		}
		if ($m) {
			$param['m'] = $m;
		}
		if ($d) {
			$param['d'] = $d;
		}
		if ($of_id) {
			$param['inventaris.of_id'] = $of_id;
		}
		if ($sub_id) {
			$param['inventaris.sub_id'] = $sub_id;
		}
		if ($id_ruangan_kir) {
			$param['inventaris.id_ruangan_kir'] = $id_ruangan_kir;
		}
		if ($status) {
			$param['inventaris.status'] = $status;
		}
		$data['data'] = $this->Global_model->inventaris($param)->result();
		$this->load->view('cetak/barang', $data);
	}
}
