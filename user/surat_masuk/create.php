<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $no_tgl_masuk = $_POST['no_tgl_masuk'];
    $asal_surat = $_POST['asal_surat'];
    $isi_surat = $_POST['isi_surat'];
    $disposisi = $_POST['disposisi'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO surat_masuk (tanggal, no_tgl_masuk, asal_surat, isi_surat, disposisi, keterangan)
              VALUES ('$tanggal', '$no_tgl_masuk', '$asal_surat', '$isi_surat', '$disposisi', '$keterangan')";

    if (mysqli_query($mysqli, $query)) {
        header("Location: main.php");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>
