<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title><?php
          if (@$title) {
            echo $title . APP_NAME_TITLE;
          } else {
            echo "Sistem Inventaris Barang" . APP_NAME_TITLE;
          }
          ?></title>
  <meta name="description" content="" />
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/demo.css" />
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="<?= base_url('assets/') ?>css/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/libs/sweetalert2/sweetalert2.css">
  <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url() ?>/assets/img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url() ?>/assets/img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url() ?>/assets/img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url() ?>/assets/img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url() ?>/assets/img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url() ?>/assets/img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url() ?>/assets/img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>/assets/img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url() ?>/assets/img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>/assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>/assets/img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= base_url() ?>/assets/img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <script src="<?= base_url() ?>/assets/vendor/js/helpers.js"></script>
  <script src="<?= base_url() ?>/assets/js/config.js"></script>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div style="padding-left: 7rem;" class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img style="width:50px;" src="<?= base_url() . LOGO_PATH ?>" alt="">
            </span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>
        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1">
          <li class="menu-item <?php if ($this->uri->segment('1') == 'dashboard') {
                                  echo "active";
                                } ?>">
            <a href="<?= base_url('dashboard') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Halaman</span>
          </li>
          <li class="menu-item <?php if ($this->uri->segment('1') == 'master') {
                                  echo "active open";
                                } ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
              <div data-i18n="Account Settings">Master</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item <?php if ($this->uri->segment('2') == 'dasar_perkiraan') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('master/dasar_perkiraan') ?>" class="menu-link">
                  <div data-i18n="Account">Dasar Perkiraan</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'perkiraan') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('master/perkiraan') ?>" class="menu-link">
                  <div data-i18n="Account">Perkiraan</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'barang' || $this->uri->segment('2') == 'v_edit_barang') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('master/barang') ?>" class="menu-link">
                  <div data-i18n="Account">Barang</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'ruangan_kir' || $this->uri->segment('2') == 'ruangan_kir_detail' || $this->uri->segment('2') == 'ruangan_kir_pusat') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('master/ruangan_kir') ?>" class="menu-link">
                  <div data-i18n="Account">Master R. KIR</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'kantor') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('master/kantor') ?>" class="menu-link">
                  <div data-i18n="Account">Kantor</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'sub_kantor') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('master/sub_kantor') ?>" class="menu-link">
                  <div data-i18n="Account">Sub Kantor</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item <?php if ($this->uri->segment('1') == 'laporan') {
                                  echo "active open";
                                } ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-file"></i>
              <div data-i18n="Authentications">Laporan</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item <?php if ($this->uri->segment('2') == 'barang') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('laporan/barang') ?>" class="menu-link">
                  <div data-i18n="Basic">Barang</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'pembelian') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('laporan/pembelian') ?>" class="menu-link">
                  <div data-i18n="Basic">Pembelian Barang</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'kartu_inventaris' || $this->uri->segment('2') == 'kartu_inventaris_pusat' || $this->uri->segment('2') == 'kartu_inventaris_list' || $this->uri->segment('2') == 'kartu_inventaris_detail' || $this->uri->segment('2') == 'detail_kir') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('laporan/kartu_inventaris') ?>" class="menu-link">
                  <div data-i18n="Basic">Kartu Inventaris</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'mutasi' || $this->uri->segment('2') == 'detail_mutasi') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('laporan/mutasi') ?>" class="menu-link">
                  <div data-i18n="Basic">Mutasi Barang</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'berita_acara' || $this->uri->segment('2') == 'detail_ba') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('laporan/berita_acara') ?>" class="menu-link">
                  <div data-i18n="Basic">Berita Acara</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'pengembalian' || $this->uri->segment('2') == 'detail_pengembalian') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('laporan/pengembalian') ?>" class="menu-link">
                  <div data-i18n="Basic">Pengembalian</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'penghapusan' || $this->uri->segment('2') == 'detail_penghapusan') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('laporan/penghapusan') ?>" class="menu-link">
                  <div data-i18n="Basic">Penghapusan</div>
                </a>
              </li>

            </ul>
          </li>
          <li class="menu-item <?php if ($this->uri->segment('1') == 'inventaris') {
                                  echo "active open";
                                } ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-cube-alt"></i>
              <div data-i18n="Mics">Inventaris</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item <?php if ($this->uri->segment('2') == 'pilih_kantor' || $this->uri->segment('2') == 'result' || $this->uri->segment('2') == 'detail') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('inventaris/pilih_kantor') ?>" class="menu-link">
                  <div data-i18n="Basic">Data</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'tambah' || $this->uri->segment('2') == 'sukses') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('inventaris/tambah') ?>" class="menu-link">
                  <div data-i18n="Basic">Tambah</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'mutasi') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('inventaris/mutasi') ?>" class="menu-link">
                  <div data-i18n="Basic">Mutasi</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'pengembalian') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('inventaris/pengembalian') ?>" class="menu-link">
                  <div data-i18n="Basic">Pengembalian</div>
                </a>
              </li>
              <li class="menu-item <?php if ($this->uri->segment('2') == 'penghapusan') {
                                      echo "active";
                                    } ?>">
                <a href="<?= base_url('inventaris/penghapusan') ?>" class="menu-link">
                  <div data-i18n="Basic">Penghapusan</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item <?php if ($this->uri->segment('1') == 'cetak') {
                                  echo "active";
                                } ?>">
            <a href="<?= base_url('cetak') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-printer"></i>
              <div data-i18n="Misc">Cetak Label</div>
            </a>
          </li>
          <!-- Components -->
          <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>
          <!-- Cards -->
          <li class="menu-item <?php if ($this->uri->segment('2') == 'profil') {
                                  echo "active";
                                } ?>">
            <a href="<?= base_url('setting/profil') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-collection"></i>
              <div data-i18n="Basic">Profil Perusahaan</div>
            </a>
          </li>
          <li class="menu-item <?php if ($this->uri->segment('2') == 'user') {
                                  echo "active";
                                } ?>">
            <a href="<?= base_url('setting/user') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div data-i18n="Basic">User</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase"><span class="menu-header-text"></span></li>
          <li class="menu-item">
            <a href="#" class="menu-link logout">
              <i class="text-danger menu-icon tf-icons bx bx-power-off"></i>
              <div data-i18n="Basic">Logout</div>
            </a>
          </li>
        </ul>
      </aside>