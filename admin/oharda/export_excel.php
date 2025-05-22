<?php
include '../../config.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Recap_Oharda.xls");
?>

<table border="1">
    <tr>
        <th>No. Urut</th>
        <th>Tanggal Nomor</th>
        <th>Instansi Penyidik</th>
        <th>Tanggal Diterima</th>
        <th>Identitas Tersangka</th>
        <th>Waktu & Tempat Kejadian</th>
        <th>Pasal Disangkakan</th>
        <th>Jaksa Peneliti</th>
        <th>Keterangan</th>
    </tr>
    <?php
    $no = 1;
    $data = $mysqli->query("SELECT * FROM oharda");
    while ($row = $data->fetch_assoc()) {
    ?>
    <tr>
        <td><?= $row['no_urut']; ?></td>
        <td><?= $row['tanggal_nomor']; ?></td>
        <td><?= $row['instansi_penyidik']; ?></td>
        <td><?= $row['tgl_diterima_kejaksaan']; ?></td>
        <td><?= $row['identitas_tersangka']; ?></td>
        <td><?= $row['waktu_kejadian'] . '<br>' . $row['tempat_kejadian']; ?></td>
        <td><?= $row['pasal_disangkakan']; ?></td>
        <td><?= $row['jaksa_peneliti']; ?></td>
        <td><?= $row['keterangan']; ?></td>
    </tr>
    <?php } ?>
</table>