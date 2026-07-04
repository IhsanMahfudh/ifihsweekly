<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambahdata.php');
    exit;
}

$nama  = trim($_POST['nama'] ?? '');
$nim   = trim($_POST['nim'] ?? '');
$uts   = (int)($_POST['uts'] ?? 0);
$uas   = (int)($_POST['uas'] ?? 0);
$tugas = (int)($_POST['tugas'] ?? 0);

if ($nama === '' || $nim === '') {
    header('Location: tambahdata.php?error=' . urlencode('Nama dan NIM wajib diisi.'));
    exit;
}

// Cek duplikat NIM
$stmt = $conn->prepare("SELECT id FROM mahasiswa WHERE nim = ?");
$stmt->bind_param("s", $nim);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    header('Location: tambahdata.php?error=' . urlencode('NIM sudah terdaftar.'));
    exit;
}
$stmt->close();

// Upload foto
$fotoName = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $allowedExt = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExt)) {
        header('Location: tambahdata.php?error=' . urlencode('Format foto harus JPG atau PNG.'));
        exit;
    }

    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Nama file unik agar tidak bentrok
    $fotoName = uniqid('mhs_') . '.' . $ext;
    $targetPath = $uploadDir . $fotoName;

    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
        header('Location: tambahdata.php?error=' . urlencode('Gagal mengupload foto.'));
        exit;
    }
} else {
    header('Location: tambahdata.php?error=' . urlencode('Foto wajib diupload.'));
    exit;
}

$stmt = $conn->prepare("INSERT INTO mahasiswa (nama, nim, uts, uas, tugas, foto) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiiis", $nama, $nim, $uts, $uas, $tugas, $fotoName);

if ($stmt->execute()) {
    header('Location: Mahasiswa.php');
    exit;
} else {
    header('Location: tambahdata.php?error=' . urlencode('Gagal menyimpan data ke database.'));
    exit;
}
