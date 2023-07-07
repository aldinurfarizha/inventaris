<?php $this->load->view('partials/header')?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?=base_url()?>/assets/vendor/libs/select2/select2.css" />
<style>
  table.dataTable.no-footer {
        border-bottom: 0 !important;
    }
</style>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-3">
                  
                </div>
                  <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                         <form id="form_add">
                              <h4>Edit Master Barang</h4>
                              <hr>
                              <div class="row">
                                <div class="col-md-5">
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Nama Kategori</label>
                                      <select name="id_perkiraan" id="id_perkiraan" class="form-control">
                                        <option value="<?=$data->id_perkiraan?>" selected="true"><?=$data->kd_perkiraan.' | '.$data->nama_perkiraan?></option>
                                        <?php foreach(getPerkiraan() as $perkiraan):?>
                                          <option value="<?=$perkiraan->id_perkiraan?>"><?=$perkiraan->kd_perkiraan.' | '.$perkiraan->nama_perkiraan?></option>
                                        <?php endforeach;?>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                     <div>
                                      <label class="form-label">Merk</label>
                                      <input type="text" hidden name="id_barang" value="<?=$data->id_barang?>">
                                      <input type="text" class="form-control"  name="merk" id="merk" value="<?=@$data->merk?>" placeholder="misal: Samsung, Polytron, Epson" aria-describedby="defaultFormControlHelp">
                                    </div>
                                </div>
                                 <div class="col-md-5">
                                     <div>
                                      <label class="form-label">Tipe</label>
                                      <input type="text" class="form-control"  name="tipe" id="tipe" value="<?=@$data->tipe?>" placeholder="misal: Galaxy A12, Standard, L120" aria-describedby="defaultFormControlHelp">
                                    </div>
                                </div>
                                 <div class="col-md-5">
                                     <div>
                                      <label class="form-label">Spek</label>
                                      <input type="text" class="form-control"  name="spek" id="spek" value="<?=@$data->spek?>" placeholder="misal: Ram 2gb,warna Hitam,Kayu Jati " aria-describedby="defaultFormControlHelp">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                     <div>
                                      <label for="defaultFormControlInput" class="form-label">Satuan</label>
                                      <select class="form-control" name="satuan" id="satuan">
                                        <option value="<?=@$data->satuan?>"><?=@$data->satuan?></option>
                                        <?php foreach(opt_satuan() as $satuan){?>
                                          <option value="<?=$satuan?>"><?=$satuan?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                </div>
                              </div>
                              <hr>
                              <div class="row justify-content-center">
                                <div class="col-md-3">
                                  <button type="button" onclick="edit()" id="add" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                                </div>
                              </div>
                                </form>
                        </div>
                      </div>
                    <hr>
                </div>
              </div>
<?php $this->load->view('partials/footer')?>
<script src="<?=base_url()?>/assets/vendor/libs/select2/select2.js"></script>
<script>

  $(document).ready(function(){
   $("#id_kategori").select2({
       placeholder: "Ketik, untuk Cari dan pilih"
   });
    });




function edit(){
              $.ajax({
              url: "<?= base_url('master/edit_barang')?>",
              type: "POST",
              data:$('#form_add').serialize(), 
              beforeSend(){
              $("#add").attr("disabled", true);
              loading();
              $('#basicModal').modal('hide');
              },
              success:function(response){
                $("#add").attr("disabled", false);
                $('#form_add').trigger("reset");
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        button: "OK",
                          }).then(function() {
                              window.location.replace("<?=base_url('master/barang')?>");
                            });
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