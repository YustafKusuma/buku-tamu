<!-- Header -->
<?php include "header.php"; ?>

<?php
if (isset($_POST['bsimpan'])){
    $tgl = date("Y-m-d");

    $nama = htmlspecialchars( $_POST['nama'], ENT_QUOTES);
    $pekerjaan = htmlspecialchars( $_POST['pekerjaan'], ENT_QUOTES);
    $instansi = htmlspecialchars( $_POST['instansi'], ENT_QUOTES);
    $keperluan = htmlspecialchars( $_POST['keperluan'], ENT_QUOTES);
    $nope = htmlspecialchars( $_POST['nope'], ENT_QUOTES);

    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES ('','$tgl','$nama','$pekerjaan','$instansi', '$keperluan','$nope')");

    if ($simpan) {
        echo "<script>alert('Simpan Data BERHASIL');
             document.location='?' </script>";
    } else {
        echo "<script>alert('Simpan Data GAGAL');
             document.location='?' </script>";
    }
}
?>
    
    <!-- Head -->
    <div class="head text-center">
        <img src="assets/img/bps_logo_vector.svg" width="250">
        <h2 class="text-white">Sistem Informasi Buku Tamu <br> Badan Pusat Statistik Kota Batam </h2>
    </div>
    <!-- Head -->

    <!-- Row -->
    <div class="row mt-2">
        <!-- col-lg-7 -->
        <div class="col-lg-7 mb-3">
            <div class="card shadow primary">
                <!-- Card Body -->
                <div class="card-body">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                                </div>
                                <form class="user" method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama" required> 
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="pekerjaan" placeholder="Pekerjaan dan Jabatan" required> 
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="instansi" placeholder="Dinas/Instansi/Lembaga/Universitas/Afiliasi Pengguna Data" required> 
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="keperluan" placeholder="Keperluan Kunjungan" required> 
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="nope" placeholder="No.Hp" required> 
                                    </div>
                                    
                                    <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block"> Simpan </button>
                                
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#">Badan Pusat Statistik Kota Batam | 2022 - <?=date('Y')?> <br>
                                    JI. Abulyatama, Kel. Belian, Kec. Batam Kota, Batam, Kepulauan Riau
                                    </a>
                                </div>
                            </div>
                <!-- Card Body --> 
            </div>
        </div>
        <!-- col-lg-7 -->

        <!-- col-lg-5 -->
        <div class="col-lg-5 mb-3">
            <!-- Card --> 
            <div class="card shadow">
                <!-- Card Body --> 
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                    </div>

                    <?php
                        $tgl_sekarang = date('Y-m-d');
                        $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
                        $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));
                        $sekarang = date('Y-m-d h:i:s');

                        $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%'"
                            ));
                        $kemarin = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%'"
                            ));
                        $seminggu = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and '$sekarang'"
                            ));
                        $bulan_ini = date('m');
                        $sebulan = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"
                            ));
                        $keseluruhan = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu"
                            ));
                    ?>

                    <table class="table table-bordered">
                        <tr>
                            <td>Hari ini</td>
                            <td>: <?= $tgl_sekarang[0]?></td>
                        </tr>
                        <tr>
                            <td>Kemarin</td>
                            <td>: <?= $kemarin[0]?></td>
                        </tr>
                        <tr>
                            <td>Minggu ini</td>
                            <td>: <?= $seminggu[0]?></td>
                        </tr>
                        <tr>
                            <td>Bulan ini</td>
                            <td>: <?= $sebulan[0]?></td>
                        </tr>
                        <tr>
                            <td>Keseluruhan</td>
                            <td>: <?= $keseluruhan[0]?></td>
                        </tr>
                    </table>
                </div>
                <!-- Card Body --> 
            </div>
            <!-- Card --> 
        </div>
        <!-- col-lg-5 -->
    </div>
    <!-- Row -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini [<?=date('d-m-Y')?>]</h6>
                        </div>
                        <div class="card-body">
                            <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i> Rekapitulasi Pengunjung</a>
                            <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"></i> Log Out</a>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Pekerjaan dan Jabatan</th>
                                            <th>Dinas/Instansi/Lembaga/Universitas/Afiliasi Pengguna Data</th>
                                            <th>Keperluan</th>
                                            <th>No.Hp</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Pekerjaan dan Jabatan</th>
                                            <th>Dinas/Instansi/Lembaga/Universitas/Afiliasi Pengguna Data</th>
                                            <th>Keperluan</th>
                                            <th>No.Hp</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $tgl = date("Y-m-d");
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal like '%$tgl%' order by id desc");
                                            $no = 1;
                                            while($data = mysqli_fetch_array($tampil)){
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['pekerjaan'] ?></td>
                                            <td><?= $data['instansi'] ?></td>
                                            <td><?= $data['keperluan'] ?></td>
                                            <td><?= $data['nope'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
<!-- Footer -->
<?php include "footer.php"; ?>