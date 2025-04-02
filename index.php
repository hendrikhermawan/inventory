<?php include "includes/header.php"; ?>
<h1>Daftar Inventaris Aset</h1>
<a href="add.php" class="btn btn-primary mb-3">Tambah Aset</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>No Inventaris</th>
            <th>Nama Aset</th>
            <th>Tipe Aset</th>
            <th>Kategori</th>
            <th>Tahun Perolehan</th>
            <th>Harga Beli</th>
            <th>Nilai Saat Ini</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>QR Code</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "includes/db_connect.php";
        $result = mysqli_query($conn, "
            SELECT a.*, c.nama_kategori AS sub_kategori, p.nama_kategori AS kategori_utama, l.nama_lokasi
            FROM assets a
            LEFT JOIN categories c ON a.kategori_id = c.id
            LEFT JOIN categories p ON c.parent_id = p.id
            LEFT JOIN locations l ON a.lokasi_id = l.id
        ");
        $qr_data_array = [];
        if (!$result) {
            echo "<tr><td colspan='12'>Error: " . mysqli_error($conn) . "</td></tr>";
        } elseif (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tahun_sekarang = date("Y");
                $umur = $tahun_sekarang - $row['tahun_perolehan'];
                $penyusutan_tahunan = $row['harga_beli'] / $row['umur_ekonomis'];
                $nilai_saat_ini = $row['harga_beli'] - ($penyusutan_tahunan * $umur);
                $nilai_saat_ini = max($nilai_saat_ini, 0);

                $qr_data = "ID: {$row['id']}\nNo Inventaris: {$row['no_inventaris']}\nNama: {$row['nama_aset']}\nLokasi: {$row['nama_lokasi']}";
                $qr_data_array[] = ['id' => $row['id'], 'text' => $qr_data];

                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['no_inventaris']}</td>";
                echo "<td>{$row['nama_aset']}</td>";
                echo "<td>" . (isset($row['tipe_aset']) ? $row['tipe_aset'] : '-') . "</td>";
                echo "<td>" . (isset($row['tipe_aset']) && $row['tipe_aset'] == 'IT' ? "{$row['kategori_utama']} - {$row['sub_kategori']}" : '-') . "</td>";
                echo "<td>{$row['tahun_perolehan']}</td>";
                echo "<td>Rp " . number_format($row['harga_beli'], 2) . "</td>";
                echo "<td>Rp " . number_format($nilai_saat_ini, 2) . "</td>";
                echo "<td>{$row['nama_lokasi']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>
                    <div id='qrcode-{$row['id']}' style='width: 100px; height: 100px;'></div>
                </td>";
                echo "<td>
                    <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
                    <a href='history.php?id={$row['id']}' class='btn btn-secondary btn-sm'>Riwayat</a>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>Tidak ada data aset.</td></tr>";
        }
        ?>
    </tbody>
</table>
<!-- Debugging Base URL -->
<?php echo "<!-- Base URL: $base_url -->"; ?>
<!-- Include library QR code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<!-- Include file JavaScript untuk generate QR code -->
<script src="<?php echo $base_url; ?>/assets/js/qrcode.js"></script>
<!-- Kirim data QR code ke JavaScript -->
<script>
    window.qrData = <?php echo json_encode($qr_data_array); ?>;
    console.log('QR Data:', window.qrData);
</script>
<?php include "includes/footer.php"; ?>