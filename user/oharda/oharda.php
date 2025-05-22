<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LawRegister - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }

    .sidebar-collapsed {
      width: 70px !important;
    }
    .sidebar-collapsed .menu-label {
      display: none;
    }
    .sidebar-collapsed .menu-icon {
      margin: auto;
    }
    
    .active-menu {
      background-color: #3b82f6;
      color: white;
      font-weight: 500;
    }
    
    .table-container {
      overflow-x: auto;
      border-radius: 8px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    thead th {
      position: sticky;
      top: 0;
      z-index: 10;
    }
    
    tbody tr {
      transition: all 0.2s ease;
    }
    
    .search-container {
      position: relative;
    }
    
    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
    }
    
    .notification-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      height: 18px;
      width: 18px;
      background-color: #ef4444;
      border-radius: 50%;
      color: white;
      font-size: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .data-card {
      transition: all 0.2s ease;
    }
    
    .data-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 640px) {
      .responsive-table-card td:before {
        content: attr(data-label);
        font-weight: 500;
        display: block;
        margin-bottom: 4px;
      }
      .responsive-table-card td {
        display: block;
        text-align: right;
        padding: 8px 12px;
      }
    }
    
    input:focus, textarea:focus, select:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
      outline: none;
    }
    
    .btn-primary {
      transition: all 0.2s ease;
    }
    
    .btn-primary:hover {
      transform: translateY(-1px);
    }
    
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body class="bg-gray-100 text-gray-800">
<?php
require_once '../../config.php';

$items_per_page = 7;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $items_per_page;

$sql_total = "SELECT COUNT(*) as total FROM oharda";
$result_total = mysqli_query($mysqli, $sql_total);
$total_surat = mysqli_fetch_assoc($result_total)['total'];

$sql_acc = "SELECT COUNT(*) as count FROM oharda WHERE keterangan = 'Acc'";
$result_acc = mysqli_query($mysqli, $sql_acc);
$total_acc = mysqli_fetch_assoc($result_acc)['count'];

$total_pending = $total_surat - $total_acc;

$sql_data = "SELECT * FROM oharda ORDER BY id DESC LIMIT $offset, $items_per_page";
$result = mysqli_query($mysqli, $sql_data);

$total_pages = ceil($total_surat / $items_per_page);
?>

  <div class="flex h-screen bg-gray-100">
    <aside id="sidebar" class="transition-transform duration-300 transform translate-x-0 flex flex-col bg-white text-gray-700 h-screen fixed top-0 left-0 z-40 border-r border-gray-200 shadow-lg w-64">
      <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
        <div class="flex items-center gap-2" id="sidebar-title">
          <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center">
            <i class="fas fa-scroll text-white"></i>
          </div>
          <div class="text-xl font-bold text-blue-600">LawRegister</div>
        </div>

        <button id="sidebar-toggle" class="text-gray-500 hover:text-gray-700 text-xl focus:outline-none">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <div class="px-4 py-4 border-b border-gray-200">
        <div class="flex items-center gap-3">
          <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
            <i class="fas fa-user text-blue-600"></i>
          </div>
          <div class="menu-label">
            <div class="font-medium">Bagas</div>
            <div class="text-xs text-gray-500">Internship</div>
          </div>
        </div>
      </div>

      <nav class="flex-1 px-2 py-6 space-y-1 overflow-y-auto">
        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider menu-label">Main Menu</p>

        <!-- Surat Masuk -->
        <a href="../surat_masuk/main.php"
          class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition-all <?php echo strpos($_SERVER['PHP_SELF'], 'surat_masuk.php') !== false ? 'bg-blue-500 text-white active-menu' : 'hover:bg-blue-500 hover:text-white'; ?>">
          <i class="fas fa-envelope menu-icon text-lg"></i>
          <span class="menu-label">Surat Masuk</span>
        </a>

        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 menu-label">Jenis Surat</p>

        <!-- Orharda -->
        <a href="../oharda/oharda.php"
          class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition-all <?php echo strpos($_SERVER['PHP_SELF'], 'oharda.php') !== false ? 'bg-blue-500 text-white active-menu' : 'hover:bg-gray-100'; ?>">
          <i class="fas fa-money-bill-wave menu-icon text-lg"></i>
          <span class="menu-label">Oharda</span>
        </a>

        <!-- Kemnegtibum -->
        <a href="../kemnegtibum/kemnegtibum.php"
          class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition-all <?php echo strpos($_SERVER['PHP_SELF'], 'kemnegtibum.php') !== false ? 'bg-blue-500 text-white active-menu' : 'hover:bg-gray-100'; ?>">
          <i class="fas fa-shield-alt menu-icon text-lg"></i>
          <span class="menu-label">Kemnegtibum</span>
        </a>

        <!-- Narkotika -->
        <a href="../narkotika/narkotika.php"
          class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition-all <?php echo strpos($_SERVER['PHP_SELF'], 'narkotika.php') !== false ? 'bg-blue-500 text-white active-menu' : 'hover:bg-gray-100'; ?>">
          <i class="fas fa-pills menu-icon text-lg"></i>
          <span class="menu-label">Narkotika</span>
        </a>
      </nav>
    </aside>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="closeSidebar()"></div>

    <div class="flex-1 transition-all duration-300 ml-0 md:ml-64" id="main-wrapper">

      <header class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 shadow-sm z-30 ml-0 md:ml-64 transition-all duration-300" id="main-header">
        <div class="flex justify-between items-center px-6 py-3">
          <div class="flex items-center gap-3">
            <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-700 mr-2 block md:hidden focus:outline-none">
              <i class="fas fa-bars text-xl"></i>
            </button>
            <div class="text-lg font-semibold text-gray-800">Admin</div>
          </div>
          <div class="flex items-center gap-4">
            <div class="relative">
              <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="far fa-bell"></i>
                <span class="notification-badge">3</span>
              </a>
            </div>
            <div class="relative">
              <button id="profileBtn" class="h-9 w-9 rounded-full bg-blue-100 flex items-center justify-center border border-blue-200 hover:bg-blue-200 transition-colors focus:outline-none">
                <i class="fas fa-user text-blue-600"></i>
              </button>
              <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 py-1" id="dropdownMenu">
                <div class="px-4 py-2 border-b border-gray-100">
                  <p class="font-medium">Admin User</p>
                  <p class="text-xs text-gray-500">admin@example.com</p>
                </div>
                <ul class="py-1 text-sm">
                  <li class="px-4 py-2 hover:bg-gray-50 cursor-pointer flex items-center"><i class="fas fa-user mr-2 text-gray-500"></i>Profile</li>
                  <li class="border-t border-gray-100 mt-1">
                    <a href="../login/logout.php" class="block px-4 py-2 hover:bg-gray-50 text-red-500 flex items-center">
                      <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>

      <main id="main-content" class="pt-16 px-6 pb-8">
        <section class="mb-8">
          <div class="flex items-center justify-between mb-4 mt-6">
            <h2 class="text-xl font-bold text-gray-800">Input Oharda</h2>
            <button id="toggleForm" class="text-blue-600 hover:text-blue-800 flex items-center text-sm font-medium">
              <i class="fas fa-plus-circle mr-1"></i> Input Baru
            </button>
          </div>
          
          <form id="inputForm" action="create.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-8 hidden">

            <!-- No Urut -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">No Urut</label>
              <input type="text" name="no_urut" placeholder="AA/BB" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
            </div>

            <!-- Tanggal Nomor -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Nomor</label>
              <input type="text" name="tanggal_nomor" placeholder="Nomor dan Tanggal" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
            </div>

            <!-- Instansi Penyidik -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">Instansi Penyidik</label>
              <input type="text" name="instansi_penyidik" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
            </div>

            <!-- Tanggal Diterima Kejaksaan -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Diterima Kejaksaan</label>
              <input type="date" name="tgl_diterima_kejaksaan" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
            </div>

            <!-- Identitas Tersangka -->
            <div class="md:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-700">Identitas Tersangka</label>
              <textarea name="identitas_tersangka" rows="3" placeholder="Nama Lengkap, Tempat Lahir, Tanggal Lahir, Jenis Kelamin, Warga Negara, Tempat Tinggal, Agama" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required></textarea>
            </div>

            <!-- Waktu Kejadian -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">Waktu Kejadian</label>
              <input type="datetime-local" name="waktu_kejadian" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
            </div>

            <!-- Tempat Kejadian -->
            <div class="md:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-700">Tempat Kejadian</label>
              <textarea name="tempat_kejadian" rows="2" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required></textarea>
            </div>

            <!-- Pasal Disangkakan -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">Pasal Disangkakan</label>
              <input type="text" name="pasal_disangkakan" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
            </div>

            <!-- Jaksa Peneliti -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">Jaksa Peneliti</label>
              <input type="text" name="jaksa_peneliti" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
            </div>

            <!-- Keterangan -->
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-700">Keterangan</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <i class="fas fa-info-circle text-gray-400"></i>
                </div>
                <select name="keterangan" class="pl-10 w-full border border-gray-300 rounded-lg p-2.5 text-sm bg-white">
                  <option value="Acc">Acc</option>
                  <option value="Belum di Acc">Belum di Acc</option>
                </select>
              </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="md:col-span-2 flex justify-end gap-3 mt-4">
              <button type="reset" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition text-sm">
                Reset
              </button>
              <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                <i class="fas fa-save mr-1"></i> Simpan
              </button>
            </div>
          </form>
        </section>

        <!-- Filter -->
        <section class="mb-5">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="search-container flex-grow max-w-md">
              <div class="relative">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari berdasarkan instansi penyidik atau identitas tersangka..." class="w-full p-2.5 pl-10 border border-gray-300 rounded-lg text-xs" />
              </div>
            </div>
            <div class="flex gap-3">
              <select id="statusFilter" onchange="filterByStatus()" class="border border-gray-300 rounded-lg p-2 text-sm bg-white">
                <option value="all">Semua Status</option>
                <option value="acc">Acc</option>
                <option value="belum">Belum di Acc</option>
              </select>
              <button class="flex items-center gap-1 bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm hover:bg-gray-50 transition" id="filterTanggalButton">
                <i class="fas fa-calendar-alt text-gray-500"></i>
                <span>Filter Tanggal</span>
              </button>
              <div id="tanggalFilter" class="hidden">
                <label for="startDate" class="text-sm">Dari Tanggal:</label>
                <input type="date" id="startDate" class="border border-gray-300 rounded-lg p-2 text-sm bg-white" />
                
                <label for="endDate" class="text-sm">Ke Tanggal:</label>
                <input type="date" id="endDate" class="border border-gray-300 rounded-lg p-2 text-sm bg-white" />

                <button onclick="filterByDate()" class="bg-blue-500 text-white px-3 py-2 rounded-lg">Terapkan Filter</button>
              </div>
            </div>
          </div>
        </section>

        <section class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
          <!-- Desktop Table -->
          <div class="table-container hidden sm:block">
            <table class="w-full text-sm text-left text-gray-700" id="dataTable">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                  <th class="px-5 py-3.5">No. Urut</th>
                  <th class="px-5 py-3.5">Tgl. Nomor</th>
                  <th class="px-5 py-3.5">Instansi Penyidik</th>
                  <th class="px-5 py-3.5">Tgl. Diterima</th>
                  <th class="px-5 py-3.5">Identitas Tersangka</th>
                  <th class="px-5 py-3.5">Waktu & Tempat Kejadian</th>
                  <th class="px-5 py-3.5">Pasal Disangkakan</th>
                  <th class="px-5 py-3.5">Jaksa Peneliti</th>
                  <th class="px-5 py-3.5">Keterangan</th>
                  <th class="px-5 py-3.5">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200" id="tableBody">
                <?php
                if (mysqli_num_rows($result) > 0) {
                  mysqli_data_seek($result, 0);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $keterangan = strtolower(trim($row['keterangan']));
                    $warna_keterangan = $keterangan === 'belum di acc' 
                      ? 'bg-red-100 text-red-800 border border-red-200' 
                      : 'bg-green-100 text-green-800 border border-green-200';
                    $status_icon = $keterangan === 'belum di acc' 
                      ? '<i class="fas fa-clock mr-1"></i>' 
                      : '<i class="fas fa-check mr-1"></i>';
                ?>
                  <tr class="hover:bg-gray-50 data-status-<?php echo $keterangan === 'belum di acc' ? 'belum' : 'acc'; ?>">
                    <td class="px-5 py-4"><?php echo $row['no_urut']; ?></td>
                    <td class="px-5 py-4"><?php echo $row['tanggal_nomor']; ?></td>
                    <td class="px-5 py-4"><?php echo $row['instansi_penyidik']; ?></td>
                    <td class="px-5 py-4"><?php echo $row['tgl_diterima_kejaksaan']; ?></td>
                    <td class="px-5 py-4"><?php echo $row['identitas_tersangka']; ?></td>
                    <td class="px-5 py-4">
                      <div class="text-xs text-gray-500"><?php echo $row['waktu_kejadian']; ?></div>
                      <div><?php echo $row['tempat_kejadian']; ?></div>
                    </td>
                    <td class="px-5 py-4"><?php echo $row['pasal_disangkakan']; ?></td>
                    <td class="px-5 py-4"><?php echo $row['jaksa_peneliti']; ?></td>
                    <td class="px-5 py-4">
                      <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium <?php echo $warna_keterangan; ?> rounded-full">
                        <?php echo $status_icon . $row['keterangan']; ?>
                      </span>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex gap-2">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="text-blue-600 hover:text-blue-900 p-1.5 rounded-full hover:bg-blue-100 transition-all">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-900 p-1.5 rounded-full hover:bg-red-100 transition-all" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                          <i class="fas fa-trash"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php
                  }
                } else {
                  echo "<tr><td colspan='10' class='px-5 py-4 text-center text-gray-500'>Tidak ada data perkara.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>

          <div class="sm:hidden" id="mobileCards">
            <?php
            mysqli_data_seek($result, 0);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $keterangan = strtolower(trim($row['keterangan']));
                $warna_keterangan = $keterangan === 'belum di acc' 
                  ? 'bg-red-100 text-red-800 border border-red-200' 
                  : 'bg-green-100 text-green-800 border border-green-200';
                $status_icon = $keterangan === 'belum di acc' 
                  ? '<i class="fas fa-clock mr-1"></i>' 
                  : '<i class="fas fa-check mr-1"></i>';
            ?>
              <div class="border-b border-gray-200 p-4 data-card data-status-<?php echo $keterangan === 'belum di acc' ? 'belum' : 'acc'; ?>">
                <div class="flex justify-between items-start mb-3">
                  <div>
                    <p class="font-semibold text-gray-800"><?php echo $row['identitas_tersangka']; ?></p>
                    <p class="text-xs text-gray-500 mt-1"><?php echo $row['tanggal_nomor']; ?> · <?php echo $row['no_urut']; ?></p>
                  </div>
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium <?php echo $warna_keterangan; ?> rounded-full">
                    <?php echo $status_icon . $row['keterangan']; ?>
                  </span>
                </div>
                <p class="text-sm mb-2 text-gray-700"><strong>Instansi:</strong> <?php echo $row['instansi_penyidik']; ?></p>
                <p class="text-sm mb-2 text-gray-700"><strong>Pasal:</strong> <?php echo $row['pasal_disangkakan']; ?></p>
                <p class="text-sm mb-2 text-gray-700"><strong>Waktu:</strong> <?php echo $row['waktu_kejadian']; ?> | <strong>Tempat:</strong> <?php echo $row['tempat_kejadian']; ?></p>
                <p class="text-sm mb-3 text-gray-700"><strong>Jaksa:</strong> <?php echo $row['jaksa_peneliti']; ?></p>
                <div class="flex justify-end gap-3">
                  <a href="edit.php?id=<?php echo $row['id']; ?>" class="text-blue-600 p-1.5 rounded-full hover:bg-blue-100 transition-all">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="delete.php?id=<?php echo $row['id']; ?>" class="text-red-600 p-1.5 rounded-full hover:bg-red-100 transition-all" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
              </div>
            <?php
              }
            } else {
              echo "<div class='py-6 px-4 text-center text-gray-500'>Tidak ada data perkara.</div>";
            }
            ?>
          </div>

          <div class="px-5 py-3 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
            <div class="text-xs text-gray-600">
              Showing <span class="font-medium"><?php echo ($page - 1) * $items_per_page + 1; ?></span>
              to <span class="font-medium"><?php echo min($page * $items_per_page, $total_surat); ?></span>
              of <span class="font-medium"><?php echo $total_surat; ?></span> entries
            </div>
            <div class="flex space-x-1">
              <a href="?page=<?php echo max(1, $page - 1); ?>" class="px-3 py-1 rounded border border-gray-300 text-sm bg-white <?php echo ($page == 1 ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-50 text-gray-700'); ?>">
                <i class="fas fa-chevron-left text-xs"></i>
              </a>

              <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="px-3 py-1 rounded border text-sm <?php echo ($i == $page ? 'bg-blue-500 border-blue-500 text-white' : 'bg-white border-gray-300 hover:bg-gray-50 text-gray-700'); ?>">
                  <?php echo $i; ?>
                </a>
              <?php endfor; ?>
              
              <a href="?page=<?php echo min($total_pages, $page + 1); ?>" class="px-3 py-1 rounded border border-gray-300 text-sm bg-white <?php echo ($page == $total_pages ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-gray-50 text-gray-700'); ?>">
                <i class="fas fa-chevron-right text-xs"></i>
              </a>
            </div>
          </div>
        </section>
      </main>

      <footer class="bg-white border-t border-gray-200 py-4 text-center text-gray-600 text-xs mt-auto transition-all duration-300" id="main-footer">
        <div class="px-6">
          <p>&copy; 2025 gister. All rights reserved.</p>
          <p class="mt-1">Developed by Your IT Department</p>
        </div>
      </footer>
    </div>
  </div>

<script>
  const sidebar = document.getElementById('sidebar');
  const mainWrapper = document.getElementById('main-wrapper');
  const mainHeader = document.getElementById('main-header');
  const mainFooter = document.getElementById('main-footer');
  const sidebarTitle = document.getElementById('sidebar-title');
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const sidebarOverlay = document.getElementById('sidebar-overlay');
  const profileBtn = document.getElementById('profileBtn');
  const dropdownMenu = document.getElementById('dropdownMenu');
  const toggleFormBtn = document.getElementById('toggleForm');
  const inputForm = document.getElementById('inputForm');

  toggleFormBtn.addEventListener('click', () => {
    inputForm.classList.toggle('hidden');
    if (inputForm.classList.contains('hidden')) {
      toggleFormBtn.innerHTML = '<i class="fas fa-plus-circle mr-1"></i> Input Baru';
    } else {
      toggleFormBtn.innerHTML = '<i class="fas fa-minus-circle mr-1"></i> Tutup Form';
      inputForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });

  profileBtn.addEventListener('click', () => dropdownMenu.classList.toggle('hidden'));
  document.addEventListener('click', (e) => {
    if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.classList.add('hidden');
    }
  });

  sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar-collapsed');

    if (sidebar.classList.contains('sidebar-collapsed')) {
      mainWrapper.classList.remove('md:ml-64');
      mainWrapper.classList.add('md:ml-16');
      mainHeader.classList.remove('md:ml-64');
      mainHeader.classList.add('md:ml-16');
      mainFooter.classList.remove('md:ml-64');
      mainFooter.classList.add('md:ml-16');

      if (sidebarTitle) sidebarTitle.style.display = 'none';

    } else {
      mainWrapper.classList.remove('md:ml-16');
      mainWrapper.classList.add('md:ml-64');
      mainHeader.classList.remove('md:ml-16');
      mainHeader.classList.add('md:ml-64');
      mainFooter.classList.remove('md:ml-16');
      mainFooter.classList.add('md:ml-64');

      if (sidebarTitle) sidebarTitle.style.display = 'flex';
    }
  });

  mobileMenuButton.addEventListener('click', () => {
    sidebar.classList.toggle('transform');
    sidebar.classList.toggle('-translate-x-full');
    sidebarOverlay.classList.toggle('hidden');
  });

  function closeSidebar() {
    sidebar.classList.add('transform');
    sidebar.classList.add('-translate-x-full');
    sidebarOverlay.classList.add('hidden');
  }

  window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
      sidebar.classList.add('transform');
      sidebar.classList.add('-translate-x-full');
      mainWrapper.classList.remove('ml-64', 'ml-16');
      mainHeader.classList.remove('ml-64', 'ml-16');
      mainFooter.classList.remove('ml-64', 'ml-16');
    } else {
      sidebar.classList.remove('transform', '-translate-x-full');
      sidebarOverlay.classList.add('hidden');

      if (sidebar.classList.contains('sidebar-collapsed')) {
        mainWrapper.classList.add('md:ml-16');
        mainHeader.classList.add('md:ml-16');
        mainFooter.classList.add('md:ml-16');

        if (sidebarTitle) sidebarTitle.style.display = 'none';
      } else {
        mainWrapper.classList.add('md:ml-64');
        mainHeader.classList.add('md:ml-64');
        mainFooter.classList.add('md:ml-64');

        if (sidebarTitle) sidebarTitle.style.display = 'flex';
      }
    }
  });

  if (window.innerWidth < 768) {
    sidebar.classList.add('transform', '-translate-x-full');
  }

  function searchTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();

    document.querySelectorAll('#tableBody tr').forEach(row => {
      const asal = row.children[2]?.textContent.toLowerCase() || "";
      const isi = row.children[4]?.textContent.toLowerCase() || "";
      row.style.display = asal.includes(input) || isi.includes(input) ? '' : 'none';
    });

    document.querySelectorAll('#mobileCards > div').forEach(card => {
      const cardText = card.textContent.toLowerCase();
      card.style.display = cardText.includes(input) ? '' : 'none';
    });
  }

  // filter by status
  function filterByStatus() {
    const status = document.getElementById('statusFilter').value;

    document.querySelectorAll('#tableBody tr').forEach(row => {
      row.style.display = (status === 'all' || row.classList.contains(`data-status-${status}`)) ? '' : 'none';
    });

    document.querySelectorAll('#mobileCards > div').forEach(card => {
      card.style.display = (status === 'all' || card.classList.contains(`data-status-${status}`)) ? '' : 'none';
    });
  }

  // Menampilkan form filter tanggal
  document.getElementById('filterTanggalButton').addEventListener('click', function() {
    const tanggalFilter = document.getElementById('tanggalFilter');
    tanggalFilter.classList.toggle('hidden');
  });

  // Fungsi untuk filter berdasarkan tanggal
  function filterByDate() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    document.querySelectorAll('#tableBody tr').forEach(row => {
      const rowDate = row.cells[3].textContent.trim(); // Mengambil tanggal dari kolom kedua (Tgl. Nomor)
      const rowDateObj = new Date(rowDate); // Mengubah ke objek Date untuk perbandingan

      // Periksa apakah tanggal berada dalam rentang yang dipilih
      const isWithinDateRange = (!startDate || rowDateObj >= new Date(startDate)) &&
                                (!endDate || rowDateObj <= new Date(endDate));

      row.style.display = isWithinDateRange ? '' : 'none';
    });

    document.querySelectorAll('#mobileCards > div').forEach(card => {
      const cardDate = card.querySelector('.card-date').textContent.trim(); // Pastikan card memiliki elemen tanggal
      const cardDateObj = new Date(cardDate);

      const isCardWithinDateRange = (!startDate || cardDateObj >= new Date(startDate)) &&
                                    (!endDate || cardDateObj <= new Date(endDate));

      card.style.display = isCardWithinDateRange ? '' : 'none';
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.data-card').forEach((card, index) => {
      setTimeout(() => {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
      }, 100 * index);
    });
  });
</script>
</body>
</html>