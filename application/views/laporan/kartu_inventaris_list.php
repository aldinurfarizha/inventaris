<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
      <?php 
      @$office=detailOfid($of_id);
      @$sub_office=detailSubOffice($sub_id);
      ?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                <div class="col-md-3">
                  
                </div>
                  <div class="col-md-12">
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Daftar Ruangan KIR di <?=@$office->nama.' '.@$sub_office->nama?></h5>
                    </div>
                    <div class="card-body">
                  <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Ruangan</th>
                        <th class="text-center">Total Kartu Inventaris</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <tbody class="table-border-bottom-0">
                      <?php $no=1; foreach($data as $datar):?>
                          <tr onclick="buka('<?=base_url('laporan/kartu_inventaris_detail/'.$datar->id_ruangan_kir.'/'.$of_id.'/'.$sub_id)?>')" style="cursor: pointer;">
                          <th><?=$no?></th>
                          <th><?=$datar->nama_ruangan?></th>
                          <th class="text-center"><span class="badge badge-center rounded-pill bg-secondary"><?= count_kartu_inventaris(false,false,$datar->id_ruangan_kir)?></span></th>
                        </tr>
                        <?php $no++; endforeach;?>
                    </tbody>
                    </tbody>
                  </table>
                </div>
                    </div>
                  </div>
                </div>
              </div>
<?php $this->load->view('partials/footer')?>
<script>
 function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus Ruangan KIR Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('master/delete_ruangan_kir')?>",
                      type: "POST",
                      data: {
                          "id_ruangan_kir":id,
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
function edit(id,nama_ruangan){
$('#editModal').modal('show');
$('#id_ruangan_kir').val(id);
$('#nama_ruangan_edit').val(nama_ruangan);
}
function do_edit(){
  $.ajax({
                      url: "<?= base_url('master/edit_ruangan_kir')?>",
                      type: "POST",
                      data: $('#form_edit').serialize(),
                      beforeSend(){
                        loading();
                        $('#editModal').modal('hide');
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
                               $('#editModal').modal('show');
                          })
                      }
                    });
}
function validation(){
    if($('#nama_ruangan').val()==""){
        alertMessage("Nama Ruangan belum di isi !")
        return false;
    }
    return true;
}
function add(){
   if(!validation()){
                return false;
             }
              $.ajax({
              url: "<?= base_url('master/add_ruangan_kir')?>",
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