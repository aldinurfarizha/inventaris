<?php $this->load->view('partials/header')?>
<link rel="stylesheet" href="<?=base_url()?>/assets/vendor/libs/select2/select2.css" />
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Tambah Inventaris Barang</h5>
                    </div>
                    <div class="card-body">
                         <form id="form_add">
                                    <div class="row">
                                      <div class="col-md-12">
                                         <input type="hidden" value="<?=$this->session->userdata('nama')?>" class="form-control" id="defaultFormControlInput" name="admin" >
                                      <label for="defaultFormControlInput" class="form-label">Barang ( Kd perkiraan | Nama Perkiraan Dasar | Nama Perkiraan | Merk | Tipe | Spek)</label>
                                      <select class="form-control" name="id_barang" id="id_barang">
                                        <option value="">--Pilih Barang--</option>
                                        <?php foreach($barang as $bar){?>
                                          <option value="<?=$bar->id_barang?>"><?=$bar->kd_perkiraan.' | '.$bar->nama_perkiraan_dasar.' | '.$bar->nama_perkiraan.' | '.$bar->merk.' | '.$bar->tipe.' | '.$bar->spek;?></option>
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
                                        <div class="form-group">
                                          <label class="form-label">Ruangan KIR <div style="display:inline;" id="loading_ruangan_kir"></div></label>
                                          <select name="id_ruangan_kir" class="form-control" id="id_ruangan_kir">
                                          </select>
                                        </div>
                                      </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Tahun perolehan</label>
                                      <input type="number" class="form-control" placeholder="Misal :<?=date('Y')?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="y" id="y">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Bulan perolehan</label>
                                      <select class="form-control" name="m" id="m">
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
                                      <select class="form-control" name="d" id="d">
                                        <option value="">--Pilih Tanggal--</option>
                                        <?php foreach(opt_day() as $day){?>
                                          <option value="<?=$day?>"><?=$day?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Harga (Rp.)</label>
                                      <input type="text" class="form-control" name="harga" id="harga" placeholder="Rp. 0" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Status</label>
                                      <select class="form-control" name="status" id="status">
                                        <option value="">--Pilih Status--</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                      </select>
                                    </div>
                                    <hr>
                                        <div class="col-md-12">
                                              <center><button type="button" onclick="tambah()" id="add" class="btn btn-primary">Simpan</button></center>
                                        </div>
                                    </div>
                                </form>
                    </div>
                  </div>
                </div>
              </div>
<?php $this->load->view('partials/footer')?>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script src="<?=base_url()?>/assets/vendor/libs/select2/select2.js"></script>
<script>
    $(document).ready(function(){
   $("#id_barang").select2({
       placeholder: "Ketik, untuk Cari dan pilih"
   });
    });
  $( '#harga' ).mask('000.000.000.000', {reverse: true});
  $('#sub_kantor_option').hide();
  $('#sub_kantor_filter').hide();
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
  $('#loading_penanggung_jawab').html('<i class="fas fa-circle-notch fa-spin"></i>');
}
function UnloadingRuanganKIR(){
  $('#loading_penanggung_jawab').html('');
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
 $('#id_ruangan_kir').html('<option selected="true" value="">--Kosong--</option>');
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
function validation(){
    if($('#id_barang').find(":selected").val()==""){
        alertMessage("Barang belum di pilih !")
        return false;
    }
    if($('#of_id').find(":selected").val()==""){
        alertMessage("Kantor belum di pilih !")
        return false;
    }
    if($('#of_id').find(":selected").val()==1 && $('#sub_id').find(":selected").val()==""){
        alertMessage("Sub Kantor belum di pilih !")
        return false;
    }
    if($('#id_ruangan_kir').find(":selected").val()==""){
        alertMessage("Ruangan KIR belum di pilih !")
        return false;
    }
    if($('#y').val()==""){
        alertMessage("Tahun Perolehan belum di isi !")
        return false;
    }
    if($('#m').find(":selected").val()==""){
        alertMessage("Bulan Perolehan belum di pilih !")
        return false;
    }
    if($('#d').find(":selected").val()==""){
        alertMessage("Tanggal Perolehan belum di pilih !")
        return false;
    }
    if($('#harga').val()==""){
        alertMessage("Harga belum di isi !")
        return false;
    }
    if($('#status').find(":selected").val()==""){
        alertMessage("Status belum di pilih !")
        return false;
    }
    return true;
}

function tambah(){
             if(!validation()){
                return false;
             }
              $.ajax({
              url: "<?= base_url('inventaris/add')?>",
              type: "POST",
              data:$('#form_add').serialize(), 
              beforeSend(){
              $("#add").attr("disabled", true);
              loading();
              },
              success:function(response){
               location.href = "<?=base_url('inventaris/sukses/')?>"+response.id;
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