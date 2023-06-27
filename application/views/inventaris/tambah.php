<?php $this->load->view('partials/header')?>
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
                                      <div class="col-md-6">
                                         <input type="hidden" value="<?=$this->session->userdata('nama')?>" class="form-control" id="defaultFormControlInput" name="admin" >
                                      <label for="defaultFormControlInput" class="form-label">Barang</label>
                                      <select class="form-control" name="master_barang_id" id="id_barang">
                                        <option value="">--Pilih Barang--</option>
                                        <?php foreach($barang as $bar){?>
                                          <option value="<?=$bar->id?>"><?=$bar->nama_barang.' ('.$bar->kd_barang.')';?></option>
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
                                      <label for="defaultFormControlInput" class="form-label">Merk</label>
                                      <input type="text" class="form-control" id="merk" name="merk" placeholder="misal: Samsung,informa, philips" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Spek</label>
                                      <input type="text" class="form-control" id="spek" name="spek" placeholder="misal: Warna Hitam,Layar 4 inch" aria-describedby="defaultFormControlHelp">
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Satuan</label>
                                      <select class="form-control" name="satuan" id="satuan">
                                        <option value="">--Pilih Satuan--</option>
                                        <?php foreach(opt_satuan() as $satuan){?>
                                          <option value="<?=$satuan?>"><?=$satuan?></option>
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