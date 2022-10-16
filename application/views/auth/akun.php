<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Update Password</h4>
                    <span class="ml-1">Halaman Ubah Password</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Akun</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Ubah Password</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="card-header">
                        <h4 class="card-title">Update Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="akun" method="post">
                                <div class="form-group">
                                    <input type="password" name="oldpassword" class="form-control input-rounded" placeholder="Password Lama">
                                    <small class="text-danger"><?= form_error('oldpassword'); ?></small>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="newpassword" class="form-control input-rounded" placeholder="Password Baru">
                                    <small class="text-danger"><?= form_error('newpassword'); ?></small>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="newpassword2" class="form-control input-rounded" placeholder="Konfirmasi Password">
                                    <small class="text-danger"><?= form_error('newpassword2'); ?></small>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->