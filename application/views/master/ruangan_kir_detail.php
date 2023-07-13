<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
      <?php 
      @$office=detailOfid($of_id);
      @$sub_office=detailSubOffice($sub_id);
      ?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-3">
                  
                </div>
                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                      <i class="fa fa-plus"></i> Ruangan KIR di <?=@$office->nama.' '.@$sub_office->nama?>
                    </button>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Ruangan KIR di Lingkup <?=@$office->nama.' '.@$sub_office->nama?></h5>
                    </div>
                    <div class="card-body">
                  <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Ruangan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=1; foreach($data as $datar):?>
                          <td><?=$no?></td>
                          <td><?=$datar->nama_ruangan?></td>
                           <td class="text-center">
                            <button type="button" onclick="hapus(<?=$datar->id_ruangan_kir?>)" class="btn btn-sm btn-icon btn-danger">
                              <span class="fa fa-trash"></span>
                              </button>
                             <button type="button" onclick="edit('<?=$datar->id_ruangan_kir?>','<?=$datar->nama_ruangan?>')" class="btn btn-sm btn-icon btn-success">
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
                   <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Ruangan KIR di <?=@$office->nama.' '.@$sub_office->nama?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_add">
                                    <div class="row">
                                     <input type="hidden" class="form-control"  name="of_id" id="of_id" value="<?=$of_id?>" aria-describedby="defaultFormControlHelp">
                                     <?php if($of_id==1){?>
                                        <input type="hidden" class="form-control"  name="sub_id" id="sub_id" value="<?=$sub_id?>" aria-describedby="defaultFormControlHelp">
                                     <?php }else{?>
                                        <input type="hidden" class="form-control"  name="sub_id" id="sub_id" value="0" aria-describedby="defaultFormControlHelp">
                                     <?php }?>
                                    <div class="col-md-12">
                                      <label>Nama Ruangan</label>
                                      <input type="text" class="form-control"  name="nama_ruangan" id="nama_ruangan" placeholder="misal: Ruangan Kepala Divisi" aria-describedby="defaultFormControlHelp">
                                    </div>
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
                        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Ruangan KIR</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_edit">
                                  <input type="hidden" id="id_ruangan_kir" name="id_ruangan_kir">
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama ruangan</label>
                                      <input type="text" class="form-control"  name="nama_ruangan_edit" id="nama_ruangan_edit" placeholder="misal: KCP.Darma" aria-describedby="defaultFormControlHelp">
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
<?php $this->load->view('partials/footer')?>
<script>
 function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus Ruangan KIR Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('master/delete_ruangan_kir')?>",
                      type: "POST",
                      data: {
                          "id_ruangan_kir":id,
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
function edit(id,nama_ruangan){
$('#editModal').modal('show');
$('#id_ruangan_kir').val(id);
$('#nama_ruangan_edit').val(nama_ruangan);
}
function do_edit(){
  $.ajax({
                      url: "<?= base_url('master/edit_ruangan_kir')?>",
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
function validation(){
    if($('#nama_ruangan').val()==""){
        alertMessage("Nama Ruangan belum di isi !")
        return false;
    }
    return true;
}
function add(){
   if(!validation()){
                return false;
             }
              $.ajax({
              url: "<?= base_url('master/add_ruangan_kir')?>",
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