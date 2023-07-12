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
                                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Berhasil Membuat Mutasi Barang</h6>
                                <span>Silahkan Cetak!</span>
                              </div>
                            </div>
                  <?php } ?>
                    <a href="<?=base_url('laporan/mutasi')?>" class="btn btn-secondary">
                      <i class="fa fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                    <hr>

                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Detail Mutasi Barang Inventaris</h5>
                      <a href="<?=base_url('cetak/mutasi/'.$mutasi->id_mutasi)?>" target="_blank" class="btn btn-warning">Cetak <i class="fa fa-print"></i></a>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="row">
                          <div class="col-md-12">
                            <div class="text-center">
                              <span class="badge bg-dark">Informasi</span>
                            </div>
                            <br>
                            <table class="table table-striped">
                              <tr>
                                <td>Nomor</td>
                                <td><?=generateNomorMutasi($mutasi->id_mutasi)?></td>
                              </tr>
                              <tr>
                                <td>Waktu dibuat</td>
                                <td><?=$mutasi->tanggal?></td>
                              </tr>
                              <tr>
                                <td>Yang Menyerahkan</td>
                                <td><?=$mutasi->nama_penyerah.' | '.$mutasi->nik_penyerah.' | '.$mutasi->jabatan_penyerah?></td>
                              </tr>
                              <tr>
                                <td>Yang Menerima</td>
                                <td><?=$mutasi->nama_penerima.' | '.$mutasi->nik_penerima.' | '.$mutasi->jabatan_penerima?></td>
                              </tr>
                              <tr>
                                <td>Kepala Divisi Umum</td>
                                <td><?=$mutasi->nama_kadiv_umum.' | '.$mutasi->nik_kadiv_umum?></td>
                              </tr>
                                <tr>
                                <td>Asal -> Tujuan</td>
                                <td><?php
                                    if($mutasi->of_id_penyerah==1){
                                      $asal=detailOfid($mutasi->of_id_penyerah)->nama.' '.detailSubOffice($mutasi->sub_id_penyerah)->nama;
                                    }else{
                                      $asal=detailOfid($mutasi->of_id_penyerah)->nama;
                                    }
                                    if($mutasi->of_id_penerima==1){
                                      $tujuan=detailOfid($mutasi->of_id_penerima)->nama.' '.detailSubOffice($mutasi->sub_id_penerima)->nama;
                                    }else{
                                      $tujuan=detailOfid($mutasi->of_id_penerima)->nama;
                                    }
                                    echo $asal.' -> '.$tujuan;
                                    ?>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                        <div class="col-md-6">
                          <div class="row">
                          <div class="col-md-12">
                            <div class="text-center">
                              <span class="badge bg-dark">Daftar Inventaris</span>
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
                                foreach($mutasi_inventaris as $barang):
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