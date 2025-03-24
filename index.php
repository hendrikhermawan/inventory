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
        // data dari db_connect
        include "includes/db_connect.php";
        $result = mysqli_query($conn, "
            SELECT a.*, c.nama_kategori AS sub_kategori, p.nama_kategori AS kategori_utama, l.nama_lokasi
            FROM assets a
            LEFT JOIN categories c ON a.kategori_id = c.id
            LEFT JOIN categories p ON c.parent_id = p.id
            LEFT JOIN locations l ON a.lokasi_id = l.id
        ");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tahun_sekarang = date("Y");
                $umur = $tahun_sekarang - $row['tahun_perolehan'];
                $penyusutan_tahunan = $row['harga_beli'] / $row['umur_ekonomis'];
                $nilai_saat_ini = $row['harga_beli'] - ($penyusutan_tahunan * $umur);
                $nilai_saat_ini = max($nilai_saat_ini, 0);

                $qr_data = "ID: {$row['id']}\nNo Inventaris: {$row['no_inventaris']}\nNama: {$row['nama_aset']}\nLokasi: {$row['nama_lokasi']}";

                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['no_inventaris']}</td>";
                echo "<td>{$row['nama_aset']}</td>";
                echo "<td>{$row['tipe_aset']}</td>";
                echo "<td>" . ($row['tipe_aset'] == 'IT' ? "{$row['kategori_utama']} - {$row['sub_kategori']}" : '-') . "</td>";
                echo "<td>{$row['tahun_perolehan']}</td>";
                echo "<td>Rp " . number_format($row['harga_beli'], 2) . "</td>";
                echo "<td>Rp " . number_format($nilai_saat_ini, 2) . "</td>";
                echo "<td>{$row['nama_lokasi']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>
                    <div id='qrcode-{$row['id']}'></div>
                    <a href='#' class='btn btn-sm btn-info mt-2 download-qr' data-id='{$row['id']}'>Download QR</a>
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
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.0/build/qrcode.min.js"></script>
<script>
    <?php
    $result = mysqli_query($conn, "
        SELECT a.id, a.no_inventaris, a.nama_aset, l.nama_lokasi 
        FROM assets a 
        LEFT JOIN locations l ON a.lokasi_id = l.id
    ");
    while ($row = mysqli_fetch_assoc($result)) {
        $qr_data = "ID: {$row['id']}\\nNo Inventaris: {$row['no_inventaris']}\\nNama: {$row['nama_aset']}\\nLokasi: {$row['nama_lokasi']}";
        echo "QRCode.toCanvas(document.getElementById('qrcode-{$row['id']}'), '$qr_data', { width: 100 });";
    }
    ?>
    document.querySelectorAll('.download-qr').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const canvas = document.getElementById('qrcode-' + this.dataset.id);
            const link = document.createElement('a');
            link.download = 'qrcode-asset-' + this.dataset.id + '.png';
            link.href = canvas.toDataURL();
            link.click();
        });
    });
</script>
<?php include "includes/footer.php"; ?>