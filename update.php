<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Mahasiswa.php');
    exit;
}

$id       = (int)($_POST['id'] ?? 0);
$nama     = trim($_POST['nama'] ?? '');
$nim      = trim($_POST['nim'] ?? '');
$uts      = (int)($_POST['uts'] ?? 0);
$uas      = (int)($_POST['uas'] ?? 0);
$tugas    = (int)($_POST['tugas'] ?? 0);
$fotoLama = $_POST['foto_lama'] ?? '';
$fotoName = $fotoLama;

if ($nama === '' || $nim === '' || $id <= 0) {
    header('Location: edit.php?id=' . $id . '&error=' . urlencode('Nama dan NIM wajib diisi.'));
    exit;
}

// Jika ada foto baru diupload, ganti foto lama
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $allowedExt = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExt)) {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode('Format foto harus JPG atau PNG.'));
        exit;
    }

    $uploadDir = __DIR__ . '/uploads/';
    $fotoName = uniqid('mhs_') . '.' . $ext;
    $targetPath = $uploadDir . $fotoName;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
        // Hapus foto lama jika ada
        if ($fotoLama && file_exists($uploadDir . $fotoLama)) {
            unlink($uploadDir . $fotoLama);
        }
    } else {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode('Gagal mengupload foto baru.'));
        exit;
    }
}

$stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, nim=?, uts=?, uas=?, tugas=?, foto=? WHERE id=?");
$stmt->bind_param("ssiiisi", $nama, $nim, $uts, $uas, $tugas, $fotoName, $id);

if ($stmt->execute()) {
    header('Location: Mahasiswa.php');
    exit;
} else {
    header('Location: edit.php?id=' . $id . '&error=' . urlencode('Gagal menyimpan perubahan.'));
    exit;
}
