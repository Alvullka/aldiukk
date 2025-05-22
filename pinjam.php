<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $no_buku = $_POST['no_buku'];
    $tanggal = date("Y-m-d");

    $stok = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stok FROM buku WHERE no_buku = $no_buku"))['stok'];
    if ($stok > 0) {
        mysqli_query($koneksi, "INSERT INTO peminjam (nama_peminjam, no_buku, tanggal_pinjam) VALUES ('$nama', $no_buku, '$tanggal')");
        mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE no_buku = $no_buku");
        echo "<script>alert('Peminjaman berhasil!'); window.location='pinjam.php';</script>";
    } else {
        echo "<script>alert('Stok buku habis!');</script>";
    }
    header('location: back1.php');
}
?>

<!DOCTYPE html>
<html>
<head><title>Pinjam Buku</title>
<style>
   
    </style>
</head>
<body>
    <div class="container">
<h2>Form Peminjaman Buku</h2>
<form method="post">
    Nama Peminjam: <input type="text" name="nama" required><br><br>
    Pilih Buku:
    <select name="no_buku" required>
        <option value=""></option>
        <?php
        $buku = mysqli_query($koneksi, "SELECT no_buku, judul_buku, stok FROM buku");
        while($row = mysqli_fetch_assoc($buku)) {
            echo "<option value='{$row['no_buku']}'>{$row['judul_buku']} (Stok: {$row['stok']})</option>";
        }
        ?>
    </select><br><br>
    <button type="submit" name="submit">Pinjam</button>
</form>
</div>
</body>
</html>
