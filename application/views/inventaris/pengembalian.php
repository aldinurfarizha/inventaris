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
              <h5 class="card-title m-0 me-2"><i class="fa fa-handshake"></i> Pengembalian Aset</h5>
                <br>
              <div class="row justify-content-end">
                  <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2"> Pilih Barang</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                     <form id="data" enctype="multipart/form-data" action="<?=base_url('inventaris/do_pengembalian')?>" method="POST">
                  <table id="table"  class="table table-hover table-borderless">
                    <thead>
                      <tr>
                        <th><input style="cursor: pointer;" class="form-check-input" type="checkbox" id="checkall" ></th>
                        <th>#</th>
                        <th>Kd Perkiraan</th>
                        <th>Barang</th>
                        <th>Lokasi</th>
                        <th>Perolehan</th>
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
                        <th class="text-center"><?=@detailOfid($datar->of_id)->nama.' - '.@detailSubOffice($datar->sub_office)->nama?></th>
                        <th><?=$datar->d.'-'.$datar->m.'-'.$datar->y?></th>
                        <th class="text-end"><?=number_format($datar->harga,0,',','.')?></th>
                        <th><small><?=$datar->last_update?></small></th>
                        </tr>
                        <?php $no++; endforeach;?>
                    </tbody>
                  </table>
                </div>
                <br>
                    </div>
                  </div>
                </div>
                <hr>
                 <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                      <label class="form-label">Keterangan</label>
                      <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Ketik disini..." aria-label="With textarea" required></textarea>
                    </div>
                    <div class="form-group">
                    <label class="form-label">Foto Dokumentasi</label>
                    <input type="file" accept="image/*" class="form-control" name="foto">
                    <small>*Foto Barang</small>
                   </div>
                   <div class="form-group">
                    <label class="form-label">Berkas Pendukung</label>
                    <input type="file" class="form-control" accept="application/pdf" name="berkas">
                    <small>*Berita Acara Pengembalian Barang (.pdf)</small>
                   </div>
                    </div>
                  </div>
                </div>
                <hr>
              </div>
              <br>
              <div class="text-center">
                    <button type="button" onclick="hapus()" class="btn btn-md btn-primary">Buat Pengembalian Aset</button>
                </div>
                </form>


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
        function hapus(){
        Swal.fire({
                    title: 'Konfirmasi',
                    text: "Apakah anda sudah yakin dengan aset yang di pilih ? setelah proses ini tidak bisa di kembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya sudah yakin',
                    cancelButtonText: 'Tidak, Saya belum yakin',
                    customClass: {
                      confirmButton: 'btn btn-primary me-1',
                      cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                  }).then(function(result) {
                    if (result.value) {
                      if($('#keterangan').val()==""){
                         alertMessage("Keterangan tidak boleh kosong")
                      }else{
                          $('#data').trigger('submit');
                      }
                    }
                  });
    }



  
  </script>