
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="<?=base_url()?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=base_url()?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url()?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url()?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=base_url()?>/assets/vendor/js/menu.js"></script>
    <script src="<?=base_url()?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="<?=base_url()?>/assets/js/main.js"></script>
    <script src="<?=base_url()?>/assets/js/dashboards-analytics.js"></script>
    <script src="<?=base_url('assets/')?>js/jquery-validation/jquery.validate.min.js"></script>
     <script src="<?=base_url('assets/')?>vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      var loadingeffect='<div style="text-align:center;"><i class="fas fa-2x fa-circle-notch fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>';
      function loading(){
          Swal.fire({
                  title: 'Sedang Proses',
                  html: loadingeffect,
                  showConfirmButton: false,
                  allowEscapeKey: false,
                  allowOutsideClick: false,
                  });
      }
      function alertMessage(message){
      Swal.fire({
                    icon: "warning",
                    title: message,
                    button:"Mengerti",
                    text: "Pastikan semua form terisi."
                  })
      }
      function buka(url){
        window.location.href = url;
    }
      function success(){
        Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        button: "OK",
                          }).then(function() {
                              location.reload();
                            });
              }
       $(".logout").click( function() {
    Swal.fire({
                icon: 'question',
                title: 'PERHATIAN!',
                text: 'Apakah anda ingin Keluar/Log Out sekarang?',
                showConfirmButton: true,
                showCancelButton: true,
                showBackdrop: true,
                confirmButtonText: 'Ya Keluar',
                cancelButtonText: 'Tidak'
            }).then(function(data){
                if(data.value === true){
                    window.location.href = "<?= base_url('auth/logout')?>";
                }
            });
   });
    </script>
  </body>
</html>