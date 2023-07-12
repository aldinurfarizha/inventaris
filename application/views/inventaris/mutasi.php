<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h5 class="card-title m-0 me-2"><i class="fa fa-exchange-alt"></i> Mutasi Inventaris Barang</h5>
                <br>
              <div class="row">
                <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Asal Barang</h5>
                    </div>
                    <div class="card-body">
                         <form action="<?=base_url('inventaris/insert_mutasi')?>" method="POST">
                                    <div class="row">
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Kantor</label>
                                      <select class="form-control" name="of_id_penyerah" id="of_id_penyerah">
                                        <option value="">--Pilih kantor--</option>
                                        <?php foreach($kantor as $kan){?>
                                          <option value="<?=$kan->of_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6" id="sub_kantor_option_penyerah">
                                      <label for="defaultFormControlInput" class="form-label">Sub Kantor</label>
                                      <select class="form-control" name="sub_id_penyerah" id="sub_id_penyerah">
                                        <option value="">--Pilih Sub Kantor--</option>
                                        <?php foreach($sub_kantor as $kan){?>
                                          <option value="<?=$kan->sub_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-12">
                                      <div id="loading_inventaris"></div>
                                      <div class="table-responsive text-nowrap">
                                        <table id="table" style="height: 50px;" class="table table-hover table-borderless">
                                          <thead>
                                            <tr>
                                              <th><input style="cursor: pointer;" class="form-check-input" type="checkbox" id="checkall" ></th>
                                              <th>#</th>
                                              <th>Kd Perkiraan</th>
                                              <th>Barang</th>
                                              <th>Perolehan</th>
                                              <th>Satuan</th>
                                              <th>Update Terakhir</th>
                                            </tr>
                                          </thead>
                                          <tbody id="data_inventaris" class="table-border-bottom-0">
                                          </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    </div>     
                    </div>
                  </div>
                </div>
                <hr>
                <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Tujuan</h5>
                    </div>
                    <div class="card-body">
                    <div class="row">
                       <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Kantor</label>
                                      <select class="form-control" name="of_id_penerima" id="of_id_penerima">
                                        <option value="">--Pilih kantor--</option>
                                        <?php foreach($kantor as $kan){?>
                                          <option value="<?=$kan->of_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6" id="sub_kantor_option_penerima">
                                      <label for="defaultFormControlInput" class="form-label">Sub Kantor</label>
                                      <select class="form-control" name="sub_id_penerima" id="sub_id_penerima">
                                        <option value="">--Pilih Sub Kantor--</option>
                                        <?php foreach($sub_kantor as $kan){?>
                                          <option value="<?=$kan->sub_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                    </div>
                    </div>
                  </div>
                </div>
                <hr>
                 <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Informasi Data</h5>
                    </div>
                    <div class="card-body">
                    <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label>Nomor</label>
                        <input type="text" class="form-control" value="<?=getNomorMutasi()?>" name="nomor" readonly>
                      </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" value="<?=date('Y-m-d')?>" readonly>
                      </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label>Yang Menyerahkan <div style="display:inline;" id="loading_penyerah"></div></label>
                        <select name="id_penyerah" class="form-control" id="id_penyerah">
                        </select>
                      </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label>Yang Menerima <div style="display:inline;" id="loading_penerima"></div></label>
                        <select name="id_penerima" class="form-control" id="id_penerima">
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
                  </div>
                </div>
                <hr>
                   <div class="col-md-12">
                      <center><button type="submit" onclick="tambah()" id="add" class="btn btn-primary">Buat Mutasi Barang</button></center>
                   </div>
              </div>
              </form>
<?php $this->load->view('partials/footer')?>
<script>
  $("#checkall").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
  $('#sub_kantor_option_penerima').hide();
  $('#sub_kantor_option_penyerah').hide();
   $('#of_id_penyerah').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      $('#sub_kantor_option_penyerah').hide();
      loadInventaris();
      getPenyerah();
    }else{
      $('#sub_kantor_option_penyerah').show();
    }
});
$('#of_id_penerima').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      $('#sub_kantor_option_penerima').hide();
      getPenerima();
    }else{
      $('#sub_kantor_option_penerima').show();
    }
});
$('#sub_id_penyerah').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!==''){
      loadInventaris();
      getPenyerah();
    }
});
$('#sub_id_penerima').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!==''){
      getPenerima();
    }
});
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
function getPenyerah(){
let of_id=$('#of_id_penyerah').val();
var param;
  if(of_id==1 || of_id=='1'){
  param={
      off_id:of_id,
      dept_id:$('#sub_id_penyerah').val()
    }
  }else{
     param={
      off_id:of_id,
    }
  }
  $.ajax({
              url: "<?= base_url('inventaris/get_employee')?>",
              type: "POST",
              data:param, 
              beforeSend(){
                loadingPenyerah();
              },
              success:function(response){
               UnloadingPenyerah();
               var data=response['data'];
               var html='';
               html+='<option selected="true" value="">--Pilih--</option>';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option value="'+data[i].id+'">'+data[i].nama+' | '+data[i].nik+'</option>';
               }
               $('#id_penyerah').html(html);
              },
              error:function(response){
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: "Gagal Mengambil Data Yang Menyerahkan"
                  }).then(function(){
                    location.reload();
                  })
              }
            });
}
function getPenerima(){
let of_id=$('#of_id_penerima').val();
var param;
  if(of_id==1 || of_id=='1'){
  param={
      off_id:of_id,
      dept_id:$('#sub_id_penerima').val()
    }
  }else{
     param={
      off_id:of_id,
    }
  }
  $.ajax({
              url: "<?= base_url('inventaris/get_employee')?>",
              type: "POST",
              data:param, 
              beforeSend(){
                loadingPenerima();
              },
              success:function(response){
               UnloadingPenerima();
               var data=response['data'];
               var html='';
               html+='<option selected="true" value="">--Pilih--</option>';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option value="'+data[i].id+'">'+data[i].nama+' | '+data[i].nik+'</option>';
               }
               $('#id_penerima').html(html);
              },
              error:function(response){
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: "Gagal Mengambil Data Yang Menerima"
                  }).then(function(){
                    location.reload();
                  })
              }
            });
}
function loadInventaris(){
   $.ajax({
              url: "<?= base_url('inventaris/load_inventaris')?>",
              type: "POST",
              data:{
                of_id:$('#of_id_penyerah').val(),
                sub_id:$('#sub_id_penyerah').val()
              }, 
              beforeSend(){
              loadingInventaris();
              },
              success:function(response){
               UnloadingInventaris();
               var data=response['data'];
               var html='';
               var no=1;
               for (var i = 0; i< response['data'].length; i++) {
                 var barang=data[i].merk+' '+data[i].tipe+' '+data[i].spek;
                 html+='<tr>'+
                 '<td><input style="cursor: pointer;" class="form-check-input" type="checkbox" value="'+data[i].id_inventaris+'" name="item[]"></td>'+
                 '<td>'+no+'</td>'+
                 '<td><span class="badge bg-label-secondary me-1">'+data[i].kd_perkiraan+'</span></td>'+
                 '<td><a target="_blank" href="detail/'+data[i].id_inventaris+'">'+barang.slice(0, 25)+'...</a>'+
                 '<td>'+data[i].y+'-'+data[i].m+'-'+data[i].d+'</td>'+
                 '<td>'+data[i].satuan+'</td>'+
                 '<td>'+data[i].last_update+'</td>'+
                 '</tr>'
                no++;
               }
               $('#data_inventaris').html(html);
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
}

function loadingInventaris(){
  $('#loading_inventaris').html('<br><br><br><br><center><i class=" fa-4x fas fa-circle-notch fa-spin"></i></center>');
}
function UnloadingInventaris(){
  $('#loading_inventaris').html('');
}
function loadingKadivUmum(){
  $('#loading_kadiv_umum').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingKadivUmum(){
  $('#loading_kadiv_umum').html('');
}
function loadingPenerima(){
  $('#loading_penerima').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingPenerima(){
  $('#loading_penerima').html('');
}
function loadingPenyerah(){
  $('#loading_penyerah').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingPenyerah(){
  $('#loading_penyerah').html('');
}
function tambah(){
             $("#add").attr("disabled", true);
        };
</script>