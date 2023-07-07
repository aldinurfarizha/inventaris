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
                          <p class="demo-inline-spacing">
                            <a class="btn btn-secondary me-1 collapsed" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                              Tambah Barang
                            </a>
                          </p>
                          <div class="collapse" id="collapseExample" style="">
                            <form id="form_add">
                              <hr>
                              <div class="row">
                                <div class="col-md-5">
                                    <div>
                                      <label for="defaultFormControlInput" class="form-label">Kode Perkiraan | Nama Barang</label>
                                      <select name="id_perkiraan" id="id_perkiraan" class="form-control">
                                        <option value="" selected="true">--Pilih Perkiraan--</option>
                                        <?php foreach(getPerkiraan() as $perkiraan):?>
                                          <option value="<?=$perkiraan->id_perkiraan?>"><?=$perkiraan->kd_perkiraan.' | '.$perkiraan->nama_perkiraan?></option>
                                        <?php endforeach;?>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                     <div>
                                      <label class="form-label">Merk</label>
                                      <input type="text" class="form-control"  name="merk" id="merk" placeholder="misal: Samsung, Polytron, Epson" aria-describedby="defaultFormControlHelp">
                                    </div>
                                </div>
                                 <div class="col-md-5">
                                     <div>
                                      <label class="form-label">Tipe</label>
                                      <input type="text" class="form-control"  name="tipe" id="tipe" placeholder="misal: Galaxy A12, Standard, L120" aria-describedby="defaultFormControlHelp">
                                    </div>
                                </div>
                                 <div class="col-md-5">
                                     <div>
                                      <label class="form-label">Spek</label>
                                      <input type="text" class="form-control"  name="spek" id="spek" placeholder="misal: Ram 2gb,warna Hitam,Kayu Jati " aria-describedby="defaultFormControlHelp">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                     <div>
                                      <label for="defaultFormControlInput" class="form-label">Satuan</label>
                                      <select class="form-control" name="satuan" id="satuan">
                                        <option value="">--Pilih Satuan--</option>
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
                                  <button type="button" onclick="tambah()" id="add" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Barang</button>
                                </div>
                              </div>
                                </form>
                          </div>
                        </div>
                      </div>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Master Barang</h5>
                      
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table id="table" class="table table-hover table-borderless">
                    <thead>
                      <tr class="text-center">
                        <th>#</th>
                        <th>Perkiraan Dasar</th>
                        <th>Nama Perkiraan</th>
                        <th>Merk</th>
                        <th>Tipe</th>
                        <th>Spek</th>
                        <th>Satuan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     <?php $no=1; foreach($data as $datar):?>
                        <tr>
                          <td><?=$no?></td>
                          <td class="text-center">
                            <?php 
                            if($datar->nama_perkiraan_dasar=="MEUBELAIR"):?>
                            <span class="badge bg-warning"><?=$datar->nama_perkiraan_dasar?></span>
                           <?php else:?>
                            <span class="badge bg-dark"><?=$datar->nama_perkiraan_dasar?></span>
                            <?php endif;?>
                          </td>
                          <td><?=$datar->nama_perkiraan?></td>
                          <td><?=$datar->merk?></td>
                          <td><?=$datar->tipe?></td>
                          <td><?=$datar->spek?></td>
                          <td><?=$datar->satuan?></td>
                          <td class="text-center">
                            <button type="button" onclick="hapus(<?=$datar->id_barang?>)" class="btn btn-sm btn-icon btn-danger">
                              <span class="fa fa-trash"></span>
                              </button>
                             <a href="v_edit_barang/<?=$datar->id_barang?>"  class="btn btn-sm btn-icon btn-success">
                              <span class="fas fa-pencil-alt"></span>
                              </a>
                          </td>
                        </tr>
                      <?php $no++; endforeach;?>
                    </tbody>
                  </table>
                </div>
                    </div>
                  </div>
                </div>
              </div>
<?php $this->load->view('partials/footer')?>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/assets/vendor/libs/select2/select2.js"></script>
<script>

  $(document).ready(function(){
        $('#table').DataTable();
   $("#id_perkiraan").select2({
       placeholder: "Ketik, untuk Cari dan pilih"
   });
    });
 function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus Barang Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('master/delete_barang')?>",
                      type: "POST",
                      data: {
                          "id":id,
                      },
                      beforeSend(){
                        loading();
                      },
                      success:function(response){
                        success();
                      },
                      error:function(response){
                          Swal.fire({
                            icon: "error",
                            title: 'Opps!',
                            button:"Oke",
                            text: response.responseJSON.messages
                          }).then(function(){
                          })
                      }
                    });
                    }
                    });};

function validation(){
    if($('#id_kategori').find(":selected").val()==""){
        alertMessage("Nama Kategori belum di pilih !")
        return false;
    }
  if($('#satuan').find(":selected").val()==""){
        alertMessage("Satuan belum di pilih !")
        return false;
    }
    return true;
}

function tambah(){
              if(!validation()){
                return false;
              }
              $.ajax({
              url: "<?= base_url('master/add_barang')?>",
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
                              location.reload();
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