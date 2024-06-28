<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Glassco</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <div
                                    class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                                    <a class="navbar-brand brand-logo" href="<?php echo base_url(); ?>Login"><img
                                            src="<?php echo base_url(); ?>assets/images/logo/imgpsh_fullsize_anim.jpg"
                                            width="500" height="100" alt="logo" /></a>
                                    <!--<img src="<?php echo base_url(); ?>assets/images/logo-dark.svg">-->
                                </div>
                            </div>
                            <h4>Hello! let's get started</h4>
                            <?php if ($msg) { ?>
                                <h6 class="fw-light">
                                    <?php echo $msg; ?>
                                </h6>
                            <?php } else { ?>
                                <h6 class="fw-light">Sign in to continue.</h6>
                            <?php }
                            ?>
                            <form class="pt-3" name="frmlogin" id="frmlogin" method="post"
                                action="<?php echo base_url(); ?>Login/signin">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email" id="email"
                                        placeholder="User Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password"
                                        id="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="button"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                        IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url(); ?>assets/js/off-canvas.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/misc.js"></script>
    <script language="javascript">
        $('button').click(function () {
            $('.fw-light').fadeOut('slow', function () {
                var email = $('#email').val();
                var pwd = $('#password').val();
                //alert(email+" "+pwd)
                $('.fw-light').empty();
                if (email && pwd) {
                    $('.fw-light').html('<div class="alert alert-primary" role="alert">Please wait while we prepare your account.</div>');
                    $('.fw-light').css('color', '#0f0');
                    $('.fw-light').removeClass("error");
                    $('.fw-light').addClass("success");
                    setTimeout(function () {
                        $('#frmlogin').submit();
                    }, 2000);
                }
                else {
                    $('.fw-light').html('<div class=" b alert alert-danger " role="alert">Invalid login credentials!</div>');
                    $('.fw-light').css('color', '#ff0000');
                    $('.fw-light').removeClass("error");
                    $('.fw-light').addClass("success");
                    $('.fw-light').addClass("error");

                }
                setTimeout(function () {
                    $('.fw-light').fadeIn('slow');
                }, 300);
            });
        });
    </script>
    <!-- endinject -->
</body>

</html>