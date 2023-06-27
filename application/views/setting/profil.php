<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                  <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Profil Perusahaan</h5>
                    </div>
                    <div class="card-body">
                          <form id="form_update">
                           <div class="row">
                            <div class="col-md-12">
                              <div class="text-center">
                                <img style="width: 150px; ;" src="<?=base_url().LOGO_PERUSAHAAN_PATH.@$data->logo?>" alt="">
                              </div>
                              <br>
                            </div>
                             <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">Nama Perusahaan</label>
                              <div class="input-group">
                                <input type="text" class="form-control" aria-label="Username" value="<?=@$data->judul1?>" name="judul1" aria-describedby="basic-addon11">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">Instansi</label>
                              <div class="input-group">
                                <input type="text" class="form-control"  aria-label="Username" value="<?=@$data->judul2?>" name="judul2" aria-describedby="basic-addon11">
                              </div>
                            </div>
                             <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">Alamat</label>
                              <div class="input-group">
                                <input type="text" class="form-control" aria-label="Username" value="<?=@$data->judul3?>" name="judul3" aria-describedby="basic-addon11">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">Kota</label>
                              <div class="input-group">
                                <input type="text" class="form-control"  aria-label="Username" value="<?=@$data->kota?>" name="kota" aria-describedby="basic-addon11">
                              </div>
                            </div>
                             <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">Direktur</label>
                              <div class="input-group">
                                <input type="text" class="form-control" aria-label="Username" value="<?=@$data->direktur?>" name="direktur" aria-describedby="basic-addon11">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">NIK Direktur</label>
                              <div class="input-group">
                                <input type="text" class="form-control"  aria-label="Username" value="<?=@$data->nik_dirut?>" name="nik_dirut" aria-describedby="basic-addon11">
                              </div>
                            </div>
                              <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">Kadiv Umum</label>
                              <div class="input-group">
                                <input type="text" class="form-control" aria-label="Username" value="<?=@$data->kadiv_umum?>" name="kadiv_umum" aria-describedby="basic-addon11">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">NIK Kadiv Umum</label>
                              <div class="input-group">
                                <input type="text" class="form-control"  aria-label="Username" value="<?=@$data->nik_kadiv?>" name="nik_kadiv" aria-describedby="basic-addon11">
                              </div>
                            </div>
                             <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">Pejabat Aset</label>
                              <div class="input-group">
                                <input type="text" class="form-control" aria-label="Username" value="<?=@$data->kasub_logistik?>" name="kasub_logistik" aria-describedby="basic-addon11">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">NIK Aset</label>
                              <div class="input-group">
                                <input type="text" class="form-control"  aria-label="Username" value="<?=@$data->nik_subdiv?>" name="nik_subdiv" aria-describedby="basic-addon11">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">Kasub Rumah Tangga</label>
                              <div class="input-group">
                                <input type="text" class="form-control" aria-label="Username" value="<?=@$data->kasub_rt?>" name="kasub_rt" aria-describedby="basic-addon11">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="defaultFormControlInput" class="form-label">NIK Rumah Tangga</label>
                              <div class="input-group">
                                <input type="text" class="form-control"  aria-label="Username" value="<?=@$data->nik_rt?>" name="nik_rt" aria-describedby="basic-addon11">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <br>
                              <div class="text-center">
                                <button type="button" id="btn_update" onclick="update()" class="btn btn-primary">Update</button>
                              </div>
                            </div>
                           </div>
                          </form>
                    </div>
                  </div>
                </div>
              </div>
<?php $this->load->view('partials/footer')?>
<script>
function update(){
              $.ajax({
              url: "<?= base_url('setting/update_profil')?>",
              type: "POST",
              data:$('#form_update').serialize(), 
              beforeSend(){
              $("#btn_update").attr("disabled", true);
              loading();
              },
              success:function(response){
                $("#btn_update").attr("disabled", false);
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        button: "OK",
                          }).then(function() {
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
                  })
              }
            });
        };
</script>