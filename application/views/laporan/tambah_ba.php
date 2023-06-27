<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <form id="form_add">
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

                        </div>
                        <div class="col-md-12">
                                              <center><button type="button" onclick="tambah()" id="add" class="btn btn-primary">Buat Berita Acara <i class="fa fa-file"></i></button></center>
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
    if($('#merk').val()==""){
        alertMessage("Merk belum di isi !")
        return false;
    }
    if($('#spek').val()==""){
        alertMessage("Spek belum di isi !")
        return false;
    }
    if($('#satuan').find(":selected").val()==""){
        alertMessage("Satuan belum di pilih !")
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