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
                  <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Inventaris <?=of_name($of_id)?></h5>
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                      <i class="fa fa-plus"></i> Inventaris
                    </button>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table id="table" class="table table-hover table-borderless">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Perolehan</th>
                        <th>Lokasi</th>
                        <th>Merk</th>
                        <th>Spek</th>
                        <th>Satuan</th>
                        <th>Status</th>
                        <th>Harga (Rp.)</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=1; foreach($data as $datar):
                      $status=false;
                        if($datar->status==1){
                          $status=true;
                        }
                        ?>
                        <tr onclick="buka('<?=base_url('inventaris/detail/').$datar->id_barang?>')" style="cursor: pointer;">
                          <th><?=$no?></th>
                        <th><span class="badge bg-label-primary me-1"><?=$datar->nama_barang?></span></th>
                        <th><?=$datar->d.'-'.$datar->m.'-'.$datar->y?></th>
                        <th><?=$datar->nama_kantor.' '.$datar->nama_sub_kantor?></th>
                        <th><?=$datar->merk?></th>
                        <th><?=$datar->spek?></th>
                        <th class="text-center"><?=$datar->satuan?></th>
                        <th class="text-center">
                          <?php if($status):?>
                          <span class="badge rounded-pill bg-label-success">Aktif</span>
                          <?php else:?>
                          <span class="badge rounded-pill bg-label-danger">Non-Aktif</span>
                          <?php endif;?>
                        </th>
                        <th class="text-end"><?=number_format($datar->harga,0,',','.')?></th>
                     
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
                                 <form id="form_add" action="" method="POST">
                                    <div class="row">
                                      <div class="col-md-6">
                                         <input type="hidden" value="<?=$this->session->userdata('nama')?>" class="form-control" id="defaultFormControlInput" name="admin" >
                                      <label for="defaultFormControlInput" class="form-label">Barang</label>
                                      <select class="form-control" required name="master_barang_id" id="id_barang">
                                        <option value="">--Pilih Barang--</option>
                                        <?php foreach($barang as $bar){?>
                                          <option value="<?=$bar->id?>"><?=$bar->nama_barang.' ('.$bar->kd_barang.')';?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Kantor</label>
                                      <select class="form-control" required name="of_id" id="of_id">
                                        <option value="<?=$of_id?>" selected><?=of_name($of_id)?></option>
                                        <?php foreach($kantor as $kan){?>
                                          <option value="<?=$kan->of_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <?php if($of_id==1):?>
                                    <div class="col-md-6" id="sub_kantor_option">
                                      <label for="defaultFormControlInput" class="form-label">Sub Kantor</label>
                                      <select class="form-control" name="sub_id" id="sub_id">
                                        <option value="">--Pilih Sub Kantor--</option>
                                        <?php foreach($sub_kantor as $kan){?>
                                          <option value="<?=$kan->sub_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                        <?php endif;?>
                                   
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Tahun perolehan</label>
                                      <select class="form-control" required name="y" id="y">
                                        <option value="">--Pilih Tahun--</option>
                                        <?php foreach(opt_tahun() as $tahun){?>
                                          <option value="<?=$tahun?>"><?=$tahun?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput"  class="form-label">Bulan perolehan</label>
                                      <select class="form-control" name="m" id="m" required>
                                        <option value="">--Pilih Bulan--</option>
                                         <?php $no=0; 
                                          foreach(opt_bulan() as $bulan){
                                                if($bulan!=""){?>
                                            <option value="<?=$no?>"><?=$bulan?></option>
                                                  <?php }?>
                                          <?php $no++; } ?>
                                      </select>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Tanggal perolehan</label>
                                      <select class="form-control" name="d" id="d" required>
                                        <option value="">--Pilih Tanggal--</option>
                                        <?php foreach(opt_day() as $day){?>
                                          <option value="<?=$day?>"><?=$day?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Merk</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="merk" placeholder="misal: Samsung,informa, philips" aria-describedby="defaultFormControlHelp" required>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Spek</label>
                                      <input type="text" class="form-control" id="defaultFormControlInput" name="spek" placeholder="misal: Warna Hitam,Layar 4 inch" aria-describedby="defaultFormControlHelp" required>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Satuan</label>
                                      <select class="form-control" name="satuan" id="satuan" required>
                                        <option value="">--Pilih Satuan--</option>
                                        <?php foreach(opt_satuan() as $satuan){?>
                                          <option value="<?=$satuan?>"><?=$satuan?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Harga</label>
                                      <input type="text" class="form-control" name="harga" id="harga" placeholder="Rp. 0" aria-describedby="defaultFormControlHelp" required>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Status</label>
                                      <select class="form-control" name="status" id="status" required>
                                        <option value="">--Pilih Status--</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                      </select>
                                    </div>
                                    </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Batal
                                </button>
                                <button type="submit" value="submit" class="btn btn-primary">Simpan</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
<?php $this->load->view('partials/footer')?>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
 <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
     
   $(document).ready(function(){
        $('#table').DataTable();
    });
    $(function(){
    $('#form_add').on('submit', function(event){
       event.preventDefault();
       event.stopPropagation();
       add();
    });
});
  $( '#harga' ).mask('000.000.000.000', {reverse: true});
  if($('#of_id').val()==1){
      $('#sub_kantor_option').show();
  }else{
      $('#sub_kantor_option').hide();
  }

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