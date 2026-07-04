<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: Mahasiswa.php');
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    }
}

$pageTitle = "Login";
include 'partials/header.php';
?>

<div class="content">
    <h2 class="add-form-title">Login</h2>

    <?php if ($error): ?>
        <p style="color:#ef4444; font-weight:600;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['registered'])): ?>
        <p style="color:#16a34a; font-weight:600;">Registrasi berhasil, silakan login.</p>
    <?php endif; ?>

    <form class="add-form" action="login.php" method="POST" style="max-width:400px;">
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
        </table>
        <input type="submit" value="Login" class="button">
    </form>
    <p style="margin-top:14px;">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</div>

<?php
include 'partials/footer.php';
$conn->close();
?>