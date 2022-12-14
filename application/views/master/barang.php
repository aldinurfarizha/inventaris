<?php $this->load->view('partials/header')?>
 <div class="layout-page">
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-3">
                  
                </div>
                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                      <i class="fa fa-plus"></i> Master Barang
                    </button>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Master Barang</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kode Kategori</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     <?php $no=1; foreach($data as $datar):?>
                        <tr>
                           <td><?=$no?></td>
                          <td><?=$datar->kd_kategori?></td>
                          <td><?=$datar->kd_barang?></td>
                          <td><?=$datar->nama_barang?></td>
                          <td class="text-center">
                            <button type="button" onclick="hapus(<?=$datar->id?>)" class="btn btn-sm btn-icon btn-danger">
                              <span class="fa fa-trash"></span>
                              </button>
                             <button type="button" onclick="edit('<?=$datar->id?>','<?=$datar->kd_kategori?>','<?=$datar->kd_sub_barang?>','<?=$datar->nama_barang?>','<?=$datar->nama_kategori?>')" class="btn btn-sm btn-icon btn-success">
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
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Master Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_edit">
                                      <div>
                                        <input type="hidden" id="id" name="id">
                                      <label for="defaultFormControlInput" class="form-label">Kategori Barang</label>
                                      <select name="kd_kategori_edit" id="kd_kategori_edit" class="form-control">
                                        <option value="">--Pilih Kategori--</option>
                                        <?php foreach($kategori as $kategor):?>
                                          <option value="<?=$kategor->kd_kategori?>"><?=$kategor->nama_kategori?></option>
                                        <?php endforeach;?>
                                      </select>
                                    </div>
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Kode Barang</label>
                                      <div class="input-group">
                                        <span class="input-group-text" id="kode_kategori_edit"></span>
                                        <input type="text" class="form-control" placeholder="01.02.03" aria-label="Username" name="kd_barang_edit" id="kd_barang_edit" aria-describedby="basic-addon11">
                                      </div>
                                    </div>
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama Barang</label>
                                      <input type="text" class="form-control"  name="nama_barang_edit" id="nama_barang_edit" placeholder="misal: Meja, CPU, Kursi" aria-describedby="defaultFormControlHelp">
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
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Master Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_add">
                                      <div>
                                      <label for="defaultFormControlInput" class="form-label">Kategori Barang</label>
                                      <select name="kd_kategori" id="kd_kategori" class="form-control">
                                        <option value="" selected="true">--Pilih Kategori--</option>
                                        <?php foreach($kategori as $kategor):?>
                                          <option value="<?=$kategor->kd_kategori?>"><?=$kategor->nama_kategori?></option>
                                        <?php endforeach;?>
                                      </select>
                                    </div>
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Kode Barang</label>
                                      <div class="input-group">
                                        <span class="input-group-text" id="kode_kategori"></span>
                                        <input type="text" class="form-control" placeholder="01.02.03" aria-label="Username" name="kd_barang" aria-describedby="basic-addon11">
                                      </div>
                                    </div>
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama Barang</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="nama_barang" placeholder="misal: Meja, CPU, Kursi" aria-describedby="defaultFormControlHelp">
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
                        text: 'Anda yakin ingin Menghapus master barang Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('master/delete_barang')?>",
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
function edit(id,kd_kategori, kd_sub_barang, nama_barang, nama_kategori){
$('#editModal').modal('show');
$('#id').val(id);
var option="<option value="+kd_kategori+" selected='true'>"+nama_kategori+"</option>"
$('#kd_kategori_edit').append(option);
$('#kd_barang_edit').val(kd_sub_barang);
$('#nama_barang_edit').val(nama_barang);
$('#kode_kategori_edit').text(kd_kategori);
}
function do_edit(){
  $.ajax({
                      url: "<?= base_url('master/edit_barang')?>",
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
              url: "<?= base_url('master/add_barang')?>",
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