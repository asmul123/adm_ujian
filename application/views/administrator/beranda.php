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
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">No</th>
                                        <th rowspan="2" class="text-center">Nama Pengawas</th>
                                        <th rowspan="2" class="text-center">Ruang</th>
                                        <th rowspan="2" class="text-center">Kelas</th>
                                        <th rowspan="2" class="text-center">Mata Pelajaran</th>
                                        <th rowspan="2" class="text-center">Jumlah Hadir</th>
                                        <th colspan="2" class="text-center">Cetak</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Berita Acara</th>
                                        <th class="text-center">Daftar Hadir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    $allba = $this->Admin_model->getBA();
                                    foreach ($allba as $ab) :
                                        $countpes = $this->Admin_model->getPresentPeserta($ab['id']);
                                    ?>
                                        <tr>
                                            <td><?= ++$no ?></td>
                                            <td><?= $ab['nama']; ?></td>
                                            <td><?= $ab['ruang']; ?></td>
                                            <td><?= $ab['kelas']; ?></td>
                                            <td><?= $ab['mapel']; ?></td>
                                            <td><?= $countpes; ?></td>
                                            <td><a href="<?= base_url() ?>administrator/cetakba/<?= $ab['id'] ?>" target="_blank"> <i class="fa fa-print"></i></a></td>
                                            <td><a href="<?= base_url() ?>administrator/cetakdh/<?= $ab['id'] ?>" target="_blank"> <i class="fa fa-print"></i></a></td>
                                        </tr>
                                    <?php
                                    endforeach; ?>
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
<!-- Required vendors -->