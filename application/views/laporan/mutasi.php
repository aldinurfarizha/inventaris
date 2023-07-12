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
                    <a href="<?=base_url('inventaris/mutasi')?>" class="btn btn-primary">
                      <i class="fa fa-plus"></i> Buat Berita Mutasi barang baru
                    </a>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Mutasi barang</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                 <table id="table" class="table table-hover table-borderless table-striped">
                    <thead>
                      <tr>
                        <th>Nomor Mutasi</th>
                        <th>Penyerah</th>
                        <th>Penerima</th>
                        <th>Asal -> Tujuan</th>
                        <th>Jml Barang</th>
                        <th>Tanggal Di buat</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     <?php $no=1; foreach($data as $datar):?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$datar->nama_penyerah?></td>
                          <td><?=$datar->nama_penerima?></td>
                          <td>
                            <?php
                            if($datar->of_id_penyerah==1){
                              $asal=detailOfid($datar->of_id_penyerah)->nama.' '.detailSubOffice($datar->sub_id_penyerah)->nama;
                            }else{
                              $asal=detailOfid($datar->of_id_penyerah)->nama;
                            }
                            if($datar->of_id_penerima==1){
                              $tujuan=detailOfid($datar->of_id_penerima)->nama.' '.detailSubOffice($datar->sub_id_penerima)->nama;
                            }else{
                              $tujuan=detailOfid($datar->of_id_penerima)->nama;
                            }
                            echo $asal.' -> '.$tujuan;
                            ?>
                          </td>
                          <td class="text-center"><span class="badge badge-center rounded-pill bg-secondary"><?=countJumlahBarangMutasi($datar->id_mutasi)?></span></td>
                          <td><?=$datar->tanggal?></td>
                          <td class="text-center">
                            <button type="button" onclick="hapus(<?=$datar->id_mutasi?>)" class="btn btn-sm btn-icon btn-danger">
                              <span class="fa fa-trash"></span>
                              </button>
                              <button type="button" onclick="buka('<?=base_url('laporan/detail_mutasi/').$datar->id_mutasi?>')" class="btn btn-sm btn-primary">
                              <span class="fa fa-file-alt"></span> Detail
                              </button>
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
<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

<script>
       $(document).ready(function(){
        $('#table').DataTable();
    });
     function hapus(id){
            Swal.fire({
                        icon: 'question',
                        title: 'Hapus',
                        text: 'Anda yakin ingin Menghapus Berita Acara Ini ?',
                        showConfirmButton: true,
                        showCancelButton: true,
                        showBackdrop: true,
                        confirmButtonText: 'Ya Hapus',
                        cancelButtonText: 'Tidak'
                    }).then(function(data){
                      if(data.value === true){
                        $.ajax({
                      url: "<?= base_url('laporan/delete_ba')?>",
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
