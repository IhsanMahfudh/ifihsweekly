<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | Informatika' : 'Informatika'; ?></title>
    <link rel="stylesheet" href="Aset/CSS/style.css">
</head>
<body>
<!-- Dark Mode Toggle -->
<button class="dark-mode-toggle" onclick="toggleDarkMode()" title="Toggle Dark Mode">🌙</button>

<script>
function toggleDarkMode() {
    document.body.classList.toggle('dark');
    if (document.body.classList.contains('dark')) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.removeItem('darkMode');
    }
}
if (localStorage.getItem('darkMode') === 'enabled') {
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('dark');
    });
}
</script>

<div class="container">
    <div class="header">
        <img class="logo" src="Aset/Image/logo.png" alt="Logo Informatika">
        <h1>INFORMATIKA</h1>
    </div>

    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Profil.php">Profil</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="Mahasiswa.php">Data Mahasiswa</a></li>
        </ul>
    </nav>
