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
    <style>
        #signature {
            width: 100%;
            height: auto;
            border: 1px solid black;
        }
    </style>
    <!-- jQuery -->
    <script src='<?= base_url() ?>public/jquery-3.0.0.js' type='text/javascript'></script>

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-100">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Tanda Tangan -> Set -> Simpan</h4>
                                    <?= $this->session->flashdata('pesan'); ?>
                                    <form action="<?= base_url() ?>pengawas/saveba" method="post">
                                        <div class="form-group">

                                            <!-- Signature area -->
                                            <!-- Signature area -->
                                            <div id="signature"></div>
                                            <input type='button' id='click' value='Set' class="btn btn-primary"><br>
                                            <input type="hidden" id='output' name="ttd"><br />
                                            <input type="hidden" name="ba_id" value="<?= $ba_id ?>"><br />

                                            <!-- Preview image -->
                                            <img src='' id='sign_prev' style='display: none;' />
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id='save' style='display: none;' class="btn btn-primary btn-block">Simpan</button>
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

    <!-- jSignature -->
    <script src="<?= base_url() ?>public/jSignature-master/libs/jSignature.min.js"></script>
    <script src="<?= base_url() ?>public/jSignature-master/libs/modernizr.js"></script>

    <!--[if lt IE 9]>
        <script type="text/javascript" src="jSignature-maste/libs/flashcanvas.js"></script>
        <![endif]-->
    <script>
        $(document).ready(function() {

            // Initialize jSignature
            var $sigdiv = $("#signature").jSignature({
                'UndoButton': true
            });

            $('#click').click(function() {
                // Get response of type image
                var data = $sigdiv.jSignature('getData', 'image');

                // Storing in textarea
                $('#output').val(data);

                // Alter image source
                $('#sign_prev').attr('src', "data:" + data);
                $('#sign_prev').show();
                $('#save').show();
            });
        });
    </script>
</body>

</html>