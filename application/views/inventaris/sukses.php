<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-center">
                <div class="col-md-9">
                  <div class="card h-100">
                    <div class="alert alert-success" role="alert">
                 <i class="fa fa-check-circle"></i> <b>Inventaris Baru Berhasil Di tambahakan.</b> 
              </div>
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Detail Inventaris (ID:<?=$data->id_barang?>)</h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                         <div class="col-md-12">
                              <div class="text-center">
                                <?php
                                if($data->foto_barang!=null){
                                  $image=base_url().FOTO_BARANG_PATH.$data->foto_barang;
                                  ?>
                                  <?php
                                }else{
                                  $image=base_url().NO_IMAGE;
                                }
                                ?>
                                <center><img style="width: 150px; cursor: zoom-in;" class="d-block rounded" src="<?=$image?>" onclick="zoom('<?=$image?>')"  alt=""></center>
                                <br>
                                <button class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#basicModal">Ganti/Upload Foto</button>
                              </div>
                              <br>
                            </div>
                        <div class="col-md-6">
                          <form id="data_barang" name="data_barang" method="POST" action="<?=base_url('inventaris/update_inventaris')?>">
                          <input type="hidden" value="<?=$this->session->userdata('nama')?>" class="form-control" id="defaultFormControlInput" name="admin" >
                          <input type="hidden" value="<?=$data->id_inventaris?>"  name="id_inventaris" readonly>
                          <label for="defaultFormControlInput" class="form-label">Barang</label>
                          <select class="form-control" name="master_barang_id" readonly>
                            <option selected="true" value="<?=$data->id_barang?>"><?=$data->kd_perkiraan.' | '.$data->nama_perkiraan?></option>
                          </select>
                        </div>
                         <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Kantor</label>
                            <select class="form-control" name="of_id" id="of_id" readonly>
                              <option value="<?=$data->of_id?>"><?=$data->nama_kantor?></option>
                              <?php foreach($kantor as $kan){?>
                                <option value="<?=$kan->of_id?>"><?=$kan->nama;?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php if($data->is_pusat==1){?>
                                    <div class="col-md-6" id="sub_kantor_option">
                                    <label for="defaultFormControlInput" class="form-label">Sub Kantor</label>
                                    <select class="form-control" name="sub_id" id="sub_id" readonly>
                                        <option selected="true" value="<?=$data->sub_id?>"><?=$data->nama_sub_kantor?></option>
                                      <?php foreach($sub_kantor as $kan){?>
                                        <option value="<?=$kan->sub_id?>"><?=$kan->nama;?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <?php } ?>
                          <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Tahun perolehan</label>
                            <select class="form-control" name="y" id="y" readonly>
                              <option selected="true" value="<?=$data->y?>"><?=$data->y?></option>
                              <?php foreach(opt_tahun() as $tahun){?>
                                <option value="<?=$tahun?>"><?=$tahun?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Bulan perolehan</label>
                            <select class="form-control" name="m" id="m" readonly>
                              <option selected="true" value="<?=$data->m?>"><?=opt_bulan()[$data->m]?></option>
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
                            <select class="form-control" name="d" id="d" readonly>
                              <option selected="true" value="<?=$data->d?>"><?=$data->d?></option>
                              <?php foreach(opt_day() as $day){?>
                                <option value="<?=$day?>"><?=$day?></option>
                              <?php } ?>
                            </select>
                          </div>
                           <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Merk</label>
                                      <input type="text" value="<?=$data->merk?>" class="form-control" id="defaultFormControlInput" name="merk" placeholder="misal: Samsung,informa, philips" aria-describedby="defaultFormControlHelp" readonly>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Spek</label>
                                      <input type="text" value="<?=$data->spek?>" class="form-control" id="defaultFormControlInput" name="spek" placeholder="misal: Warna Hitam,Layar 4 inch" aria-describedby="defaultFormControlHelp" readonly>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Satuan</label>
                                      <select class="form-control" name="satuan" id="satuan" readonly>
                                        <option selected="true" value="<?=$data->satuan?>"><?=$data->satuan?></option>
                                        <?php foreach(opt_satuan() as $satuan){?>
                                          <option value="<?=$satuan?>"><?=$satuan?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Harga (Rp.)</label>
                                      <input type="text" class="form-control" value="<?=$data->harga?>" name="harga" id="harga" placeholder="Rp. 0" aria-describedby="defaultFormControlHelp" readonly>
                                    </div>
                                     <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Status</label>
                                      <select class="form-control" name="status" id="status" readonly>
                                        <?php
                                          if($data->status){?>
                                            <option selected="true" value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                          <?php }else{?>
                                            <option selected="true" value="0">Tidak Aktif</option>
                                            <option value="1">Aktif</option>
                                          <?php }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="defaultFormControlInput" class="form-label">Terakhir di perbaharui</label>
                                      <input type="text" value="<?=$data->last_update?>" class="form-control" id="defaultFormControlInput" readonly>
                                    </div>
                                    <br>
                                    </form>
                                    <hr style="margin-top: 10px;">
                                    <div class="row">
                                      <div class="col-md-12">
                                      <div class="text-center">
                                        <a href="<?=base_url('cetak/single_label/'.$id)?>" target="_blank" class="btn btn-dark">Cetak Label <i class="fa fa-qrcode"></i></a>
                                        <a href="<?=base_url('inventaris/detail/'.$id)?>" class="btn btn-primary">Edit Data <i class="fa fa-edit"></i></a>
                                      </div>
                                    </div>
                                  </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Ganti / Upload Foto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form id="upload_foto" enctype="multipart/form-data" action="<?=base_url('inventaris/upload_foto')?>">
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">File Foto</label>
                                         <input type="hidden" value="<?=$data->id_barang?>"  name="id" >
                                        <input type="file" class="form-control" accept="image/*" name="file">
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Batal
                                </button>
                                <button type="submit" id="upload_btn" class="btn btn-primary">Upload</button>
                                 </form>
                              </div>
                            </div>
                          </div>
                        </div>
<?php $this->load->view('partials/footer')?>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script>
  $( '#harga' ).mask('000.000.000.000', {reverse: true});
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
function zoom(link){
  window.open(link,'mywin','width=500,height=500');
}
$('#of_id_filter').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected!=='1'){
      $('#sub_kantor_filter').hide();
    }else{
      $('#sub_kantor_filter').show();
    }
});

 $('#upload_foto').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                success();
            },
            beforeSend(){
              $("#upload_btn").attr("disabled", true);
              $('#basicModal').modal('hide');
              loading();
              },
        });
    }));
function update(){
              $.ajax({
              url: "<?= base_url('inventaris/update_inventaris')?>",
              type: "POST",
              data:$('#data_barang').serialize(), 
              beforeSend(){
              $("#btn_update_barang").attr("disabled", true);
              loading();
              $('#basicModal').modal('hide');
              },
              success:function(response){
                $("#btn_update_barang").attr("disabled", false);
                $('#data_barang').trigger("reset");
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        button: "OK",
                          }).then(function() {
                              location.reload();
                            });
              },
              error:function(response){
                $("#btn_update_barang").attr("disabled", false);
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