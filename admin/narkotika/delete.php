<?php
include '../../config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM oharda WHERE id = $id";
  mysqli_query($mysqli, $query);
}

header("Location: narkotika.php"); // redirect ke halaman utama
exit;
?>
