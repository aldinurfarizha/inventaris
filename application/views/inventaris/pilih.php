<?php $this->load->view('partials/header')?>
 <div class="layout-page">
      <?php $this->load->view('partials/navbar')?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row justify-content-end">
                  <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Pilih Kantor</h5>
                      </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Kantor</th>
                        <th class="text-center">Total Inventaris Aktif</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=1; foreach($kantor as $datar):?>
                        <tr onclick="buka('<?=base_url('inventaris/result/').$datar->of_id?>')" style="cursor: pointer;">
                          <th><?=$no?></th>
                          <th><span class="badge bg-label-primary"><?=$datar->nama?></span></th>
                          <th class="text-center"><span class="badge badge-center rounded-pill bg-secondary"><?= count_invent($datar->of_id)?></span></th>
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
<script>
    function buka(url){
        window.location.href = url;
    }
</script>