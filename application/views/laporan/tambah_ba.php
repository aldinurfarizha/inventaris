<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <form action="<?=base_url('laporan/insert_ba')?>" method="POST">
                <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Buat Berita Acara Baru <div id="loading_ba"></div></h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                                  <div class="row">
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
                                   </div>
                                   <hr>
                                   <div class="row">
                                      <div class="col-md-6">
                                        <label for="defaultFormControlInput" class="form-label">Nomor</label>
                                        <input type="text" class="form-control" name="nomor" readonly value="<?=getNomorBA()?>">
                                      </div>
                                      <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Tanggal Surat</label>
                                      <input type="text" value="<?=date('Y-m-d')?>" class="form-control" name="tanggal" readonly>
                                    </div>
                                     <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Kadiv Umum <div style="display:inline;" id="loading_kadiv_umum"></div></label>
                                        <select name="id_kadiv_umum" class="form-control" id="id_kadiv_umum">
                                        </select>
                                      </div>
                                    </div>
                                        <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Pihak Kedua <div style="display:inline;" id="loading_pihak_kedua"></div></label>
                                        <select name="id_pihak_kedua" class="form-control" id="id_pihak_kedua">
                                        </select>
                                      </div>
                                    </div>
                                       <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Kasub RT <div style="display:inline;" id="loading_kasub_rt"></div></label>
                                        <select name="id_kasub_rt" class="form-control" id="id_kasub_rt">
                                        </select>
                                      </div>
                                    </div>
                                    <hr>
                                    </div>
                        </div>
                        <div class="col-md-6">
                           <div id="loading_inventaris"></div>
                                 <div style="height: 300px;" class="table-responsive text-nowrap">
                                     <table id="table"  class="table table-hover table-borderless">
                    <thead>
                      <tr>
                        <th><input style="cursor: pointer;" class="form-check-input" type="checkbox" id="checkall" ></th>
                        <th>#</th>
                        <th>Kd Perkiraan</th>
                        <th>Barang</th>
                        <th>Perolehan</th>
                        <th>Satuan</th>
                        <th>Harga (Rp.)</th>
                        <th>Update Terakhir</th>
                      </tr>
                    </thead>
                     <tbody id="data_inventaris" class="table-border-bottom-0">
                      </tbody>
                  </table>
                                 </div>
                        </div>
                        <div class="col-md-12">
                              <center><button type="submit" id="add" onclick="tambah()" class="btn btn-primary">Buat Berita Acara <i class="fa fa-file"></i></button></center>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             </form>
<?php $this->load->view('partials/footer')?>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script>
       $(document).ready(function(){
        $('#table').DataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });
    $("#checkall").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
  $( '#harga' ).mask('000.000.000.000', {reverse: true});
  $('#sub_kantor_option').hide();
  $('#sub_kantor_filter').hide();
   $('#of_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      //cabang
      $('#sub_kantor_option').hide();
      loadInventaris();
      getPihakKedua();
    }else{
      //pusat
      $('#sub_kantor_option').show();
    }
});

 $('#sub_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!==''){
      loadInventaris();
      getPihakKedua();
    }
});
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
function loadingKasubRT(){
  $('#loading_kasub_rt').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingKasubRT(){
  $('#loading_kasub_rt').html('');
}
function loadingPihakKedua(){
  $('#loading_pihak_kedua').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingPihakKedua(){
  $('#loading_pihak_kedua').html('');
}

getKadivUmum();
getKasubRT();
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
function getKasubRT(){
  $.ajax({
              url: "<?= base_url('inventaris/get_employee')?>",
              type: "POST",
              data:{
                off_id:1,
                dept_id:4,
                subdept_id:91,
                occ_id:4
              }, 
              beforeSend(){
                loadingKasubRT();
              },
              success:function(response){
               UnloadingKasubRT();
               var data=response['data'];
               var html='';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option selected="true" value="'+data[i].id+'">'+data[i].nama+' | '+data[i].nik+'</option>';
               }
               $('#id_kasub_rt').html(html);
              },
              error:function(response){
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: "Gagal Mengambil Data Kasub RT"
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
                of_id:$('#of_id').val(),
                sub_id:$('#sub_id').val()
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
function loadingBa(){
  $('#loading_ba').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingBa(){
  $('#loading_ba').html('');
}

function getPihakKedua(){
let of_id=$('#of_id').val();
var param;
  if(of_id==1 || of_id=='1'){
  param={
      off_id:of_id,
      dept_id:$('#sub_id').val()
    }
  }else if(of_id=='14'||of_id=='15'||of_id=='16'||of_id=='17'||of_id=='18'||of_id=='19'){
  param={
        off_id:1,
        dept_id:7
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
                loadingPihakKedua();
              },
              success:function(response){
               UnloadingPihakKedua();
               var data=response['data'];
               var html='';
               html+='<option selected="true" value="">--Pilih Kadiv/Kacab--</option>';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option value="'+data[i].id+'">'+data[i].nama+' | '+data[i].nik+' | '+data[i].jabatan+'</option>';
               }
               $('#id_pihak_kedua').html(html);
              },
              error:function(response){
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: "Gagal Mengambil Data Pihak Kedua"
                  }).then(function(){
                    location.reload();
                  })
              }
            });
}


function tambah(){
             $("#add").attr("disabled", true);
        };
</script>