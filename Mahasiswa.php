<?php
   include 'partials/auth_check.php';
   $pageTitle = "Data Mahasiswa";
   include 'config.php';
   include 'partials/header.php';

$result = $conn->query("SELECT * FROM mahasiswa ORDER BY id ASC");
?>

<div class="content">
    <h2>Data Mahasiswa</h2>
    <a href="tambahdata.php" class="button">Tambah Data</a>

    <table class="data-table" id="tabelMahasiswa">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Foto</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Tugas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['nim']); ?></td>
                <td>
                    <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>"
                         alt="<?php echo htmlspecialchars($row['nama']); ?>"
                         width="50"
                         onerror="this.src='https://via.placeholder.com/50'">
                </td>
                <td><?php echo $row['uts']; ?></td>
                <td><?php echo $row['uas']; ?></td>
                <td><?php echo $row['tugas']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="button" style="background:#eab308; padding:6px 12px; font-size:0.9rem;">Edit</a>
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" class="button" style="background:#ef4444; padding:6px 12px; font-size:0.9rem;"
                       onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
include 'partials/footer.php';
$conn->close();
?>
