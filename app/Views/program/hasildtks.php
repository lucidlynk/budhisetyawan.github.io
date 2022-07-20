<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= $this->include('dashboard/topbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800">KIS APBD</h1> -->
                    <div class="card-body">
                        <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kepsertaan <?= $tittle; ?></h6>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>ID DTKS</th>
                                            <th>PKH</th>
                                            <th>BPNT</th>
                                            <th>BPNT PPKM</th>
                                            <th>PBI APBN</th>
                                            <th>Kecamatan</th>
                                            <th>Desa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- creat foreach $tampil -->
                                        <?php foreach($tampil as $d): ?>
                                        <?php if(!empty($d['pnama'])) {
                                            $pkh='Ya';
                                        }else{
                                            $pkh='Tidak';
                                        };
                                        ?>
                                            
                                        <tr>
                                            <td><?= $d['dnik']; ?></td>
                                            <td><?= $d['dnama']; ?></td>
                                            <td><?= $d['ddtks']; ?></td>
                                            <td><?= $pkh; ?><br><?= $d['ptahap']; ?></td>
                                            <td><?= $d['dbpnt']; ?></td>
                                            <td><?= $d['dbppkm']; ?></td>
                                            <td><?= $d['pbi']; ?></td>
                                            <td><?= $d['dkec']; ?></td>
                                            <td><?= $d['ddesa']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <a href="/peserta/dtks"><button class="btn btn-warning">Kembali</button></a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?= $this->endSection(); ?>