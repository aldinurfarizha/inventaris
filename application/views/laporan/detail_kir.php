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
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Berhasil Membuat Kartu Inventaris</h6>
                <span>Silahkan Cetak!</span>
              </div>
            </div>
          <?php } ?>
          <a href="<?= base_url('laporan/kartu_inventaris') ?>" class="btn btn-secondary">
            <i class="fa fa-arrow-alt-circle-left"></i> Kembali
          </a>
          <hr>

          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <a href="#" onclick="hapus(<?= $kartu_inventaris->id_kartu_inventaris ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
              <h5 class="card-title m-0 me-2">Detail Kartu Inventaris</h5>
              <a href="<?= base_url('cetak/kir/' . $kartu_inventaris->id_kartu_inventaris) ?>" target="_blank" class="btn btn-warning">Cetak <i class="fa fa-print"></i></a>

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
                          <td><?= $kartu_inventaris->tanggal ?></td>
                        </tr>
                        <tr>
                          <td>Yang Bertanggung Jawab</td>
                          <td><?= $kartu_inventaris->nama_penanggung_jawab . ' | ' . $kartu_inventaris->nik_penanggung_jawab . ' | ' . $kartu_inventaris->jabatan_penanggung_jawab ?></td>
                        </tr>
                        <tr>
                          <td>Kepala Sub Divisi Logistik</td>
                          <td><?= $kartu_inventaris->nama_kasub_aset . ' | ' . $kartu_inventaris->nik_kasub_aset ?></td>
                        </tr>
                        <tr>
                          <td>Kepala Divisi Umum</td>
                          <td><?= $kartu_inventaris->nama_kadiv_umum . ' | ' . $kartu_inventaris->nik_kadiv_umum ?></td>
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
                            <td>Barang</td>
                            <td>Kondisi</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($kartu_inventaris_barang as $barang) :
                            $kondisi_terakhir = '';
                            $kondisi = generateKondisiBarang($barang->kondisi_baik);
                            if ($barang->pernah_servis == 1) {
                              $servis = "Pernah Servis";
                            } else {
                              $servis = 'Blm Pernah Servis';
                            }
                            $kondisi_terakhir = $kondisi . ', ' . $servis;
                          ?>
                            <tr>
                              <td><?= $no ?>.</td>
                              <td><?= $barang->barang ?></td>
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
          function hapus(id) {
            Swal.fire({
              icon: 'question',
              title: 'Hapus',
              text: 'Anda yakin Akan menghapus Kartu Inventaris Ini ?',
              showConfirmButton: true,
              showCancelButton: true,
              showBackdrop: true,
              confirmButtonText: 'Ya Hapus',
              cancelButtonText: 'Tidak'
            }).then(function(data) {
              if (data.value === true) {
                $.ajax({
                  url: "<?= base_url('laporan/delete_kir') ?>",
                  type: "POST",
                  data: {
                    "id": id,
                    "id_ruangan_kir": "<?= $kartu_inventaris->id_ruangan_kir ?>"
                  },
                  beforeSend() {
                    loading();
                  },
                  success: function(response) {
                    success_open_link("<?= base_url('laporan/kartu_inventaris_detail/') ?>" + response['id_ruangan_kir']);
                  },
                  error: function(response) {
                    Swal.fire({
                      icon: "error",
                      title: 'Opps!',
                      button: "Oke",
                      text: response.responseJSON.messages
                    }).then(function() {})
                  }
                });
              }
            });
          };
        </script>