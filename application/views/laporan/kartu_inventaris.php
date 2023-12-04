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
                      <i class="fa fa-plus"></i> Kartu Inventaris
                    </button>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Kartu Inventaris</h5>
                    </div>
                    <div class="card-body">
                  <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Kantor</th>
                        <th class="text-center">Total Kartu Inventaris</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=1; foreach($kantor as $datar):?>
                        <?php if($datar->of_id==1){?>
                          <tr onclick="buka('<?=base_url('laporan/kartu_inventaris_pusat/')?>')" style="cursor: pointer;">
                        <?php }else{?>
                        <tr onclick="buka('<?=base_url('laporan/kartu_inventaris_list/').$datar->of_id?>')" style="cursor: pointer;">
                        <?php } ?>
                          <th><?=$no?></th>
                          <th><?=$datar->nama?></th>
                          <th class="text-center"><span class="badge badge-center rounded-pill bg-secondary"><?= count_kartu_inventaris($datar->of_id)?></span></th>
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
                                <h5 class="modal-title" id="exampleModalLabel1">Buat Kartu Inventaris Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form action="insert_kir" method="POST">
                                    <div class="row">
                                      <div class="col-md-6">
                                      <label>Kantor</label>
                                      <select class="form-control" name="of_id" id="of_id">
                                        <option value="">--Pilih kantor--</option>
                                        <?php foreach($kantor as $kan){?>
                                          <option value="<?=$kan->of_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6" id="sub_kantor_option">
                                      <label>Sub Kantor</label>
                                      <select class="form-control" name="sub_id" id="sub_id">
                                        <option value="">--Pilih Sub Kantor--</option>
                                        <?php foreach($sub_kantor as $kan){?>
                                          <option value="<?=$kan->sub_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Ruangan KIR <div style="display:inline;" id="loading_ruangan_kir"></div></label>
                                          <select name="id_ruangan_kir" class="form-control" id="id_ruangan_kir">
                                          </select>
                                        </div>
                                      </div>
                                       <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Penanggung Jawab <div style="display:inline;" id="loading_penanggung_jawab"></div></label>
                                          <select name="id_penanggung_jawab" class="form-control" id="id_penanggung_jawab">
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Kasub Aset <div style="display:inline;" id="loading_kasub_aset"></div></label>
                                          <select name="id_kasub_aset" class="form-control" id="id_kasub_aset">
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Kadiv Umum <div style="display:inline;" id="loading_kadiv_umum"></div></label>
                                          <select name="id_kadiv_umum" class="form-control" id="id_kadiv_umum">
                                          </select>
                                        </div>
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
<?php $this->load->view('partials/footer')?>
<script>
  $('#sub_kantor_option').hide();
   $('#of_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      $('#sub_kantor_option').hide();
      getPenanggungJawab();
      getRuanganKir();
    }else{
      $('#sub_kantor_option').show();
    }
});
   $('#sub_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!==''){
      getPenanggungJawab();
      getRuanganKir();
    }
});

function loadingKadivUmum(){
  $('#loading_kadiv_umum').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingKadivUmum(){
  $('#loading_kadiv_umum').html('');
}
function loadingKasubAset(){
  $('#loading_kasub_aset').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingKasubAset(){
  $('#loading_kasub_aset').html('');
}
function loadingPenanggungJawab(){
  $('#loading_penanggung_jawab').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingPenanggungJawab(){
  $('#loading_penanggung_jawab').html('');
}
function loadingRuanganKIR(){
  $('#loading_penanggung_jawab').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingRuanganKIR(){
  $('#loading_penanggung_jawab').html('');
}

getKadivUmum();
function getKadivUmum(){
  $.ajax({
              url: "<?= base_url('inventaris/get_employee')?>",
              type: "POST",
              data:{
                off_id:1,
                dept_id:4,
                subdept_id:45,
                occ_id:2
              }, 
              beforeSend(){
                loadingKadivUmum();
              },
              success:function(response){
               UnloadingKadivUmum();
               var data=response['data'];
               var html='';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option selected="true" value="'+data[i].id+'">'+data[i].nama+' | '+data[i].nik+'</option>';
               }
               $('#id_kadiv_umum').html(html);
              },
              error:function(response){
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: "Gagal Mengambil Data Kadiv Umum"
                  }).then(function(){
                    location.reload();
                  })
              }
            });
}
function getRuanganKir(){
let of_id=$('#of_id').val();
var param;
  if(of_id==1 || of_id=='1'){
  param={
      of_id:of_id,
      sub_id:$('#sub_id').val()
    }
  }else{
     param={
      of_id:of_id,
    }
  }
  $.ajax({
              url: "<?= base_url('inventaris/get_ruangan_kir')?>",
              type: "POST",
              data:param, 
              beforeSend(){
                loadingRuanganKIR();
              },
              success:function(response){
               UnloadingRuanganKIR();
               var data=response['data'];
               var html='';
               html+='<option selected="true" value="">--Pilih--</option>';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option value="'+data[i].id_ruangan_kir+'">'+data[i].nama_ruangan+'</option>';
               }
               $('#id_ruangan_kir').html(html);
              },
              error:function(response){
                 Swal.fire({
                    title: 'Belum ada Ruang KIR pada Kantor ini !',
                    text: "Apakah anda ingin menambahkan ruang KIR sekarang",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                    customClass: {
                      confirmButton: 'btn btn-primary me-1',
                      cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                  }).then(function(result) {
                    if (result.value) {
                       location.href = "<?=base_url('master/ruangan_kir')?>";
                    }
                  });
              }
            });
}
function getPenanggungJawab(){
let of_id=$('#of_id').val();
var param;
  if(of_id==1 || of_id=='1'){
  param={
      off_id:of_id,
      dept_id:$('#sub_id').val()
    }
  }else {
            if (of_id > 13) {
              param = {
                of_id: 1,
                dept_id: 7
              }
            } else {
              param = {
                of_id: of_id,
              }
            }
          }
  $.ajax({
              url: "<?= base_url('inventaris/get_employee')?>",
              type: "POST",
              data:param, 
              beforeSend(){
                loadingPenanggungJawab();
              },
              success:function(response){
               UnloadingPenanggungJawab();
               var data=response['data'];
               var html='';
               html+='<option selected="true" value="">--Pilih--</option>';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option value="'+data[i].id+'">'+data[i].nama+' | '+data[i].nik+'</option>';
               }
               $('#id_penanggung_jawab').html(html);
              },
              error:function(response){
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: "Gagal Mengambil Data Penanggung Jawab"
                  }).then(function(){
                    location.reload();
                  })
              }
            });
}
getKasubAset();
function getKasubAset(){
  $.ajax({
              url: "<?= base_url('inventaris/get_employee')?>",
              type: "POST",
              data:{
                off_id:1,
                dept_id:4,
                subdept_id:48,
                occ_id:4
              }, 
              beforeSend(){
                loadingKasubAset();
              },
              success:function(response){
               UnloadingKasubAset();
               var data=response['data'];
               var html='';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option selected="true" value="'+data[i].id+'">'+data[i].nama+' | '+data[i].nik+'</option>';
               }
               $('#id_kasub_aset').html(html);
              },
              error:function(response){
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: "Gagal Mengambil Data Kasub Aset"
                  }).then(function(){
                    location.reload();
                  })
              }
            });
}
function add(){
     $("#add").attr("disabled", true);
        };
</script>