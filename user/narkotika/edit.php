<?php
include '../../config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($mysqli, "SELECT * FROM oharda WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
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

  $query = "UPDATE oharda SET 
              no_urut = '$no_urut',
              tanggal_nomor = '$tanggal_nomor',
              instansi_penyidik = '$instansi_penyidik',
              tgl_diterima_kejaksaan = '$tgl_diterima_kejaksaan',
              identitas_tersangka = '$identitas_tersangka',
              waktu_kejadian = '$waktu_kejadian',
              tempat_kejadian = '$tempat_kejadian',
              pasal_disangkakan = '$pasal_disangkakan',
              jaksa_peneliti = '$jaksa_peneliti',
              keterangan = '$keterangan'
            WHERE id = $id";

  if (mysqli_query($mysqli, $query)) {
    echo "<script>alert('Data berhasil diupdate!'); window.location.href = 'narkotika.php';</script>";
    exit;
  } else {
    echo "<script>alert('Gagal mengupdate data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Oharda</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center px-4">
  <div class="max-w-4xl w-full bg-white p-8 rounded-xl shadow-lg border border-blue-200">
    <h2 class="text-3xl font-semibold text-blue-700 mb-6 text-center">Edit Data Oharda</h2>
    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">

      <div>
        <label class="block font-medium text-gray-700 mb-1">No Urut</label>
        <input type="text" name="no_urut" value="<?= $row['no_urut'] ?>" class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Tanggal & Nomor</label>
        <input type="text" name="tanggal_nomor" value="<?= $row['tanggal_nomor'] ?>" class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Instansi Penyidik</label>
        <input type="text" name="instansi_penyidik" value="<?= $row['instansi_penyidik'] ?>" class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Tanggal Diterima Kejaksaan</label>
        <input type="date" name="tgl_diterima_kejaksaan" value="<?= $row['tgl_diterima_kejaksaan'] ?>" class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div class="md:col-span-2">
        <label class="block font-medium text-gray-700 mb-1">Identitas Tersangka</label>
        <textarea name="identitas_tersangka" rows="2" class="w-full border border-gray-300 rounded px-3 py-2"><?= $row['identitas_tersangka'] ?></textarea>
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Waktu Kejadian</label>
        <input type="text" name="waktu_kejadian" value="<?= $row['waktu_kejadian'] ?>" class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Tempat Kejadian</label>
        <input type="text" name="tempat_kejadian" value="<?= $row['tempat_kejadian'] ?>" class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div class="md:col-span-2">
        <label class="block font-medium text-gray-700 mb-1">Pasal Disangkakan</label>
        <input type="text" name="pasal_disangkakan" value="<?= $row['pasal_disangkakan'] ?>" class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Jaksa Peneliti</label>
        <input type="text" name="jaksa_peneliti" value="<?= $row['jaksa_peneliti'] ?>" class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Keterangan</label>
        <select name="keterangan" class="w-full border border-gray-300 rounded px-3 py-2">
          <option value="Acc" <?= $row['keterangan'] == 'Acc' ? 'selected' : '' ?>>Acc</option>
          <option value="Belum di Acc" <?= $row['keterangan'] == 'Belum di Acc' ? 'selected' : '' ?>>Belum di Acc</option>
        </select>
      </div>

      <div class="md:col-span-2 text-right">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition">Update Data</button>
        <a href="oharda.php" class="ml-2 text-blue-500 hover:underline">Kembali</a>
      </div>
    </form>
  </div>
</body>
</html>
