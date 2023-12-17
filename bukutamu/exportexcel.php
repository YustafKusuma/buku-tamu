<?php
include "koneksi.php";

header("content-type: application/vnd-ms-excel");
header("content-disposition: attachment; filename=Export Excel Data Pengunjung.xls");
header("pragma: no-cache");
header("expires: 0");
?>

<table border="1">
    <thead>
        <tr>
            <th colspan="7">Rekapitulasi Data Pengunjung</th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>No.Hp</th>
            <th>Pekerjaan dan Jabatan</th>
            <th>Dinas/Instansi/Lembaga/Universitas/Afiliasi Pengguna Data</th>
            <th>Keperluan Kunjungan</th>
        </tr> 
    </thead
    <tbody>
        <?php 
        $tgl1 = $_POST['tanggala'];
        $tgl2 = $_POST['tanggalb'];

        $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal BETWEEN '$tgl1' and '$tgl2' order by id desc");
        $no = 1;
        while($data = mysqli_fetch_array($tampil)){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['tanggal'] ?></td>
            <td><?= $data['nama'] ?></td>
            <td><?= $data['nope'] ?></td>
            <td><?= $data['pekerjaan'] ?></td>
            <td><?= $data['instansi'] ?></td>
            <td><?= $data['keperluan'] ?></td>
         </tr>
         <?php } ?>
    </tbody>
</table>