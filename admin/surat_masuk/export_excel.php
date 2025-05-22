<?php
include '../../config.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Recap_Surat_Masuk.xls");
?>

<table border="1">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>No. & Tgl. Masuk</th>
        <th>Asal Surat</th>
        <th>Isi Surat</th>
        <th>Disposisi</th>
        <th>Keterangan</th>
    </tr>
    <?php
    $no = 1;
    $data = $mysqli->query("SELECT * FROM surat_masuk");
    while ($row = $data->fetch_assoc()) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['tanggal']; ?></td>
        <td><?= $row['no_tgl_masuk']; ?></td>
        <td><?= $row['asal_surat']; ?></td>
        <td><?= $row['isi_surat']; ?></td>
        <td><?= $row['disposisi']; ?></td>
        <td><?= $row['keterangan']; ?></td>
    </tr>
    <?php } ?>
</table>
