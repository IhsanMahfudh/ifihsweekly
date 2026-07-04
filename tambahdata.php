<?php $pageTitle = "Tambah Data"; include 'partials/header.php'; ?>

<div class="content">
    <h2 class="add-form-title">Tambah Data Mahasiswa</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color:#ef4444; font-weight:600;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form class="add-form" action="simpan.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>:</td>
                <td><input type="text" name="nama" id="nama" required></td>
            </tr>
            <tr>
                <td><label for="nim">NIM</label></td>
                <td>:</td>
                <td><input type="text" name="nim" id="nim" required></td>
            </tr>
            <tr>
                <td><label for="uts">Nilai UTS</label></td>
                <td>:</td>
                <td><input type="number" name="uts" id="uts" min="0" max="100" required></td>
            </tr>
            <tr>
                <td><label for="uas">Nilai UAS</label></td>
                <td>:</td>
                <td><input type="number" name="uas" id="uas" min="0" max="100" required></td>
            </tr>
            <tr>
                <td><label for="tugas">Nilai Tugas</label></td>
                <td>:</td>
                <td><input type="number" name="tugas" id="tugas" min="0" max="100" required></td>
            </tr>
            <tr>
                <td><label for="foto">Foto</label></td>
                <td>:</td>
                <td>
                    <input type="file" name="foto" id="foto" accept="image/*" required>
                    <small style="color:#666;">(Format: JPG, PNG)</small>
                </td>
            </tr>
        </table>
        <input type="submit" value="Tambah Data" class="button">
    </form>
</div>

<?php include 'partials/footer.php'; ?>
