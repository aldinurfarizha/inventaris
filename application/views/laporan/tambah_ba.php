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
                                        <label for="defaultFormControlInput" class="form-label">Nama Kadiv Umum</label>
                                        <input type="text" class="form-control" name="kadiv_umum" readonly value="<?=$info_perusahaan->kadiv_umum?>">
                                      </div>
                                      <div class="col-md-6">
                                          <label for="defaultFormControlInput" class="form-label">NIK Kadiv Umum</label>
                                          <input type="text" class="form-control" name="nik_kadiv" readonly value="<?=$info_perusahaan->nik_kadiv?>">
                                        </div>
                                        <div class="col-md-6">
                                        <label for="defaultFormControlInput" class="form-label">Nama Pihak Kedua</label>
                                        <input type="text" class="form-control" name="pihak_kedua" id="pihak_kedua" readonly value="">
                                      </div>
                                      <div class="col-md-6">
                                          <label for="defaultFormControlInput" class="form-label">NIK Pihak Kedua</label>
                                          <input type="text" class="form-control" name="nik_kedua" id="nik_kedua" readonly value="">
                                        </div>
                                       <div class="col-md-6">
                                        <label for="defaultFormControlInput" class="form-label">Nama Kasub RT</label>
                                        <input type="text" class="form-control" name="kasub_rt" readonly value="<?=$info_perusahaan->kasub_rt?>">
                                      </div>
                                      <div class="col-md-6">
                                          <label for="defaultFormControlInput" class="form-label">NIK Kasub RT</label>
                                          <input type="text" class="form-control" name="nik_rt" readonly value="<?=$info_perusahaan->nik_rt?>">
                                        </div>
                                    <hr>
                                    </div>
                        </div>
                        <div class="col-md-6">
                                 <div style="height: 500px;" class="table-responsive text-nowrap">
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
                    <tbody class="table-border-bottom-0">
                       
                      <?php $no=1; foreach($data as $datar):
                      $status=false;
                        if($datar->status==1){
                          $status=true;
                        }
                        $barang=$datar->merk.' '.$datar->tipe.' '.$datar->spek;
                        ?>
                        <tr>
                        <th><input style="cursor: pointer;" class="form-check-input" type="checkbox" value="<?=$datar->id_inventaris?>" name="item[]"></th>
                        <th><?=$no?></th>
                        <th><span class="badge bg-label-secondary me-1"><?=$datar->kd_perkiraan?></span></th>
                        <th><a target="_blank" href="<?=base_url('inventaris/detail/').$datar->id_inventaris?>"><?=limitText($barang)?></a></th>
                        <th><?=$datar->d.'-'.$datar->m.'-'.$datar->y?></th>
                        <th class="text-center"><?=$datar->satuan?></th>
                        <th class="text-end"><?=number_format($datar->harga,0,',','.')?></th>
                        <th><small><?=$datar->last_update?></small></th>
                        </tr>
                        <?php $no++; endforeach;?>
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
      fillPihakKedua(valueSelected,99);
    }else{
      //pusat
      $('#sub_kantor_option').show();
    }
});

 $('#sub_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!==''){
      fillPihakKedua(1,valueSelected);
    }
});
function loadingBa(){
  $('#loading_ba').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingBa(){
  $('#loading_ba').html('');
}

function fillPihakKedua(of_id,sub_id){
$.ajax({
              url: "<?= base_url('laporan/get_pihak_kedua')?>",
              type: "POST",
              data:{
                "of_id":of_id,
                "sub_id":sub_id
              },
              beforeSend(){
              loadingBa();
              },
              success:function(response){
               UnloadingBa();
              $('#pihak_kedua').val(response.kepala);
               $('#nik_kedua').val(response.nik);
              },
            });
}


function tambah(){
             $("#add").attr("disabled", true);
        };
</script>