<?php
// Tentukan base URL secara dinamis
$base_url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Inventaris Aset</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <img src="assets/images/logo.png" alt="logo" height="50px">
            <a class="navbar-brand" href="<?php echo $base_url; ?>">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_url; ?>">HOME</a>
                    </li>
                     <!-- Dropdown ASET -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAset" role="button" data-bs-toggle="dropdown">
                        ASET
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>/add.php">Tambah Aset</a></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>/list.php">Daftar Aset</a></li>
                    </ul>
                </li>

                <!-- Dropdown DATA -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownData" role="button" data-bs-toggle="dropdown">
                        DATA
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>/report.php">Kategori</a></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>/history.php">Merk</a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">