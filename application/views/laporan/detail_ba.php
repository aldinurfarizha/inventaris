<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-12">
                  <?php
                  if($this->session->flashdata('status')=='success'){?>
                    <div class="alert alert-success d-flex" role="alert">
                              <span class="badge badge-center rounded-pill bg-success border-label-success p-3 me-2"><i class="fa fa-check-circle"></i></span>
                              <div class="d-flex flex-column ps-1">
                                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Berhasil Membuat Berita Acara</h6>
                                <span>Silahkan Cetak!</span>
                              </div>
                            </div>
                  <?php } ?>
                    <a href="<?=base_url('laporan/berita_acara')?>" class="btn btn-secondary">
                      <i class="fa fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                    <hr>

                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Detail Berita Acara Serah Terima Barang Inventaris</h5>
                      <a href="<?=base_url('cetak/berita_acara/'.$berita_acara->id)?>" target="_blank" class="btn btn-warning">Cetak <i class="fa fa-print"></i></a>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="row">
                          <div class="col-md-12">
                            <div class="text-center">
                              <span class="badge bg-dark">Informasi Berita Acara</span>
                            </div>
                            <br>
                            <table class="table table-striped">
                              <tr>
                                <td>Nomor</td>
                                <td><?=generateNomorBA($berita_acara->id)?></td>
                              </tr>
                              <tr>
                                <td>Waktu dibuat</td>
                                <td><?=$berita_acara->tanggal?></td>
                              </tr>
                              <tr>
                                <td>Kadiv Umum</td>
                                <td><?=$berita_acara->kadiv_umum_nama.' | '.$berita_acara->kadiv_umum_nik?></td>
                              </tr>
                              <tr>
                                <td>Pihak Kedua</td>
                                <td><?=$berita_acara->pihak_kedua_nama.' | '.$berita_acara->pihak_kedua_nik?></td>
                              </tr>
                                <tr>
                                <td>Kasub RT</td>
                                <td><?=$berita_acara->sub_div_rt_nama.' | '.$berita_acara->sub_div_rt_nik?></td>
                              </tr>
                                <tr>
                                <td>Kantor</td>
                                <td><?=@detailOfid($berita_acara->of_id)->nama.' - '.@detailSubOffice($berita_acara->sub_office)->nama?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                        <div class="col-md-6">
                          <div class="row">
                          <div class="col-md-12">
                            <div class="text-center">
                              <span class="badge bg-dark">Daftar Barang</span>
                            </div>
                            <br>
                            <table class="table table-striped">
                              <thead>
                              <tr>
                                <td>No.</td>
                                <td>Jumlah</td>
                                <td>Barang</td>
                              </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $no=1;
                                foreach($berita_acara_barang as $barang):
                                $detail_barang=get_detail_barang($barang->id_inventaris);
                                $barangs=$detail_barang->merk.' '.$detail_barang->tipe.' '.$detail_barang->spek;
                                ?>
                                <tr>
                                  <td><?=$no?>.</td>
                                  <td><span class="badge bg-secondary"><?=terbilangAngka($barang->total).' ('.$barang->total.') '.$barang->satuan?> </span></td>
                                  <td><?=$barangs?></td>
                                </tr>
                                <?php $no++; endforeach;
                                ?>
                              </tbody>
                                
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<?php $this->load->view('partials/footer')?>