<!-- HEADER.PHP -->
<?php
$base_url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistem Manajemen Inventaris Aset</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/style.css">
</head>
<body>
<!-- Navbar fixed-top -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
  <div class="container-fluid">
    <img src="assets/images/logo.png" alt="logo" height="40px" class="me-2" />
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>">HOME</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">ASET</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="add.php">Tambah Aset</a></li>
            <li><a class="dropdown-item" href="list.php">Daftar Aset</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">DATA</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="report.php">Kategori</a></li>
            <li><a class="dropdown-item" href="history.php">Merk</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar text-white">
  <h5 class="text-center">Menu</h5>
  <ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link text-white" href="index.php">🏠 Dashboard</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="inventaris.php">➕ Inventaris</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="gudang.php">📂 Gudang</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="laporan.php">📍 Laporan</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="logout.php">🚪 Logout</a></li>
  </ul>
</div>

<!-- Konten yang bisa discroll -->
<div class="content-wrapper">
