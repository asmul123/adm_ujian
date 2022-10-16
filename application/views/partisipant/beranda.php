<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Selamat datang <?= $partisipant['name'] ?></h4>
                    <p class="mb-0">Administrasi Pembelajaran 2022</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Main Menu</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Beranda</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Status Pengumpulan Administrasi</h4>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran yang di Ampu</th>
                                        <th>ATP</th>
                                        <th>Modul Ajar</th>
                                        <th>Link Absen</th>
                                    </tr>
                                </thead>
                                <?php
                                $alltasks = $this->Partisipant_model->getTask($partisipant['partisipant_id']);
                                ?>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($alltasks as $at) :
                                    ?>
                                        <tr>
                                            <td><?= ++$no ?></td>
                                            <td><?= $at['task'] ?></td>
                                            <td>
                                                <?php
                                                $atptask = $this->Partisipant_model->getATP($at['id']);
                                                if ($atptask) {
                                                    $ModDelATP = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6);
                                                ?>
                                                    <a href="<?= base_url() ?>public/files/atp/<?= $atptask['file'] ?>" target="_blank"><span class="badge badge-success">Lihat</span></a>
                                                    <a href="#" data-toggle="modal" data-target="#<?= $ModDelATP ?>"><span class="badge badge-danger">Hapus</span></a>
                                                    <div class="modal fade" id="<?= $ModDelATP ?>">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <form action="<?= base_url() ?>partisipant/delatp" method="post" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            Apakah anda yakin akan menghapus File ini ?<br>
                                                                            <input type="checkbox" name="ya" value="1"> Ya Yakin
                                                                            <input type="hidden" name="atp_id" value="<?= $atptask['id'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {

                                                    $ModUpATP = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6); ?>
                                                    <!-- Button trigger modal -->
                                                    <a href="#" data-toggle="modal" data-target="#<?= $ModUpATP ?>"> <span class="badge badge-warning">Upload</span></a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="<?= $ModUpATP ?>">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <form action="<?= base_url() ?>partisipant/addatp" method="post" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Pilih File (Pdf,Docx,Zip)</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>File ATP</label>
                                                                            <input type="file" class="form-control" name="atp">
                                                                            <input type="hidden" name="task_id" value="<?= $at['id'] ?>">
                                                                            <small class="text-danger"><?= form_error('atp'); ?></small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $modultask = $this->Partisipant_model->getModul($at['id']);
                                                if ($modultask) {
                                                    $ModDelMOD = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6); ?>
                                                    <a href="<?= base_url() ?>public/files/modul/<?= $modultask['file'] ?>" target="_blank"><span class="badge badge-success">Lihat</span></a>
                                                    <a href="#" data-toggle="modal" data-target="#<?= $ModDelMOD ?>"><span class="badge badge-danger">Hapus</span></a>
                                                    <div class="modal fade" id="<?= $ModDelMOD ?>">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <form action="<?= base_url() ?>partisipant/delmod" method="post" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            Apakah anda yakin akan menghapus File ini ?<br>
                                                                            <input type="checkbox" name="ya" value="1"> Ya Yakin
                                                                            <input type="hidden" name="mod_id" value="<?= $modultask['id'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php } else {
                                                    $ModAddMOD = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6); ?>
                                                    <!-- Button trigger modal -->
                                                    <a href="#" data-toggle="modal" data-target="#<?= $ModAddMOD ?>"> <span class="badge badge-warning">Upload</span></a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="<?= $ModAddMOD ?>">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <form action="<?= base_url() ?>partisipant/addmodul" method="post" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Pilih File (Pdf,Docx,Zip)</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>File Modul Ajar</label>
                                                                            <input type="file" class="form-control" name="modul">
                                                                            <input type="hidden" name="task_id" value="<?= $at['id'] ?>">
                                                                            <small class="text-danger"><?= form_error('modul'); ?></small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $ttdtask = $this->Partisipant_model->getTTD($at['id']);
                                                if ($ttdtask) {
                                                    $ModDelTTD = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6); ?>
                                                    <img src="data:<?= $ttdtask['signature'] ?>" style="object-fit: cover;  object-position: -20% 0;  width: 200px; height: 150;">
                                                    <a href="#" data-toggle="modal" data-target="#<?= $ModDelTTD ?>"><span class="badge badge-danger">Hapus</span></a>
                                                    <div class="modal fade" id="<?= $ModDelTTD ?>">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <form action="<?= base_url() ?>partisipant/delttd" method="post">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            Apakah anda yakin akan menghapus Kehadiran ini ?<br>
                                                                            <input type="checkbox" name="ya" value="1"> Ya Yakin
                                                                            <input type="hidden" name="ttd_id" value="<?= $ttdtask['id'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else {
                                                    if ($atptask and $modultask) {
                                                    ?>
                                                        <!-- Button trigger modal -->
                                                        <a href="<?= base_url() ?>partisipant/present/<?= $at['id'] ?>"> <span class="badge badge-warning">Isi</span></a>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="#" onclick="myFunction()"><span class="badge badge-danger">Absen</span></a>
                                                        <script>
                                                            function myFunction() {
                                                                alert("Silahkan Upload terlebih dahulu file di samping");
                                                            }
                                                        </script>
                                                <?php }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Rekapitulasi Pengumpulan Administrasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Guru Pengampu</th>
                                        <th>Mata Pelajaran yang di Ampu</th>
                                        <th>ATP</th>
                                        <th>Modul Ajar</th>
                                        <th>Absen</th>
                                    </tr>
                                </thead>
                                <?php
                                $getalltasks = $this->Partisipant_model->getAllTask();
                                ?>
                                <tbody>
                                    <?php
                                    $nom = 0;
                                    foreach ($getalltasks as $gat) :
                                    ?>
                                        <tr>
                                            <td><?= ++$nom ?></td>
                                            <td><?= $gat['name'] ?></td>
                                            <td><?= $gat['task'] ?></td>
                                            <td>
                                                <?php
                                                $atptask = $this->Partisipant_model->getATP($gat['id']);
                                                if ($atptask) {
                                                ?>
                                                    <span class="badge badge-success">Sudah</span>
                                                <?php
                                                } else { ?>
                                                    <span class="badge badge-warning">Belum</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $modultask = $this->Partisipant_model->getModul($gat['id']);
                                                if ($modultask) {
                                                ?>
                                                    <span class="badge badge-success">Sudah</span>
                                                <?php } else {
                                                ?>
                                                    <span class="badge badge-warning">Belum</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $ttdtask = $this->Partisipant_model->getTTD($gat['id']);
                                                if ($ttdtask) {
                                                ?>
                                                    <span class="badge badge-success">Sudah</span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="badge badge-warning">Belum</span>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
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