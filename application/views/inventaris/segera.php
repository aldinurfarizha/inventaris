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
              <h5 class="card-title m-0 me-2"><i class="fa fa-trash"></i> Penghapusan Aset</h5>
                <br>
              <div class="row justify-content-end">
                  <div class="col-md-12">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2"> Segera</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                     <form id="data" action="<?=base_url('inventaris/do_penghapusan')?>" method="POST">
                 
                </div>
                <br>
                    </div>
                  </div>
                </div>
                <hr>
              </div>
                </form>


<?php $this->load->view('partials/footer')?>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
 <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  