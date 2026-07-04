<?php
$pageTitle = "Edit Data";
include 'config.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$mhs = $stmt->get_result()->fetch_assoc();

if (!$mhs) {
    header('Location: Mahasiswa.php');
    exit;
}

include 'partials/header.php';
?>

<div class="content">
    <h2 class="add-form-title">Edit Data Mahasiswa</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color:#ef4444; font-weight:600;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form class="add-form" action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mhs['id']; ?>">
        <input type="hidden" name="foto_lama" value="<?php echo htmlspecialchars($mhs['foto']); ?>">
        <table>
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>:</td>
                <td><input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($mhs['nama']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="nim">NIM</label></td>
                <td>:</td>
                <td><input type="text" name="nim" id="nim" value="<?php echo htmlspecialchars($mhs['nim']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="uts">Nilai UTS</label></td>
                <td>:</td>
                <td><input type="number" name="uts" id="uts" min="0" max="100" value="<?php echo $mhs['uts']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="uas">Nilai UAS</label></td>
                <td>:</td>
                <td><input type="number" name="uas" id="uas" min="0" max="100" value="<?php echo $mhs['uas']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="tugas">Nilai Tugas</label></td>
                <td>:</td>
                <td><input type="number" name="tugas" id="tugas" min="0" max="100" value="<?php echo $mhs['tugas']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="foto">Foto</label></td>
                <td>:</td>
                <td>
                    <img src="uploads/<?php echo htmlspecialchars($mhs['foto']); ?>" width="50" style="display:block; margin-bottom:8px; border-radius:6px;" onerror="this.src='https://via.placeholder.com/50'">
                    <input type="file" name="foto" id="foto" accept="image/*">
                    <small style="color:#666;">(Kosongkan jika tidak ingin mengganti foto)</small>
                </td>
            </tr>
        </table>
        <input type="submit" value="Update Data" class="button">
        <a href="Mahasiswa.php" class="button" style="background:#9ca3af;">Batal</a>
    </form>
</div>

<?php
include 'partials/footer.php';
$stmt->close();
$conn->close();
?>
