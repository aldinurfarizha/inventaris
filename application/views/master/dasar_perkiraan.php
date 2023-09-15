<?php $this->load->view('partials/header') ?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<style>
  table.dataTable.no-footer {
    border-bottom: 0 !important;
  }
</style>
<div class="layout-page">
  <?php $this->load->view('partials/navbar') ?>
  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row justify-content-end">
        <div class="col-md-3">

        </div>
        <div class="col-md-12">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
            <i class="fa fa-plus"></i> Dasar Perkiraan
          </button>
          <hr>
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Data Master Perkiraan</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table id="table" class="table table-hover table-borderless table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Kode Perkiraan Dasar</th>
                      <th>Nama Perkiraan Dasar</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php $no = 1;
                    foreach ($data as $datar) : ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td class="text-center"><b><?= $datar->kd_perkiraan_dasar ?></b></td>
                        <td class="text-center">
                          <span class="badge bg-primary"><?= $datar->nama_perkiraan_dasar ?></span>
                        </td>
                        <td class="text-center">
                          <button type="button" onclick="edit('<?= $datar->kd_perkiraan_dasar ?>','<?= $datar->nama_perkiraan_dasar ?>')" class="btn btn-sm btn-icon btn-success">
                            <span class="fas fa-pencil-alt"></span>
                          </button>
                        </td>
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
      <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Edit Master Perkiraan Dasar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="form_edit">
                <div>
                  <label for="defaultFormControlInput" class="form-label">Kode Perkiraan Dasar</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="misal:31.09.10" id="kd_perkiraan_dasar" aria-label="Username" name="kd_perkiraan_dasar_edit" readonly aria-describedby="basic-addon11">
                  </div>
                  <small class="text-muted">*Kode Perkiraan dasar tidak bisa di edit</small>
                </div>
                <div>
                  <label for="defaultFormControlInput" class="form-label">Nama Perkiraan Dasar</label>
                  <input type="text" class="form-control" id="nama_perkiraan_dasar" oninput="this.value = this.value.toUpperCase()" name="nama_perkiraan_dasar_edit" placeholder="misal: Meubelair" aria-describedby="defaultFormControlHelp">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Batal
              </button>
              <button type="button" onclick="do_edit()" id="edit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Tambah Master Perkiraan Dasar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="form_add">
                <div>
                  <label for="defaultFormControlInput" class="form-label">Kode Perkiraan Dasar</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="misal:31.09.10" maxlength="8" aria-label="Username" name="kd_perkiraan_dasar" aria-describedby="basic-addon11">
                  </div>
                </div>
                <div>
                  <label for="defaultFormControlInput" class="form-label">Nama Perkiraan Dasar</label>
                  <input type="text" class="form-control" id="defaultFormControlInput" oninput="this.value = this.value.toUpperCase()" name="nama_perkiraan_dasar" placeholder="misal: Meubelair" aria-describedby="defaultFormControlHelp">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Batal
              </button>
              <button type="button" onclick="add()" id="add" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('partials/footer') ?>
      <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#table').DataTable();
        });
        $('#form_add').trigger("reset");

        function edit(kd_perkiraan_dasar, nama_perkiraan_dasar) {
          $('#editModal').modal('show');
          $('#kd_perkiraan_dasar').val(kd_perkiraan_dasar);
          $('#nama_perkiraan_dasar').val(nama_perkiraan_dasar);
        }

        function do_edit() {
          $.ajax({
            url: "<?= base_url('master/edit_perkiraan_dasar') ?>",
            type: "POST",
            data: $('#form_edit').serialize(),
            beforeSend() {
              loading();
              $('#editModal').modal('hide');
            },
            success: function(response) {
              success();
            },
            error: function(response) {
              Swal.fire({
                icon: "error",
                title: 'Opps!',
                button: "Oke",
                text: response.responseJSON.messages
              }).then(function() {
                $('#editModal').modal('show');
              })
            }
          });
        }

        function add() {
          $.ajax({
            url: "<?= base_url('master/add_perkiraan_dasar') ?>",
            type: "POST",
            data: $('#form_add').serialize(),
            beforeSend() {
              $("#add").attr("disabled", true);
              loading();
              $('#basicModal').modal('hide');
            },
            success: function(response) {
              $("#add").attr("disabled", false);
              $('#form_add').trigger("reset");
              Swal.fire({
                title: "Berhasil",
                icon: "success",
                button: "OK",
              }).then(function() {
                location.reload();
              });
            },
            error: function(response) {
              $("#add").attr("disabled", false);
              Swal.fire({
                icon: "error",
                title: 'Opps!',
                button: "Oke",
                text: response.responseJSON.messages
              }).then(function() {
                $('#basicModal').modal('show');
              })
            }
          });
        };
      </script>