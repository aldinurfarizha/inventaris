<?php $this->load->view('partials/header') ?>
<div class="layout-page">
  <?php $this->load->view('partials/navbar') ?>
  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row justify-content-end">
        <div class="col-md-12">
          <?php
          if ($this->session->flashdata('status') == 'success') { ?>
            <div class="alert alert-success d-flex" role="alert">
              <span class="badge badge-center rounded-pill bg-success border-label-success p-3 me-2"><i class="fa fa-check-circle"></i></span>
              <div class="d-flex flex-column ps-1">
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Berhasil Membuat Laporan Pembelian Barang</h6>
                <span>Silahkan Cetak!</span>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="col-md-12">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
            <i class="fa fa-plus"></i> Laporan Pembelian Barang
          </button>
          <hr>
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Laporan Pembelian Barang Inventaris</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th class="text-center">Total Barang</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php $no = 1;
                    foreach ($data as $datar) : ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= bulan($datar->m) ?></td>
                        <td><?= $datar->y ?></td>
                        <th class="text-center"><span class="badge badge-center rounded-pill bg-secondary"><?= $datar->total_pembelian_inventaris ?></span></th>
                        <td class="text-center"><a href="<?= base_url('cetak/pembelian/' . $datar->id_pembelian) ?>" target="_blank" class="btn btn-warning btn-sm">Cetak <i class="fa fa-print"></i></a></td>
                      </tr>
                    <?php $no++;
                    endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Buat Laporan Pembelian Barang</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="insert_pembelian" method="POST">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Kadiv Umum <div style="display:inline;" id="loading_kadiv_umum"></div></label>
                      <select name="id_kadiv_umum" class="form-control" id="id_kadiv_umum">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Kasub Aset <div style="display:inline;" id="loading_kasub_aset"></div></label>
                      <select name="id_kasub_aset" class="form-control" id="id_kasub_aset">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Pel. Subdiv Aset<div style="display:inline;" id="loading_penanggung_jawab"></div></label>
                      <select name="id_pelaksana" class="form-control" id="id_pelaksana">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Bulan</label>
                    <select class="form-control" name="m" id="m">
                      <option value="">--Pilih Bulan--</option>
                      <?php $no = 1;
                      foreach (opt_bulan() as $bulan) {
                        if ($bulan != "") { ?>
                          <option value="<?= $no ?>"><?= $bulan ?></option>
                        <?php } ?>
                      <?php $no++;
                      } ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Tahun</label>
                    <select class="form-control" name="y" id="y">
                      <option value="">--Pilih Tahun--</option>
                      <?php $no = 1;
                      foreach (opt_tahun() as $years) {
                        if ($years != "") { ?>
                          <option value="<?= $years ?>"><?= $years ?></option>
                        <?php } ?>
                      <?php $no++;
                      } ?>
                    </select>
                  </div>


                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Batal
              </button>
              <button type="submit" onclick="add()" id="add" class="btn btn-primary">Buat</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <?php $this->load->view('partials/footer') ?>
      <script>
        function loadingKadivUmum() {
          $('#loading_kadiv_umum').html('<i class="fas fa-circle-notch fa-spin"></i>');
        }

        function UnloadingKadivUmum() {
          $('#loading_kadiv_umum').html('');
        }

        function loadingKasubAset() {
          $('#loading_kasub_aset').html('<i class="fas fa-circle-notch fa-spin"></i>');
        }

        function UnloadingKasubAset() {
          $('#loading_kasub_aset').html('');
        }

        function loadingPenanggungJawab() {
          $('#loading_penanggung_jawab').html('<i class="fas fa-circle-notch fa-spin"></i>');
        }

        function UnloadingPenanggungJawab() {
          $('#loading_penanggung_jawab').html('');
        }

        function loadingRuanganKIR() {
          $('#loading_penanggung_jawab').html('<i class="fas fa-circle-notch fa-spin"></i>');
        }

        function UnloadingRuanganKIR() {
          $('#loading_penanggung_jawab').html('');
        }

        getKadivUmum();

        function getKadivUmum() {
          $.ajax({
            url: "<?= base_url('inventaris/get_employee') ?>",
            type: "POST",
            data: {
              off_id: 1,
              dept_id: 4,
              subdept_id: 45,
              occ_id: 2
            },
            beforeSend() {
              loadingKadivUmum();
            },
            success: function(response) {
              UnloadingKadivUmum();
              var data = response['data'];
              var html = '';
              for (var i = 0; i < response['data'].length; i++) {
                html += '<option selected="true" value="' + data[i].id + '">' + data[i].nama + ' | ' + data[i].nik + '</option>';
              }
              $('#id_kadiv_umum').html(html);
            },
            error: function(response) {
              Swal.fire({
                icon: "error",
                title: 'Opps!',
                button: "Oke",
                text: "Gagal Mengambil Data Kadiv Umum"
              }).then(function() {
                location.reload();
              })
            }
          });
        }
        getPenanggungJawab();

        function getPenanggungJawab() {
          let of_id = $('#of_id').val();
          var param;
          param = {
            off_id: 1,
            dept_id: 4,
            subdept_id: 48,
            occ_id: 10
          }
          $.ajax({
            url: "<?= base_url('inventaris/get_employee') ?>",
            type: "POST",
            data: param,
            beforeSend() {
              loadingPenanggungJawab();
            },
            success: function(response) {
              UnloadingPenanggungJawab();
              var data = response['data'];
              var html = '';
              html += '<option selected="true" value="">--Pilih--</option>';
              for (var i = 0; i < response['data'].length; i++) {
                html += '<option value="' + data[i].id + '">' + data[i].nama + ' | ' + data[i].nik + '</option>';
              }
              $('#id_pelaksana').html(html);
            },
            error: function(response) {
              Swal.fire({
                icon: "error",
                title: 'Opps!',
                button: "Oke",
                text: "Gagal Mengambil Data Penanggung Jawab"
              }).then(function() {
                location.reload();
              })
            }
          });
        }
        getKasubAset();

        function getKasubAset() {
          $.ajax({
            url: "<?= base_url('inventaris/get_employee') ?>",
            type: "POST",
            data: {
              off_id: 1,
              dept_id: 4,
              subdept_id: 48,
              occ_id: 4
            },
            beforeSend() {
              loadingKasubAset();
            },
            success: function(response) {
              UnloadingKasubAset();
              var data = response['data'];
              var html = '';
              for (var i = 0; i < response['data'].length; i++) {
                html += '<option selected="true" value="' + data[i].id + '">' + data[i].nama + ' | ' + data[i].nik + '</option>';
              }
              $('#id_kasub_aset').html(html);
            },
            error: function(response) {
              Swal.fire({
                icon: "error",
                title: 'Opps!',
                button: "Oke",
                text: "Gagal Mengambil Data Kasub Aset"
              }).then(function() {
                location.reload();
              })
            }
          });
        }

        function add() {
          $("#add").attr("disabled", true);
        };
      </script>