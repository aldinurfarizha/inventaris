<?php $this->load->view('partials/header')?>
<link rel="stylesheet" href="<?=base_url()?>/assets/vendor/libs/select2/select2.css" />
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-3">
                </div>
                  <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Laporan barang</h5>
                    </div>
                    <div class="card-body">
                        <form id="search" method="POST">
                          <div class="row">
                            <div class="col-sm-3">
                              <label class="form-label">Barang</label>
                              <select name="id_barang" id="id_barang" class="form-control">
                                <option value="">--Semua--</option>
                                  <?php foreach($barang as $bar){?>
                                    <option value="<?=$bar->id_barang?>"><?=$bar->nama_perkiraan.' | '.$bar->merk.' | '.$bar->tipe.' | '.$bar->spek;?></option>
                                  <?php } ?>
                              </select>
                            </div>
                            <div class="col-sm-3">
                              <label class="form-label">Status</label>
                              <select name="status" id="status" class="form-control">
                                <option value="">--Semua--</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                              </select>
                            </div>
                            <div class="col-sm-3">
                              <label class="form-label">Tahun</label>
                              <select name="y" id="y" class="form-control">
                                <option value="">--Semua--</option>
                                 <?php foreach(opt_tahun() as $tahun){?>
                                          <option value="<?=$tahun?>"><?=$tahun?></option>
                                        <?php } ?>
                              </select>
                            </div>
                             <div class="col-sm-3">
                              <label class="form-label">Bulan</label>
                              <select name="m" id="m" class="form-control">
                                <option value="">--Semua--</option>
                                 <?php $no=1; foreach(opt_bulan() as $bulan){?>
                                          <option value="<?=$no?>"><?=$bulan?></option>
                                 <?php $no++; } ?>
                              </select>
                            </div>
                             <div class="col-md-3">
                                      <label class="form-label">Tanggal</label>
                                      <select class="form-control" name="d" >
                                        <option value="">--Semua--</option>
                                        <?php foreach(opt_day() as $day){?>
                                          <option value="<?=$day?>"><?=$day?></option>
                                        <?php } ?>
                                      </select>
                            </div>
                            <div class="col-sm-3">
                              <label class="form-label">Kantor</label>
                              <select name="of_id" id="of_id" class="form-control">
                                <option value="">--Semua--</option>
                                <?php foreach($kantor as $kan){?>
                                  <option value="<?=$kan->of_id?>"><?=$kan->nama;?></option>
                                <?php } ?>
                              </select>
                            </div>
                             <div class="col-sm-3" id="sub_kantor_option">
                                      <label class="form-label">Sub Kantor</label>
                                      <select class="form-control" name="sub_id" id="sub_id">
                                        <option value="">--Semua--</option>
                                        <?php foreach($sub_kantor as $kan){?>
                                          <option value="<?=$kan->sub_id?>"><?=$kan->nama;?></option>
                                        <?php } ?>
                                      </select>
                              </div>
                              <div class="col-md-3">
                                        <div class="form-group">
                                          <label class="form-label">Ruangan KIR <div style="display:inline;" id="loading_ruangan_kir"></div></label>
                                          <select name="id_ruangan_kir" class="form-control" id="id_ruangan_kir">
                                          </select>
                                        </div>
                                      </div>
                          </div>
                            <hr>
                             <div class="row">
                                      <div class="col-md-12">
                                      <div class="text-center">
                                        <button type="submit" formaction="<?=base_url('cetak/barang')?>" class="btn btn-dark">Cetak <i class="fa fa-print"></i></button>
                                        <button type="submit" formaction="<?=base_url('excel/barang')?>"class="btn btn-success">Excel <i class="fa fa-file-excel"></i></button>
                                      </div>
                                    </div>
                                  </div>
                        </form>
                      </div>
                  </div>
                </div>
              </div>

<?php $this->load->view('partials/footer')?>
<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="<?=base_url()?>/assets/vendor/libs/select2/select2.js"></script>
<script>
  $(document).ready(function(){
     $('#sub_kantor_option').hide();
      $("#id_barang").select2({});
    });
    $('#of_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      $('#sub_kantor_option').hide();
      getRuanganKir();
    }else{
      $('#sub_kantor_option').show();
    }
});
 $('#sub_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!==''){
      getRuanganKir();
    }
});
 function loadingRuanganKIR(){
  $('#loading_ruangan_kir').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingRuanganKIR(){
  $('#loading_ruangan_kir').html('');
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
 $('#id_ruangan_kir').html('<option selected="true" value="">--Semua--</option>');
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
                UnloadingRuanganKIR();
              }
            });
}
</script>