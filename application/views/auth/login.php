<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $judul ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/logo.png">
    <link href="public/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-4">
                    <img src="public/images/logo.png" class="rounded mx-auto d-block" width="100px"><br>
                    <img src="public/images/magang.jpg" class="rounded mx-auto d-block" width="100%">
                </div>
                <div class="col-md-4">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">

                                    <h4 class="text-center mb-4">ADMINISTRASI SMKN 1 GARUT</h4>
                                    <?= $this->session->flashdata('pesan'); ?>
                                    <form action="login" method="post">
                                        <div class="form-group">
                                            <label><strong>Nama Pengguna</strong></label>
                                            <input type="text" name="email" class="form-control" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Kata Sandi</strong></label>
                                            <input type="password" name="password" class="form-control" required>
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


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="public/vendor/global/global.min.js"></script>
    <script src="public/js/quixnav-init.js"></script>
    <script src="public/js/custom.min.js"></script>

</body>

</html>