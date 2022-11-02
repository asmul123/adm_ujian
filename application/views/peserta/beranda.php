<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Selamat datang <?= $pengguna['name'] ?></h4>
                    <p class="mb-0">Administrasi Penilaian Tengah Semester Ganjil 2022</p>
                    <p class="mb-0"><?= $pengguna['ruang'] ?> | <?= $pengguna['kelas'] ?></p>
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
                        <h4 class="card-title">Daftar Hadir Peserta</h4>
                    </div>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tanda Tangan Peserta</th>
                                </tr>
                            </thead>
                            <?php
                            $allba = $this->Peserta_model->getBAPeserta($pengguna['kelas'], $pengguna['ruang']);
                            ?>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($allba as $ab) :
                                    $dh = $this->Peserta_model->getPresentPeserta($ab['id'], $pengguna['id_peserta']);
                                ?>
                                    <tr>
                                        <td><?= ++$no ?></td>
                                        <td><?= $ab['mapel'] ?></td>
                                        <td>
                                            <?php
                                            if ($dh['ttd'] != "") {
                                                $ModDelTTD = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6); ?>
                                                <img src="data:<?= $dh['ttd'] ?>" style="object-fit: cover;  object-position: -20% 0;  width: 200px; height: 150;">
                                                <a href="#" data-toggle="modal" data-target="#<?= $ModDelTTD ?>"><span class="badge badge-danger">Hapus</span></a>
                                                <div class="modal fade" id="<?= $ModDelTTD ?>">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <form action="<?= base_url() ?>peserta/delttd" method="post">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        Apakah anda yakin akan menghapus Tanda tangan ini ?<br>
                                                                        <input type="checkbox" name="ya" value="1"> Ya Yakin
                                                                        <input type="hidden" name="dh_id" value="<?= $dh['id'] ?>">
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
                                            ?>
                                                <!-- Button trigger modal -->
                                                <a href="<?= base_url() ?>peserta/ttddh/<?= $ab['id'] ?>"> <span class="badge badge-warning">Isi TTD</span></a>

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