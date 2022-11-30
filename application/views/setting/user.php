<?php $this->load->view('partials/header')?>
 <div class="layout-page">
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-3">
                  
                </div>
                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                      <i class="fa fa-plus"></i> USER
                    </button>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data User</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama </th>
                        <th>Username</th>
                        <th>password</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     <?php $no=1; foreach($data as $datar):?>
                        <tr>
                           <td><?=$no?></td>
                          <td><?=$datar->nama?></td>
                          <td><?=$datar->username?></td>
                          <td><?=$datar->password?></td>
                          <?php if($no==1){?>
                          <td></td>
                          <?php }else{?>
                          <td class="text-center">
                            <button type="button" onclick="hapus(<?=$datar->id_user?>)" class="btn btn-sm btn-icon btn-danger">
                              <span class="fa fa-trash"></span>
                              </button>
                             <button type="button" onclick="edit('<?=$datar->id_user?>','<?=$datar->nama?>','<?=$datar->username?>','<?=$datar->password?>')" class="btn btn-sm btn-icon btn-success">
                              <span class="fas fa-pencil-alt"></span>
                              </button>
                          </td>
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
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Master Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_edit">
                                     <div>
                                       <input type="hidden" name="id" id="id">
                                      <label for="defaultFormControlInput" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" placeholder="Misal:Fullan Fullanah" aria-label="Username" name="nama_edit" id="nama_edit" aria-describedby="basic-addon11">
                                    </div>
                                      <div>
                                      <label for="defaultFormControlInput" class="form-label">Username</label>
                                        <input type="text" class="form-control" placeholder="Misal:fullanah123" aria-label="Username" id="username_edit" onkeypress="return event.charCode != 32" name="username_edit" aria-describedby="basic-addon11">
                                    </div>
                                     <div>
                                      <label for="defaultFormControlInput" class="form-label">Password</label>
                                        <input type="text" class="form-control" aria-label="Username" name="password_edit" id="password_edit" aria-describedby="basic-addon11">
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
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_add">
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" placeholder="Misal:Fullan Fullanah" aria-label="Username" name="nama" aria-describedby="basic-addon11">
                                    </div>
                                      <div>
                                      <label for="defaultFormControlInput" class="form-label">Username</label>
                                        <input type="text" class="form-control" placeholder="Misal:fullanah123" aria-label="Username" onkeypress="return event.charCode != 32" name="username" aria-describedby="basic-addon11">
                                    </div>
                                     <div>
                                      <label for="defaultFormControlInput" class="form-label">Password</label>
                                        <input type="text" class="form-control" aria-label="Username" name="password" aria-describedby="basic-addon11">
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
 $('#form_add').trigger("reset");
 function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus USER Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('setting/delete_user')?>",
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
function edit(id,nama,username,password){
$('#editModal').modal('show');
$('#id').val(id);
$('#nama_edit').val(nama);
$('#username_edit').val(username);
$('#password_edit').val(password);
}
function do_edit(){
  $.ajax({
                      url: "<?= base_url('setting/edit_user')?>",
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
              url: "<?= base_url('setting/add_user')?>",
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