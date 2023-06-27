<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
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
                            <div class="col-sm-3">
                              <label>Barang</label>
                              <select name="master_barang_id" class="form-control">
                                <option value="">--Semua--</option>
                                 <?php foreach($barang as $bar){?>
                                  <option value="<?=$bar->id?>"><?=$bar->nama_barang.' ('.$bar->kd_barang.')';?></option>
                                  <?php } ?>
                              </select>
                            </div>
                            <div class="col-sm-3">
                              <label>Status</label>
                              <select name="status" id="status" class="form-control">
                                <option value="">--Semua--</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                              </select>
                            </div>
                            <div class="col-sm-3">
                              <label>Tahun</label>
                              <select name="y" id="y" class="form-control">
                                <option value="">--Semua--</option>
                                 <?php foreach(opt_tahun() as $tahun){?>
                                          <option value="<?=$tahun?>"><?=$tahun?></option>
                                        <?php } ?>
                              </select>
                            </div>
                             <div class="col-sm-3">
                              <label>Bulan</label>
                              <select name="m" id="m" class="form-control">
                                <option value="">--Semua--</option>
                                 <?php $no=1; foreach(opt_bulan() as $bulan){?>
                                          <option value="<?=$no?>"><?=$bulan?></option>
                                 <?php $no++; } ?>
                              </select>
                            </div>
                             <div class="col-md-3">
                                      <label>Tanggal</label>
                                      <select class="form-control" name="d" >
                                        <option value="">--Semua--</option>
                                        <?php foreach(opt_day() as $day){?>
                                          <option value="<?=$day?>"><?=$day?></option>
                                        <?php } ?>
                                      </select>
                            </div>
                            <div class="col-sm-3">
                              <label>Kantor</label>
                              <select name="of_id" id="of_id_filter" class="form-control">
                                <option value="">--Semua--</option>
                                <?php foreach($kantor as $kan){?>
                                  <option value="<?=$kan->of_id?>"><?=$kan->nama;?></option>
                                <?php } ?>
                              </select>
                            </div>
                             <div class="col-sm-3" id="sub_kantor_filter">
                                      <label>Sub Kantor</label>
                                      <select class="form-control" name="sub_id" id="sub_id_filter">
                                        <option value="">--Semua--</option>
                                        <?php foreach($sub_kantor as $kan){?>
                                          <option value="<?=$kan->sub_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                             <div class="col-sm-3">
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
                        <th>Harga (Rp.)</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=1; foreach($data as $datar):?>
                        <tr>
                          <th><?=$no?></th>
                        <th><?=$datar->nama_barang?></th>
                        <th><?=$datar->d.'-'.$datar->m.'-'.$datar->y?></th>
                        <th><?=$datar->nama_kantor.' '.$datar->nama_sub_kantor?></th>
                        <th><?=$datar->merk?></th>
                        <th><?=$datar->spek?></th>
                        <th class="text-center"><?=$datar->satuan?></th>
                        <th class="text-end"><?=number_format($datar->harga,0,',','.')?></th>
                        <th> <a href="<?=base_url('inventaris/detail/'.$datar->id_barang)?>" type="button" class="btn btn-sm btn-icon btn-primary">
                              <span class="fa fa-search"></span>
                              </a>
                            </th>
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
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                
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
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script>
  $( '#harga' ).mask('000.000.000.000', {reverse: true});
  $('#sub_kantor_option').hide();
  $('#sub_kantor_filter').hide();
   $('#of_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      $('#sub_kantor_option').hide();
    }else{
      $('#sub_kantor_option').show();
    }
});
$('#of_id_filter').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      $('#sub_kantor_filter').hide();
    }else{
      $('#sub_kantor_filter').show();
    }
});
 $('#form_add').trigger("reset");
 function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus Inventaris Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('inventaris/delete_kantor')?>",
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
              url: "<?= base_url('inventaris/add')?>",
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