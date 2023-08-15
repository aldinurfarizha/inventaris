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
                <div class="col-md-3">
                </div>
                  <div class="col-md-12">
                    <a href="<?=base_url('inventaris/pengembalian')?>" class="btn btn-primary">
                      <i class="fa fa-plus"></i> Buat Pengembalian Aset
                    </a>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Pengembalian Aset</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                 <table id="table" class="table table-hover table-borderless table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">Aksi</th>
                        <th>Keterangan</th>
                        <th>Foto</th>
                        <th>Berkas</th>
                        <th>Jumlah Aset</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     <?php $no=1; foreach($data as $datar):?>
                        <tr>
                           <td class="text-center">
                              <button type="button" onclick="buka('<?=base_url('laporan/detail_pengembalian/').$datar->id_pengembalian?>')" class="btn btn-sm btn-primary">
                              <span class="fa fa-file-alt"></span> Detail
                              </button>
                          </td>
                          <td><?=limitText($datar->keterangan)?></td>
                          <td><img class="img-fluid" style="cursor: zoom-in;" onclick="zoom('<?=base_url().FOTO_PENGEMBALIAN_PATH.$datar->foto?>')" width="50" height="50" src="<?=base_url().FOTO_PENGEMBALIAN_PATH.$datar->foto?>"/></td>
                          <td><a class="btn btn-sm btn-success" href="<?=base_url().BERKAS_PENGEMBALIAN_PATH.$datar->berkas?>">Berkas <i class="fa fa-file-pdf"></i></a></td>
                          <td class="text-center"><span class="badge badge-center rounded-pill bg-secondary"><?=countJumlahBarangPengembalian($datar->id_pengembalian)?></span></td>
                          <td><?=$datar->tanggal?></td>
                         
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
<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

<script>
  function zoom(link){
  window.open(link,'mywin','width=500,height=500');
}
       $(document).ready(function(){
        $('#table').DataTable();
    });
     function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus Laporan Penghapusan Aset',
                        text: 'Barang yang sudah di Hapus tidak dapat kembali ke posisi sebelumnya.',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('laporan/delete_penghapusan')?>",
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
</script>
