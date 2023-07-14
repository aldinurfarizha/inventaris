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
                    <a href="<?=base_url('laporan/tambah_berita_acara')?>" class="btn btn-primary">
                      <i class="fa fa-plus"></i> Buat Berita Acara Baru
                    </a>
                    <hr>
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Data Berita Acara</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                 <table id="table" class="table table-hover table-borderless table-striped">
                    <thead>
                      <tr>
                        <th>No. Ba</th>
                        <th>Nama Sub Div RT</th>
                        <th>Nama Pihak Kedua</th>
                        <th>Nama Kadiv Umum</th>
                        <th>Tanggal Di buat</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     <?php $no=1; foreach($data as $datar):?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$datar->sub_div_rt_nama?></td>
                          <td><?=$datar->pihak_kedua_nama?></td>
                          <td><?=$datar->kadiv_umum_nama?></td>
                          <td><?=$datar->tanggal?></td>
                          <td class="text-center">
                            <button type="button" onclick="hapus(<?=$datar->id?>)" class="btn btn-sm btn-icon btn-danger">
                              <span class="fa fa-trash"></span>
                              </button>
                              <button type="button" onclick="buka('<?=base_url('laporan/detail_ba/').$datar->id?>')" class="btn btn-sm btn-primary">
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
