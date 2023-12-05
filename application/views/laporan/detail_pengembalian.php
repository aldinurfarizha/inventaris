<?php $this->load->view('partials/header') ?>
<div class="layout-page">
  <?php $this->load->view('partials/navbar') ?>
  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12">
          <?php
          if ($this->session->flashdata('status') == 'success') { ?>
            <div class="alert alert-success d-flex" role="alert">
              <span class="badge badge-center rounded-pill bg-success border-label-success p-3 me-2"><i class="fa fa-check-circle"></i></span>
              <div class="d-flex flex-column ps-1">
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Berhasil Membuat Pengembalian ASET Barang</h6>
              </div>
            </div>
          <?php } ?>
          <a href="<?= base_url('laporan/pengembalian') ?>" class="btn btn-secondary">
            <i class="fa fa-arrow-alt-circle-left"></i> Kembali
          </a>
          <hr>

          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Detail Pengembalian Barang Inventaris</h5>
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
                          <td>Waktu dibuat</td>
                          <td><?= $pengembalian->tanggal ?></td>
                        </tr>
                        <tr>
                          <td>Keterangan</td>
                          <td><?= $pengembalian->keterangan ?></td>
                        </tr>
                        <tr>
                          <td>Berkas</td>
                          <td><a class="btn btn-sm btn-success" href="<?= base_url() . BERKAS_PENGEMBALIAN_PATH . $pengembalian->berkas ?>">Berkas <i class="fa fa-file-pdf"></i></a></td>
                        </tr>
                        <tr>
                          <td>Dokumentasi</td>
                          <td><img class="img-fluid" style="cursor: zoom-in;" width="50" height="50" onclick="zoom('<?= base_url() . FOTO_PENGEMBALIAN_PATH . $pengembalian->foto ?>')" src="<?= base_url() . FOTO_PENGEMBALIAN_PATH . $pengembalian->foto ?>" /></td>
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
                            <td>Kondisi</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;

                          foreach ($pengembalian_inventaris as $barang) :
                            $kondisi_terakhir = '';
                            $kondisi = generateKondisiBarang($barang->kondisi_baik);
                            if ($barang->pernah_servis == 1) {
                              $servis = "Pernah Servis";
                            } else {
                              $servis = 'Blm Pernah Servis';
                            }
                            $kondisi_terakhir = $kondisi . ', ' . $servis;
                            $barangs = $barang->merk . ' ' . $barang->tipe . ' ' . $barang->spek;
                          ?>
                            <tr>
                              <td><?= $no ?>.</td>
                              <td><span class="badge bg-secondary"><?= terbilangAngka($barang->total) . ' (' . $barang->total . ') ' . $barang->satuan ?> </span></td>
                              <td><?= $barangs ?></td>
                              <td><?= $kondisi_terakhir ?></td>
                            </tr>
                          <?php $no++;
                          endforeach;
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
        <?php $this->load->view('partials/footer') ?>
        <script>
          function zoom(link) {
            window.open(link, 'mywin', 'width=500,height=500');
          }
        </script>