<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    if ($username === '' || $password === '' || $confirm === '') {
        $error = 'Semua kolom wajib diisi.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } elseif ($password !== $confirm) {
        $error = 'Konfirmasi password tidak cocok.';
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $error = 'Username sudah digunakan.';
        }
        $stmt->close();

        if ($error === '') {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed);
            if ($stmt->execute()) {
                header('Location: login.php?registered=1');
                exit;
            } else {
                $error = 'Gagal mendaftarkan akun.';
            }
        }
    }
}

$pageTitle = "Register";
include 'partials/header.php';
?>

<div class="content">
    <h2 class="add-form-title">Register Akun Baru</h2>

    <?php if ($error): ?>
        <p style="color:#ef4444; font-weight:600;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form class="add-form" action="register.php" method="POST" style="max-width:400px;">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td>:</td>
                <td><input type="text" name="username" id="username" required></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td>:</td>
                <td><input type="password" name="password" id="password" required></td>
            </tr>
            <tr>
                <td><label for="confirm">Ulangi Password</label></td>
                <td>:</td>
                <td><input type="password" name="confirm" id="confirm" required></td>
            </tr>
        </table>
        <input type="submit" value="Daftar" class="button">
    </form>
    <p style="margin-top:14px;">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>

<?php
include 'partials/footer.php';
$conn->close();
?>