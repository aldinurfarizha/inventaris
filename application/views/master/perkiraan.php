<?php $this->load->view('partials/header')?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<style>
  table.dataTable.no-footer {
        border-bottom: 0 !important;
    }
</style>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-3">
                  
                </div>
                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                      <i class="fa fa-plus"></i> Perkiraan
                    </button>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Master Perkiraan</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table id="table" class="table table-hover table-borderless">
                    <thead>
                      <tr class="text-center">
                        <th>#</th>
                        <th>Kode Perkiraan</th>
                        <th>Nama Perkiraan Dasar</th>
                        <th>Nama Perkiraan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     <?php $no=1;
                     foreach($data as $datar):?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$datar->kd_perkiraan?></td>
                          <td class="text-center">
                            <?php 
                            if($datar->nama_perkiraan_dasar=="MEUBELAIR"):?>
                            <span class="badge bg-warning"><?=$datar->nama_perkiraan_dasar?></span>
                           <?php else:?>
                            <span class="badge bg-dark"><?=$datar->nama_perkiraan_dasar?></span>
                            <?php endif;?>
                          </td>
                          <td><?=$datar->nama_perkiraan?></td>
                          <td class="text-center">
                            <button type="button" onclick="hapus(<?=$datar->id_perkiraan?>)" class="btn btn-sm btn-icon btn-danger">
                              <span class="fa fa-trash"></span>
                              </button>
                             <button type="button" onclick="edit('<?=$datar->id_perkiraan?>','<?=$datar->kd_perkiraan_dasar?>','<?=$datar->kd_sub_perkiraan?>','<?=$datar->nama_perkiraan_dasar?>','<?=$datar->nama_perkiraan?>')" class="btn btn-sm btn-icon btn-success">
                              <span class="fas fa-pencil-alt"></span>
                              </button>
                          </td>
                        </tr>
                      <?php $no++; endforeach;?>
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
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Master Perkiraan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_edit">
                                      <div>
                                        <input type="hidden" id="id" name="id">
                                      <label for="defaultFormControlInput" class="form-label">Perkiraan Dasar</label>
                                      <select name="kd_perkiraan_dasar" id="kd_perkiraan_dasar_edit" class="form-control">
                                        <option value="">--Pilih Perkiraan Dasar--</option>
                                        <?php foreach($kategori as $kategor):?>
                                          <option value="<?=$kategor->kd_perkiraan_dasar?>"><?=$kategor->nama_perkiraan_dasar?></option>
                                        <?php endforeach;?>
                                      </select>
                                    </div>
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Kode Perkiraan</label>
                                      <div class="input-group">
                                        <span class="input-group-text" id="kode_perkiraan_dasar_edit"></span>
                                        <input type="text" class="form-control" placeholder="01.02.03" aria-label="Username" name="kd_sub_perkiraan" id="kd_sub_perkiraan_edit" aria-describedby="basic-addon11">
                                      </div>
                                    </div>
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama kategori</label>
                                      <input type="text" class="form-control"  name="nama_perkiraan" id="nama_perkiraan_edit" placeholder="misal: Meja, CPU, Kursi" aria-describedby="defaultFormControlHelp">
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
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Master Perkiraan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_add">
                                      <div>
                                      <label for="defaultFormControlInput" class="form-label">Perkiraan Dasar</label>
                                      <select name="kd_perkiraan_dasar" id="kd_perkiraan_dasar" class="form-control">
                                        <option value="" selected="true">--Pilih Perkiraan Dasar--</option>
                                        <?php foreach($kategori as $kategor):?>
                                          <option value="<?=$kategor->kd_perkiraan_dasar?>"><?=$kategor->nama_perkiraan_dasar?></option>
                                        <?php endforeach;?>
                                      </select>
                                    </div>
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Kode Perkiraan</label>
                                      <div class="input-group">
                                        <span class="input-group-text" id="kode_perkiraan_dasar"></span>
                                        <input type="text" class="form-control" placeholder="01.02.03" aria-label="Username" name="kd_sub_perkiraan" aria-describedby="basic-addon11">
                                      </div>
                                    </div>
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama Perkiraan</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="nama_perkiraan" placeholder="misal: Meja, CPU, Kursi" aria-describedby="defaultFormControlHelp">
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
<?php $this->load->view('partials/footer')?>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
  $('select').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    $('#kode_perkiraan_dasar').text(this.value);
    $('#kode_perkiraan_dasar_edit').text(this.value);
});
  $(document).ready(function(){
        $('#table').DataTable();
    });
 $('#form_add').trigger("reset");
 function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus Perkiraan Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('master/delete_perkiraan')?>",
                      type: "POST",
                      data: {
                          "id":id,
                      },
                      beforeSend(){
                        loading();
                      },
                      success:function(response){
                        success();
                      },
                      error:function(response){
                          Swal.fire({
                            icon: "error",
                            title: 'Opps!',
                            button:"Oke",
                            text: response.responseJSON.messages
                          }).then(function(){
                          })
                      }
                    });
                    }
                    });};
function edit(id,kd_perkiraan_dasar, kd_sub_perkiraan, nama_perkiraan_dasar, nama_perkiraan){
$('#editModal').modal('show');
$('#id').val(id);
var option="<option value="+kd_perkiraan_dasar+" selected='true'>"+nama_perkiraan_dasar+"</option>"
$('#kd_perkiraan_dasar_edit').append(option);
$('#kd_sub_perkiraan_edit').val(kd_sub_perkiraan);
$('#nama_perkiraan_edit').val(nama_perkiraan);
$('#kode_perkiraan_dasar_edit').text(kd_perkiraan_dasar);
}
function do_edit(){
  $.ajax({
                      url: "<?= base_url('master/edit_perkiraan')?>",
                      type: "POST",
                      data: $('#form_edit').serialize(),
                      beforeSend(){
                        loading();
                        $('#editModal').modal('hide');
                      },
                      success:function(response){
                        success();
                      },
                      error:function(response){
                          Swal.fire({
                            icon: "error",
                            title: 'Opps!',
                            button:"Oke",
                            text: response.responseJSON.messages
                          }).then(function(){
                               $('#editModal').modal('show');
                          })
                      }
                    });
}
function add(){
              $.ajax({
              url: "<?= base_url('master/add_perkiraan')?>",
              type: "POST",
              data:$('#form_add').serialize(), 
              beforeSend(){
              $("#add").attr("disabled", true);
              loading();
              $('#basicModal').modal('hide');
              },
              success:function(response){
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
              error:function(response){
                $("#add").attr("disabled", false);
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: response.responseJSON.messages
                  }).then(function(){
                    $('#basicModal').modal('show');
                  })
              }
            });
        };
</script>