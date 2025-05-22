<?php
include '../../config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($mysqli, "SELECT * FROM surat_masuk WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $tanggal = $_POST['tanggal'];
  $no_tgl_masuk = $_POST['no_tgl_masuk'];
  $asal_surat = $_POST['asal_surat'];
  $isi_surat = $_POST['isi_surat'];
  $disposisi = $_POST['disposisi'];
  $keterangan = $_POST['keterangan'];

  $query = "UPDATE surat_masuk SET 
              tanggal = '$tanggal',
              no_tgl_masuk = '$no_tgl_masuk',
              asal_surat = '$asal_surat',
              isi_surat = '$isi_surat',
              disposisi = '$disposisi',
              keterangan = '$keterangan'
            WHERE id = $id";

  if (mysqli_query($mysqli, $query)) {
    echo "<script>alert('Data berhasil diupdate!'); window.location.href = 'main.php';</script>";
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
  <title>Edit Surat Masuk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center px-4">
  <div class="max-w-3xl w-full bg-white p-8 rounded-xl shadow-lg border border-blue-200">
    <h2 class="text-3xl font-semibold text-blue-700 mb-6 text-center">Edit Surat Masuk</h2>
    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">

      <div>
        <label class="block font-medium text-gray-700 mb-1">Tanggal</label>
        <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">No. & Tgl. Masuk</label>
        <input type="text" name="no_tgl_masuk" value="<?= $row['no_tgl_masuk'] ?>" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Asal Surat</label>
        <input type="text" name="asal_surat" value="<?= $row['asal_surat'] ?>" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Isi Surat</label>
        <textarea name="isi_surat" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"><?= $row['isi_surat'] ?></textarea>
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Disposisi</label>
        <input type="text" name="disposisi" value="<?= $row['disposisi'] ?>" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Keterangan</label>
        <select disabled class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-500 cursor-not-allowed">
          <option value="Acc" <?= $row['keterangan'] == 'Acc' ? 'selected' : '' ?>>Acc</option>
          <option value="Belum di Acc" <?= $row['keterangan'] == 'Belum di Acc' ? 'selected' : '' ?>>Belum di Acc</option>
        </select>
        <input type="hidden" name="keterangan" value="<?= $row['keterangan'] ?>">
      </div>

      <div class="md:col-span-2 text-right">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition">Update Data</button>
        <a href="main.php" class="ml-2 text-blue-500 hover:underline">Kembali</a>
      </div>
    </form>
  </div>
</body>
</html>
