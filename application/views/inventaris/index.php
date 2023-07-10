<?php $this->load->view('partials/header')?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
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
                  <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Inventaris <?=of_name($of_id)?></h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table id="table" class="table table-hover table-borderless">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kd Perkiraan</th>
                        <th>Barang</th>
                        <th>Perolehan</th>
                        <th>Satuan</th>
                        <th>Harga (Rp.)</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=1;
                      foreach($data as $datar):
                      $status=false;
                        if($datar->status==1){
                          $status=true;
                        }
                        ?>
                        <tr onclick="buka('<?=base_url('inventaris/detail/').$datar->id_inventaris?>')" style="cursor: pointer;">
                          <th><?=$no?></th>
                        <th><span class="badge bg-label-primary me-1"><?=$datar->kd_perkiraan?></span></th>
                        <th><?=$datar->merk.' '.$datar->tipe.' '.$datar->spek?></th>
                        <th><?=$datar->d.'-'.$datar->m.'-'.$datar->y?></th>
                        <th class="text-center"><?=$datar->satuan?></th>
                        <th class="text-end"><?=number_format($datar->harga,0,',','.')?></th>
                        <th class="text-center">
                          <?php if($status):?>
                          <span class="badge rounded-pill bg-label-success">Aktif</span>
                          <?php else:?>
                          <span class="badge rounded-pill bg-label-danger">Non-Aktif</span>
                          <?php endif;?>
                        </th>
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
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
 <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
     
   $(document).ready(function(){
        $('#table').DataTable();
    });
    $(function(){
    $('#form_add').on('submit', function(event){
       event.preventDefault();
       event.stopPropagation();
       add();
    });
});
  $( '#harga' ).mask('000.000.000.000', {reverse: true});
  if($('#of_id').val()==1){
      $('#sub_kantor_option').show();
  }else{
      $('#sub_kantor_option').hide();
  }

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
 $('#form_add').trigger("reset");
 function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus Inventaris Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('inventaris/delete_kantor')?>",
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

function add(){
              $.ajax({
              url: "<?= base_url('inventaris/add')?>",
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