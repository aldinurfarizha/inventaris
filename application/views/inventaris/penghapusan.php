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
              <h5 class="card-title m-0 me-2"><i class="fa fa-trash"></i> Penghapusan Aset</h5>
                <br>
              <div class="row justify-content-end">
                  <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2"> Pilih Barang</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                     <form id="data" action="<?=base_url('inventaris/do_penghapusan')?>" method="POST">
                  <table id="table"  class="table table-hover table-borderless">
                    <thead>
                      <tr>
                        <th><input style="cursor: pointer;" class="form-check-input" type="checkbox" id="checkall" ></th>
                        <th>#</th>
                        <th>Kd Perkiraan</th>
                        <th>Barang</th>
                        <th>Lokasi</th>
                        <th>Perolehan</th>
                        <th>Harga (Rp.)</th>
                        <th>Update Terakhir</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                       
                      <?php $no=1; foreach($data as $datar):
                      $status=false;
                      $barang=$datar->merk.' '.$datar->tipe.' '.$datar->spek;
                        if($datar->status==1){
                          $status=true;
                        }
                        ?>
                        <tr>
                        <th><input style="cursor: pointer;" class="form-check-input" type="checkbox" value="<?=$datar->id_inventaris?>" name="item[]"></th>
                        <th><?=$no?></th>
                        <th><span class="badge bg-label-secondary me-1"><?=$datar->kd_perkiraan?></span></th>
                        <th><a target="_blank" href="<?=base_url('inventaris/detail/').$datar->id_inventaris?>"><?=limitText($barang)?></a></th>
                        <th class="text-center"><?=@detailOfid($datar->of_id)->nama.' - '.@detailSubOffice($datar->sub_office)->nama?></th>
                        <th><?=$datar->d.'-'.$datar->m.'-'.$datar->y?></th>
                        <th class="text-end"><?=number_format($datar->harga,0,',','.')?></th>
                        <th><small><?=$datar->last_update?></small></th>
                        </tr>
                        <?php $no++; endforeach;?>
                    </tbody>
                  </table>
                </div>
                <br>
                    </div>
                  </div>
                </div>
                <hr>
                 <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2"> Tujuan, Alasan dan Cara penghapusan aset</h5>
                    </div>
                    <div class="card-body">
                    <textarea class="form-control" name="alasan" id="alasan" placeholder="Ketik disini..." aria-label="With textarea" required></textarea>
                    </div>
                  </div>
                </div>
                <hr>
                 <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2"> Yang Bertanda tangan</h5>
                      <p>Nomor Surat:<?=getNomorPenghapusan()?></p>
                    </div>
                    <div class="card-body">
                    <div class="row">
                       <div class="col-md-6">
                                        <div class="form-group">
                                          <input type="hidden" class="form-control" value="<?=getNomorPenghapusan()?>" name="nomor" readonly>
                                          <label>Kasub Aset <div style="display:inline;" id="loading_kasub_aset"></div></label>
                                          <select name="id_kasub_aset" class="form-control" id="id_kasub_aset" readonly>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Kadiv Umum <div style="display:inline;" id="loading_kadiv_umum"></div></label>
                                          <select name="id_kadiv_umum" class="form-control" id="id_kadiv_umum" readonly>
                                          </select>
                                        </div>
                                      </div>
                                       <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Kadiv SPI <div style="display:inline;" id="loading_kadiv_spi"></div></label>
                                          <select name="id_kadiv_spi" class="form-control" id="id_kadiv_spi" readonly>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Direktur <div style="display:inline;" id="loading_kadiv_umum"></div></label>
                                          <select class="form-control" readonly>
                                            <option><?=infoPerusahaan()->direktur.' | '.infoPerusahaan()->nik_dirut?></option>
                                          </select>
                                        </div>
                                      </div>
                    </div>
                    
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="text-center">
                    <button type="button" onclick="hapus()" class="btn btn-md btn-primary">Buat Penghapusan ASET</button>
                </div>
                </form>


<?php $this->load->view('partials/footer')?>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
 <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
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
        function hapus(){
        Swal.fire({
                    title: 'Konfirmasi',
                    text: "Apakah anda sudah yakin dengan aset yang di pilih ? setelah proses ini tidak bisa di kembalikan dan berita penghapusan aset akan terbit.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya sudah yakin',
                    cancelButtonText: 'Tidak, Saya belum yakin',
                    customClass: {
                      confirmButton: 'btn btn-primary me-1',
                      cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                  }).then(function(result) {
                    if (result.value) {
                      if($('#alasan').val()==""){
                         alertMessage("Alasan tidak boleh kosong")
                      }else{
                          $('#data').trigger('submit');
                      }
                    }
                  });
    }
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
function loadingKadivSPI(){
  $('#loading_kadiv_spi').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingKadivSPI(){
  $('#loading_kadiv_spi').html('');
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
getKadivSPI();
function getKadivSPI(){
  $.ajax({
              url: "<?= base_url('inventaris/get_employee')?>",
              type: "POST",
              data:{
                off_id:1,
                dept_id:2,
                subdept_id:39,
                occ_id:2
              }, 
              beforeSend(){
                loadingKadivSPI();
              },
              success:function(response){
               UnloadingKadivSPI();
               var data=response['data'];
               var html='';
               for (var i = 0; i< response['data'].length; i++) {
                 html+='<option selected="true" value="'+data[i].id+'">'+data[i].nama+' | '+data[i].nik+'</option>';
               }
               $('#id_kadiv_spi').html(html);
              },
              error:function(response){
                  Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button:"Oke",
                    text: "Gagal Mengambil Data Kadiv SPI"
                  }).then(function(){
                    location.reload();
                  })
              }
            });
}
  </script>