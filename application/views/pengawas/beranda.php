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
                        <h4 class="card-title">Daftar Berita Acara</h4>
                        <a href="#" data-toggle="modal" data-target="#isiba" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i>
                            </span>Tambah</a>
                        <div class="modal fade" id="isiba">
                            <div class="modal-dialog modal-lg" role="document">
                                <form action="<?= base_url() ?>pengawas/addba" method="post" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Isi Berita Acara</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Pengawas</label>
                                                <input type="text" class="form-control" name="nama" value="<?= $pengguna['name'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Ujian</label>
                                                <input type="text" name="tgl" class="form-control" value="<?= date('Y-m-d') ?>" id="mdate">
                                            </div>
                                            <div class="form-group clockpicker">
                                                <label>Waktu Mulai Ujian</label>
                                                <input type="text" name="mulai" class="form-control" placeholder="00:00">
                                            </div>
                                            <div class="form-group">
                                                <label>Waktu Selesai Ujian</label>
                                                <input type="text" name="sampai" class="form-control" placeholder="00:00">
                                            </div>
                                            <div class="form-group">
                                                <label>Mata Pelajaran</label>
                                                <input type="text" name="mapel" class="form-control" placeholder="mis. Bahasa Indonesia">
                                            </div>
                                            <div class="form-group">
                                                <label>Ruang</label>
                                                <select class="form-control" name="ruang" id="ruang">
                                                    <option value="">Pilih Ruang</option>
                                                    <?php
                                                    $listruang = $this->Pengawas_model->getRuangPeserta();
                                                    foreach ($listruang as $lr) :
                                                    ?>
                                                        <option value="<?= $lr['ruang'] ?>"><?= $lr['ruang'] ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <select class="form-control" name="kelas" id="kelas">
                                                    <option value="">Pilih Kelas</option>
                                                    <?php
                                                    $listkelas = $this->Pengawas_model->getKelasPeserta();
                                                    foreach ($listkelas as $lk) :
                                                    ?>
                                                        <option value="<?= $lk['kelas'] ?>"><?= $lk['kelas'] ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Peserta yang Tidak Hadir</label>
                                                <select class="multi-select" id="absen" name="absen[]" multiple="multiple">
                                                    <option value="">Pilih Peserta tidak hadir</option>
                                                    <?php
                                                    $peserta = $this->Pengawas_model->getPeserta();
                                                    foreach ($peserta as $p) :
                                                    ?>
                                                        <option value="<?= $p['nopes'] ?>"><?= $p['nopes'] ?> | <?= $p['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Catatan selama Ujian</label>
                                                <textarea name="catatan" class="form-control"></textarea>
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
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Ruang</th>
                                        <th>Kelas</th>
                                        <th>Jumlah Peserta</th>
                                        <th>Peserta Hadir</th>
                                        <th>Peserta Tidak Hadir</th>
                                        <th>Jumlah Presensi</th>
                                        <th>Tanda Tangan Pengawas</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <?php
                                $allba = $this->Pengawas_model->getBAPengawas($pengguna['id']);
                                ?>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($allba as $ab) :
                                        $jmlpes = $this->Pengawas_model->getCountPeserta($ab['kelas'], $ab['ruang']);
                                        $jmlpres = $this->Pengawas_model->getPresentPeserta($ab['id']);
                                        $pesertaabsen = explode("#", $ab['absen']);
                                        $jmlabsen = count($pesertaabsen) - 1;
                                        $jmlhadir = $jmlpes - $jmlabsen;
                                    ?>
                                        <tr>
                                            <td><?= ++$no ?></td>
                                            <td><?= $ab['mapel'] ?></td>
                                            <td><?= $ab['ruang'] ?></td>
                                            <td><?= $ab['kelas'] ?></td>
                                            <td><?= $jmlpes ?></td>
                                            <td><?= $jmlhadir ?></td>
                                            <td><?= $jmlabsen ?></td>
                                            <td><?= $jmlpres ?></td>
                                            <td>
                                                <?php
                                                if ($ab['ttd'] != "") {
                                                    $ModDelTTD = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6); ?>
                                                    <img src="data:<?= $ab['ttd'] ?>" style="object-fit: cover;  object-position: -20% 0;  width: 200px; height: 150;">
                                                    <a href="#" data-toggle="modal" data-target="#<?= $ModDelTTD ?>"><span class="badge badge-danger">Hapus</span></a>
                                                    <div class="modal fade" id="<?= $ModDelTTD ?>">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <form action="<?= base_url() ?>pengawas/delttd" method="post">
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
                                                                            <input type="hidden" name="ba_id" value="<?= $ab['id'] ?>">
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
                                                    <a href="<?= base_url() ?>pengawas/ttdba/<?= $ab['id'] ?>"> <span class="badge badge-warning">Isi TTD</span></a>

                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $ModDelBA = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6); ?>
                                                <a href="#" data-toggle="modal" data-target="#<?= $ModDelBA ?>"><span class="badge badge-danger">Hapus</span></a>
                                                <div class="modal fade" id="<?= $ModDelBA ?>">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <form action="<?= base_url() ?>pengawas/delba" method="post">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        Apakah anda yakin akan menghapus Berita Acara ini ?<br>
                                                                        <input type="checkbox" name="ya" value="1"> Ya Yakin
                                                                        <input type="hidden" name="ba_id" value="<?= $ab['id'] ?>">
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