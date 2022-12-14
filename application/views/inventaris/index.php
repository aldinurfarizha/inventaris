<?php $this->load->view('partials/header')?>

 <div class="layout-page">
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                  <div class="col-md-12">
                     <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Filter Data</h5>
                    </div>
                      <div class="card-body">
                        <form id="search">
                          <div class="row">
                            <div class="col-sm-4">
                              <label>Barang</label>
                              <select name="barang" id="barang" class="form-control">
                                <option value="">--Semua--</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <label>Lokasi</label>
                              <select name="lokasi" id="lokasi" class="form-control">
                                <option value="">--Semua--</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <label>Status</label>
                              <select name="status" id="status" class="form-control">
                                <option value="">--Semua--</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <label>Tahun</label>
                              <select name="y" id="y" class="form-control">
                                <option value="">--Semua--</option>
                              </select>
                            </div>
                             <div class="col-sm-4">
                              <label>Bulan</label>
                              <select name="m" id="m" class="form-control">
                                <option value="">--Semua--</option>
                              </select>
                            </div>
                             <div class="col-sm-4">
                              <br>
                                <button id="filter" onclick="filter()" class="btn btn-primary form-control"><i class="fa fa-search"></i> Tampilkan</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                   
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Inventaris</h5>
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                      <i class="fa fa-plus"></i> Inventaris
                    </button>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Perolehan</th>
                        <th>Lokasi</th>
                        <th>Merk</th>
                        <th>Spek</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
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
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="form_add">
                                    <div class="row">
                                        <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Barang</label>
                                      <select class="form-control" name="id_barang" id="id_barang">
                                        <option value="">--Pilih Barang--</option>
                                        <?php foreach($barang as $bar){?>
                                          <option value="<?=$bar->id?>"><?=$bar->nama_barang.' ('.$bar->kd_barang.')';?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Kantor</label>
                                      <select class="form-control" name="of_id" id="of_id">
                                        <option value="">--Pilih kantor--</option>
                                        <?php foreach($kantor as $kan){?>
                                          <option value="<?=$kan->of_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6" id="sub_kantor_option">
                                      <label for="defaultFormControlInput" class="form-label">Sub Kantor</label>
                                      <select class="form-control" name="sub_id" id="sub_id">
                                        <option value="">--Pilih Sub Kantor--</option>
                                        <?php foreach($sub_kantor as $kan){?>
                                          <option value="<?=$kan->sub_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Tahun perolehan</label>
                                      <select class="form-control" name="y" id="y">
                                        <option value="">--Pilih Tahun--</option>
                                        <?php foreach(opt_tahun() as $tahun){?>
                                          <option value="<?=$tahun?>"><?=$tahun?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Bulan perolehan</label>
                                      <select class="form-control" name="m" id="m">
                                        <option value="">--Pilih Bulan--</option>
                                        <?php $no=1; foreach(opt_bulan() as $bulan){?>
                                          <option value="<?=$no?>"><?=$bulan?></option>
                                        <?php $no++; } ?>
                                      </select>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Merk</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="merk" placeholder="misal: Samsung" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Spek</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="spek" placeholder="misal: Warna Hitam,Layar 4 inch" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Satuan</label>
                                      <select class="form-control" name="satuan" id="satuan">
                                        <option value="">--Pilih Satuan--</option>
                                        <?php foreach(opt_satuan() as $satuan){?>
                                          <option value="<?=$satuan?>"><?=$satuan?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Harga</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="harga" placeholder="misal: Warna Hitam,Layar 4 inch" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Status</label>
                                      <select class="form-control" name="status" id="status">
                                        <option value="">--Pilih Status--</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                      </select>
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
<?php $this->load->view('partials/footer')?>
<script>
  $('#sub_kantor_option').hide();
   $('#of_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      $('#sub_kantor_option').hide();
    }else{
      $('#sub_kantor_option').show();
    }
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

function add(){
              $.ajax({
              url: "<?= base_url('inventaris/add_barang')?>",
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