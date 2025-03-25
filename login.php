<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Inventaris Lintas Internasional Berkarya" />
	<meta property="og:title" content="Inventaris Lintas Internasional Berkarya" />
	<meta property="og:description" content="Inventaris Lintas Internasional Berkarya" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Inventaris Lintas Internasional Berkarya</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="assets/favicon_logo.png" />
    <link href="./css/style.css" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="./vendors/toastr/css/toastr.min.css">

</head>

<body class="vh-100">
<div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <img src="assets/logo_lib.png" alt="">
                                    </div>
                                    <!-- FORM LOGIN -->
                                    <form action="mekanisme_login.php" method="POST">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Kata Sandi</strong></label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="mb-2 password-toggle">
                                            <input type="checkbox" id="showPassword">
                                            <label for="showPassword">Tampilkan Kata Sandi</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TOASTR LOGIN -->
    <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.options = {
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 6000,
                            extendedTimeOut: 1000,
                            preventDuplicates: true,
                        };
                        toastr.error('" . $_SESSION['error'] . "', 'Gagal Login');
                    });
                </script>";
            unset($_SESSION['error']);
        }
    ?>

    <!-- Kata Sandi -->
    <script>
        document.getElementById('showPassword').addEventListener('change', function () {
            var passwordField = document.getElementById('password');
            passwordField.type = this.checked ? 'text' : 'password';
        });
    </script>

    <!-- Required vendorss -->
    <script src="./vendors/global/global.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/dlabnav-init.js"></script>
    <!-- Toastr -->
    <script src="./vendors/toastr/js/toastr.min.js"></script>

    <!-- All init script -->
    <script src="./js/plugins-init/toastr-init.js"></script>
	
</body>
</html>