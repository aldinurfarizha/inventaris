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
                      <h5 class="card-title m-0 me-2"><i class="menu-icon tf-icons bx bx-printer"></i> Cetak Label</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                     <form target="_blank" action="<?=base_url('cetak/multi_label')?>" method="POST">
                  <table id="table"  class="table table-hover table-borderless">
                    <thead>
                      <tr>
                        <th><input style="cursor: pointer;" class="form-check-input" type="checkbox" id="checkall" ></th>
                        <th>#</th>
                        <th>Kd Perkiraan</th>
                        <th>Barang</th>
                        <th>Perolehan</th>
                        <th>Satuan</th>
                        <th>Harga (Rp.)</th>
                        <th>Update Terakhir</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                       
                      <?php $no=1; foreach($data as $datar):
                      $status=false;
                      $barang=$datar->merk.' '.$datar->tipe.' '.$datar->spek;
                        if($datar->status==1){
                          $status=true;
                        }
                        ?>
                        <tr>
                        <th><input style="cursor: pointer;" class="form-check-input" type="checkbox" value="<?=$datar->id_inventaris?>" name="item[]"></th>
                        <th><?=$no?></th>
                        <th><span class="badge bg-label-secondary me-1"><?=$datar->kd_perkiraan?></span></th>
                        <th><a target="_blank" href="<?=base_url('inventaris/detail/').$datar->id_inventaris?>"><?=limitText($barang)?></a></th>
                        <th><?=$datar->d.'-'.$datar->m.'-'.$datar->y?></th>
                        <th class="text-center"><?=$datar->satuan?></th>
                        <th class="text-end"><?=number_format($datar->harga,0,',','.')?></th>
                        <th><small><?=$datar->last_update?></small></th>
                        </tr>
                        <?php $no++; endforeach;?>
                    </tbody>
                  </table>
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" value="submit" class="btn btn-md btn-primary">Lanjut</button>
                </div>
                </form>
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
        $('#table').DataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });
    $("#checkall").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
  </script>