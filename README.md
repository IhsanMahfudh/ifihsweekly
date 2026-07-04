# Website Informatika (PHP + MySQL)

Website data mahasiswa dengan CRUD (Tambah, Lihat, Edit, Hapus) menggunakan
PHP native + MySQL, lengkap dengan dark mode toggle.

## Struktur File

```
website/
├── config.php          # Koneksi database
├── database.sql        # Skema tabel + data contoh
├── index.php            # Home
├── Profil.php           # Halaman profil
├── contact.php          # Halaman kontak
├── Mahasiswa.php        # Tabel data mahasiswa (ambil dari MySQL)
├── tambahdata.php       # Form tambah data
├── simpan.php           # Proses simpan data baru (INSERT)
├── edit.php             # Form edit data
├── update.php           # Proses update data (UPDATE)
├── hapus.php            # Proses hapus data (DELETE)
├── partials/
│   ├── header.php       # Header + navbar + dark mode toggle (shared)
│   └── footer.php       # Footer (shared)
├── Aset/
│   ├── CSS/style.css    # Stylesheet
│   └── Image/logo.png   # Logo
└── uploads/             # Folder tempat foto mahasiswa disimpan
```

## Cara Menjalankan (XAMPP / Laragon)

1. **Salin folder** `website` ke dalam folder htdocs, contoh:
   `C:\xampp\htdocs\website` (XAMPP) atau `C:\laragon\www\website` (Laragon).

2. **Buat database**:
   - Buka phpMyAdmin (`http://localhost/phpmyadmin`)
   - Klik tab **Import**, pilih file `database.sql`, lalu klik **Go**.
   - Ini otomatis akan membuat database `informatika_db`, tabel `mahasiswa`,
     dan 3 data contoh.

3. **Sesuaikan koneksi database** di `config.php` bila perlu (default: host
   `localhost`, user `root`, password kosong — pengaturan default XAMPP).

4. **Pastikan folder `uploads/` bisa ditulis** (writable) oleh web server,
   supaya upload foto berhasil.

5. Buka browser ke:
   ```
   http://localhost/website/index.php
   ```

## Fitur

- **Home, Profil, Contact** — halaman statis informasi.
- **Data Mahasiswa** — menampilkan data dari database MySQL (bukan lagi
  localStorage), lengkap dengan foto.
- **Tambah Data** — form upload foto (JPG/PNG) tersimpan ke folder `uploads/`
  dan datanya masuk ke tabel `mahasiswa`.
- **Edit Data** — bisa ubah nama/NIM/nilai, dan opsional ganti foto (foto
  lama otomatis dihapus dari server jika diganti).
- **Hapus Data** — hapus baris dari database sekaligus file fotonya, dengan
  konfirmasi sebelum menghapus.
- **Dark Mode** — tombol 🌙 di pojok kanan atas, preferensi disimpan di
  localStorage browser.
- **Validasi dasar**: NIM tidak boleh duplikat, foto wajib format JPG/PNG,
  semua input pakai prepared statement (aman dari SQL Injection).

## Catatan

- Semua file sudah dicek dengan `php -l` (tidak ada syntax error).
- Belum saya coba jalankan langsung ke server MySQL sungguhan (butuh
  lingkungan XAMPP/Laragon kamu) — jadi setelah di-setup, coba tambah satu
  data dulu untuk memastikan koneksi database & upload foto berjalan lancar.
- Kalau nanti mau di-deploy ke hosting, ganti kredensial di `config.php`
  sesuai database hosting kamu.
