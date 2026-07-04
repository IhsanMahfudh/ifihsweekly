<?php
include 'config.php';

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    // Hapus foto fisik juga
    $stmt = $conn->prepare("SELECT foto FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($row && $row['foto']) {
        $fotoPath = __DIR__ . '/uploads/' . $row['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }
    }

    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header('Location: Mahasiswa.php');
exit;
