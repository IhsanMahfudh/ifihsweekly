<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data | Informatika</title>
    <link rel="stylesheet" href="Aset/CSS/style.css">
</head>
<!-- Dark Mode Toggle -->
<button class="dark-mode-toggle" onclick="toggleDarkMode()" title="Toggle Dark Mode">🌙</button>

<script>
function toggleDarkMode() {
    document.body.classList.toggle('dark');
    // Simpan preferensi
    if (document.body.classList.contains('dark')) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.removeItem('darkMode');
    }
}

// Load preferensi saat halaman dibuka
if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark');
}
</script>
<body>
    <div class="content">
    <h2 class="add-form-title">Tambah Data Mahasiswa</h2>
    <form class="add-form" id="formTambah" onsubmit="handleTambah(event)">
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
</div>
</body>
</html>
