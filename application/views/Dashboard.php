<?php $this->load->view('partials/header')?>
        <div class="layout-page">
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-12">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Selamat Datang, <?=$this->session->userdata('nama')?> 👋</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="<?=base_url()?>assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total Data Inventaris</span>
                          <h3 class="card-title mb-2">172</h3>
                          <small class="text-success fw-semibold"><i class="bx bx-cube-alt"></i> Barang</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="<?=base_url()?>assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span>Inventaris Aktif</span>
                          <h3 class="card-title text-nowrap mb-1">123</h3>
                          <small class="text-success fw-semibold"><i class="bx bx-cube-alt"></i> Barang</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-4 order-1">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="<?=base_url()?>assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="d-block mb-1">Inventaris Tidak Aktif</span>
                          <h3 class="card-title text-nowrap mb-2">60</h3>
                           <small class="text-danger fw-semibold"><i class="bx bx-cube-alt"></i> Barang</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="<?=base_url()?>assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Master Barang</span>
                          <h3 class="card-title mb-2">70</h3>
                         <small class="text-primary fw-semibold"><i class="bx bx-cube-alt"></i> Barang</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 order-0">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Inventaris Statistics</h5>
                        <small class="text-muted">Total Inventaris Terdaftar</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2">8,258</h2>
                          <span>Total Inventaris</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                      </div>
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                              ><i class="bx bx-mobile-alt"></i
                            ></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Electronik</h6>
                              <small class="text-muted">Handphone,Televisi dll</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">125</small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Mebeler</h6>
                              <small class="text-muted">Meja,Kursi dll</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">784</small>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Inventaris Berumur > 5 tahun</h5>
                    </div>
                    <div class="card-body">
                   <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Jenis</th>
                        <th>Merk/Spek</th>
                        <th>Lokasi</th>
                        <th>Perolehan</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>CPU</strong></td>
                        <td>Alcatroz/Core i5</td>
                        <td>Cabang Kuningan-ADM</td>
                        <td><span class="badge bg-label-danger me-1">2018-08-08</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                    </div>
                  </div>
                </div>
              </div>
<?php $this->load->view('partials/footer')?>

           
