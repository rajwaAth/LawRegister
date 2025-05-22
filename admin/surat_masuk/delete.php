<?php
include '../../config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM surat_masuk WHERE id = $id";
  mysqli_query($mysqli, $query);
}

header("Location: surat_masuk.php"); // redirect ke halaman utama
exit;
?>
