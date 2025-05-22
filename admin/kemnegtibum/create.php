<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_urut = $_POST['no_urut'];
    $tanggal_nomor = $_POST['tanggal_nomor'];
    $instansi_penyidik = $_POST['instansi_penyidik'];
    $tgl_diterima_kejaksaan = $_POST['tgl_diterima_kejaksaan'];
    $identitas_tersangka = $_POST['identitas_tersangka'];
    $waktu_kejadian = $_POST['waktu_kejadian'];
    $tempat_kejadian = $_POST['tempat_kejadian'];
    $pasal_disangkakan = $_POST['pasal_disangkakan'];
    $jaksa_peneliti = $_POST['jaksa_peneliti'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO oharda (
        no_urut,
        tanggal_nomor,
        instansi_penyidik,
        tgl_diterima_kejaksaan,
        identitas_tersangka,
        waktu_kejadian,
        tempat_kejadian,
        pasal_disangkakan,
        jaksa_peneliti,
        keterangan
    ) VALUES (
        '$no_urut',
        '$tanggal_nomor',
        '$instansi_penyidik',
        '$tgl_diterima_kejaksaan',
        '$identitas_tersangka',
        '$waktu_kejadian',
        '$tempat_kejadian',
        '$pasal_disangkakan',
        '$jaksa_peneliti',
        '$keterangan'
    )";

    if (mysqli_query($mysqli, $query)) {
        header("Location: kemnegtibum.php");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($mysqli);
    }
}
?>
