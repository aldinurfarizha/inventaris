<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-3">
                  
                </div>
                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                      <i class="fa fa-plus"></i> Kantor
                    </button>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Kantor</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Kantor</th>
                        <th>Kepala</th>
                        <th>NIK</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     <?php $no=1; foreach($data as $datar):?>
                        <tr>
                           <td><?=$no?></td>
                          <td><?=$datar->nama?></td>
                           <td><?=$datar->kepala?></td>
                           <td><?=$datar->nik?></td>
                          <?php if($datar->is_pusat==0){?>
                            <td class="text-center">
                            <button type="button" onclick="hapus(<?=$datar->of_id?>)" class="btn btn-sm btn-icon btn-danger">
                              <span class="fa fa-trash"></span>
                              </button>
                             <button type="button" onclick="edit('<?=$datar->of_id?>','<?=$datar->nama?>','<?=$datar->kepala?>','<?=$datar->nik?>')" class="btn btn-sm btn-icon btn-success">
                              <span class="fas fa-pencil-alt"></span>
                              </button>
                            </td>
                          <?php }else{?>
                            <td></td>
                        <?php } ?>
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
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Kantor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_edit">
                                  <input type="hidden" id="id" name="id">
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama Kantor</label>
                                      <input type="text" class="form-control"  name="nama_kantor_edit" id="nama_kantor_edit" placeholder="misal: KCP.Darma" aria-describedby="defaultFormControlHelp">
                                    </div>
                                      <div>
                                      <label for="defaultFormControlInput" class="form-label">Kepala</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="kepala_edit" placeholder="misal: Fullan Fullanah" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div>
                                      <label for="defaultFormControlInput" class="form-label">NIK</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="nik_edit" placeholder="misal: 123.123" aria-describedby="defaultFormControlHelp">
                                    </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Batal
                                </button>
                                <button type="button" onclick="do_edit()" id="edit" class="btn btn-primary">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                   <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Kantor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_add">
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama Kantor</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="nama" placeholder="misal: KCP.Kuningan" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div>
                                      <label for="defaultFormControlInput" class="form-label">Kepala</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="kepala" placeholder="misal: Fullan Fullanah" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div>
                                      <label for="defaultFormControlInput" class="form-label">NIK</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="nik" placeholder="misal: 123.123" aria-describedby="defaultFormControlHelp">
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
<script>
  $('select').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    $('#kode_kategori').text(this.value);
    $('#kode_kategori_edit').text(this.value);
});
 $('#form_add').trigger("reset");
 function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus kantor Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('master/delete_kantor')?>",
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
function edit(id,nama,kepala, nik){
$('#editModal').modal('show');
$('#id').val(id);
$('#nama_kantor_edit').val(nama);
$('#kepala_edit').val(kepala);
$('#nik_edit').val(nik);
}
function do_edit(){
  $.ajax({
                      url: "<?= base_url('master/edit_kantor')?>",
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
              url: "<?= base_url('master/add_kantor')?>",
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