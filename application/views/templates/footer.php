  <!--begin::Footer-->
  <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
      <!--begin::Container-->
      <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
          <!--begin::Copyright-->
          <div class="text-dark order-2 order-md-1">
              <span class="text-muted fw-bold me-1">2021©</span>
              <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
          </div>
          <!--end::Copyright-->
          <!--begin::Menu-->
          <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
              <li class="menu-item">
                  <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
              </li>
              <li class="menu-item">
                  <a href="https://keenthemes.com/support" target="_blank" class="menu-link px-2">Support</a>
              </li>
              <li class="menu-item">
                  <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
              </li>
          </ul>
          <!--end::Menu-->
      </div>
      <!--end::Container-->
  </div>
  <!--end::Footer-->
  </div>
  <!--end::Wrapper-->
  </div>
  <!--begin::Scrolltop-->
  <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
      <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
      <span class="svg-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
              <path
                  d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                  fill="black" />
          </svg>
      </span>
      <!--end::Svg Icon-->
  </div>
  <!--end::Scrolltop-->
  <!--end::Page-->
  <!--end::Main-->

  <!-- begin::Alert -->
  <?php if ($this->session->flashdata('success')): ?>
  <script>
var successfuly = '<?= $this->session->flashdata('success'); ?>';
Swal.fire({
    title: 'Sukses!',
    text: successfuly,
    icon: 'success',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        window.location.href = '';
    }
});
  </script>
  <?php $this->session->unset_userdata('success'); // Menghapus session setelah ditampilkan ?>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')): ?>
  <script>
Swal.fire({
    title: 'Error!',
    text: '<?= $this->session->flashdata('error'); ?>',
    icon: 'error',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        window.location.href = '';
    }
});
  </script>
  <?php $this->session->unset_userdata('error'); // Menghapus session setelah ditampilkan ?>
  <?php endif; ?>
  <!-- end::Alert -->

  <script>
var hostUrl = "<?=base_url()?>assets/";
  </script>
  <!--begin::Javascript-->
  <!--begin::Global Javascript Bundle(used by all pages)-->
  <script src="<?=base_url()?>assets/plugins/global/plugins.bundle.js"></script>
  <script src="<?=base_url()?>assets/js/scripts.bundle.js"></script>
  <!--end::Global Javascript Bundle-->
  <!--begin::Page Vendors Javascript(used by this page)-->
  <script src="<?=base_url()?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
  <!--end::Page Vendors Javascript-->
  <!--begin::Page Custom Javascript(used by this page)-->
  <script src="<?=base_url()?>assets/js/custom/widgets.js"></script>
  <script src="<?=base_url()?>assets/js/custom/apps/chat/chat.js"></script>
  <script src="<?=base_url()?>assets/js/custom/modals/create-app.js"></script>
  <script src="<?=base_url()?>assets/js/custom/modals/upgrade-plan.js"></script>
  <!--end::Page Custom Javascript-->
  <script>
$(document).ready(function() {
    setInterval(() => {
        $.ajax({
            url: "<?= base_url('home/count_notifications'); ?>",
            type: "POST",
            datatype: "json",
            data: {},
            success: function(response) {
                var dataObj = JSON.parse(response);
                var jumlahNotifikasi = dataObj.jumlah_notifikasi;
                var dataNotif = dataObj.dataNotif;
                $('#jumlah_notif').html(jumlahNotifikasi);
                const waktuSaatIni = new Date();
                const waktuDariDatabase = new Date(dataNotif[jumlahNotifikasi - 1]
                    .create_at);
                const selisihWaktu = (waktuSaatIni - waktuDariDatabase) / 1000;
                if (selisihWaktu < 3) {
                    showNotification("Anda memiliki notifikasi baru.");
                    var audio = document.getElementById("audioplay").autoplay = true;
                }
                var container = $('.scroll-y.mh-325px.my-5.px-8');
                container.empty();

                $.each(dataNotif, function(key, notif) {
                    var itemHTML = `
                        <!--begin::Item-->
                        <div class="d-flex flex-stack py-4">
                            <!--begin::Section-->
                            <div class="d-flex align-items-center me-2">
                                <!--begin::Code-->
                                <span class="w-70px badge badge-light-success me-4">200 OK</span>
                                <!--end::Code-->
                                <!--begin::Title-->
                                <a href="#" class="text-gray-800 text-hover-primary fw-bold">${notif.isi_notifikasi}</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Label-->
                            <span class="badge badge-light fs-8">Just now</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Item-->
                    `;
                    container.append(itemHTML);
                });
            },
        });
    }, 2000);

    function showNotification(message) {
        if ('Notification' in window) {
            Notification.requestPermission(function(permission) {
                if (permission === 'granted') {
                    var notification = new Notification('Notifikasi', {
                        body: message,
                        icon: 'icon.png'
                    });
                }
            });
        }
    }
});
  </script>
  <!--end::Javascript-->
  </body>
  <!--end::Body-->

  </html>