

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?=ADMINASSETS?>/" data-template="vertical-menu-template-free"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Login  | <?=APP_NAME?></title>

    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=ADMINASSETS?>/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/fonts/materialdesignicons.css">

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/libs/node-waves/node-waves.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/css/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/css/theme-default.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="<?=ADMINASSETS?>/css/demo.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?=ADMINASSETS?>/vendor/css/pages/page-auth.css">

    <!-- Helpers -->
    <script src="<?=ADMINASSETS?>/vendor/js/helpers.js"></script>
    <link rel="stylesheet" href="<?=ADMINASSETS?>/css/sweetalert.css" />
    <style type="text/css">
.layout-menu-fixed .layout-navbar-full .layout-menu,
.layout-page {
    padding-top: 0px !important;
}
.content-wrapper {
    padding-bottom: 0px !important;
}
/* Add your styles for the loading overlay here */

    </style>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=ADMINASSETS?>/js/config.js"></script>
    <script src="<?=ADMINASSETS?>/js/jquery-3.6.4.min.js"></script>
    
  </head>

  <body>
    <!-- Content -->

    <div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card p-2">
            <!-- Logo -->
            <div class="app-brand justify-content-center mt-5">
              <a href="<?=APP_URL?>" class="app-brand-link gap-2">

                <span class="app-brand-text demo text-heading fw-semibold"><?=APP_NAME?></span>
              </a>
            </div>
            <!-- /Logo -->

            <div class="card-body mt-2">
              <h4 class="mb-2">Admin Panel ! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>

                <div id="loading-overlay">
                    <div id="loading-spinner"></div>
                </div>

              <form id="shuForm" class="mb-3" method="post">
                <div class="form-floating form-floating-outline mb-3">
                  <input type="text" class="form-control" id="email" name="username" placeholder="Enter your  Username" autofocus="">
                  <label for="username">Username</label>
                </div>
                <div class="mb-3">
                  <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                      <div class="form-floating form-floating-outline">
                        <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                        <label for="password">Password</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                    <input type="hidden" id="" name="submit" value="login">
                  <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Login -->
          <img src="<?=ADMINASSETS?>/img/illustrations/tree-3.png" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
          <img src="<?=ADMINASSETS?>/img/illustrations/auth-basic-mask-light.png" class="authentication-image d-none d-lg-block" alt="triangle-bg" data-app-light-img="illustrations/auth-basic-mask-light.png" data-app-dark-img="illustrations/auth-basic-mask-dark.png">
          <img src="<?=ADMINASSETS?>/img/illustrations/tree.png" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
        </div>
      </div>
    </div>



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?=ADMINASSETS?>/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=ADMINASSETS?>/vendor/libs/popper/popper.js"></script>
    <script src="<?=ADMINASSETS?>/vendor/js/bootstrap.js"></script>
    <script src="<?=ADMINASSETS?>/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?=ADMINASSETS?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=ADMINASSETS?>/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?=ADMINASSETS?>/js/main.js"></script>
    <script src="<?=ADMINASSETS?>/js/sweetalert.js"></script>
    <script src="<?=ADMINASSETS?>/js/jquery-3.6.4.min.js"></script>

    <!-- Page JS -->



  <script>



      const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
          }
      });

    $(document).ready(function () {
        // Event listener for form submission
        $(document).on("submit", "#shuForm", function (event) {
            event.preventDefault();

            // Check for FormData support
            if (window.FormData) {
                // Proceed with FormData usage
                var formData = new FormData(this);

                // Disable the submit button to prevent multiple submissions
                $("#submit").attr("disabled", "disabled");
                $('#loading-overlay').show();

                $.ajax({
                    url: "<?=APP_URL?>/login-request",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function (data) {
                        $('#loading-overlay').hide();
                        $("#submit").removeAttr("disabled");
                        if (data.s == 1) {
                            // If the login is successful, show a success message and redirect after a delay
                            Toast.fire({
                                icon: "success",
                                title: data.m
                            });
                            setTimeout(function () {
                                window.location.href = '<?=AdminURL?>/dashboard';
                            }, 3000);
                        } else {
                            // If login fails, show a warning message
                            Toast.fire({
                                icon: "warning",
                                title: data.m
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: " + error);
                        $("#submit").removeAttr("disabled");
                        $('#loading-overlay').hide();
                        // Show an error message in case of AJAX error
                        Toast.fire({
                            icon: "error",
                            title: "An error occurred during the request."
                        });
                    },
                });
            } else {
                // Handle alternative method or inform the user
                console.error("FormData is not supported in this browser.");
            }
        });
    });



  </script>

</body></html>
