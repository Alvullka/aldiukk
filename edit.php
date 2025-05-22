<?php
session_start();
include("koneksi.php");

$data = [];

if(isset($_GET['no_buku'])){
    $id_to_edit = $_GET['no_buku'];
    $sql_select = "SELECT * FROM buku WHERE no_buku=$id_to_edit";
    $result_select = mysqli_query($koneksi,$sql_select);

    if($result_select && mysqli_num_rows($result_select) > 0){
        $data = mysqli_fetch_assoc($result_select);
    } else {
        echo "<script>alert('Buku tidak ditemukan!'); window.location.href='admin.php';</script>";
        exit;
    }
}

if(isset($_POST['edit'])){
    $id = $_POST['no_buku_lama']; 
    $kode_buku = $_POST['kode_buku'];
    $no_buku = $_POST['no_buku'];
    $judul_buku = $_POST['judul_buku'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $jumlah_halaman = $_POST['jumlah_halaman'];
    $harga = $_POST['harga'];

    $gambar_buku_path = $_POST['gambar_buku_lama'] ?? '';

    // --- File Upload Logic ---
    if (isset($_FILES['gambar_buku']) && $_FILES['gambar_buku']['error'] == 0) {
        $target_dir = "uploads/"; 
        if (!is_dir($target_dir)) { 
            mkdir($target_dir, 0777, true);
        }

        $file_name = basename($_FILES["gambar_buku"]["name"]);
        $target_file = $target_dir . uniqid() . "_" . $file_name; 
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        
        $check = getimagesize($_FILES["gambar_buku"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File bukan gambar.');</script>";
            $uploadOk = 0;
        }

      
        if ($_FILES["gambar_buku"]["size"] > 5000000) {
            echo "<script>alert('Ukuran file terlalu besar (Max 5MB).');</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "mp4" ) {
            echo "<script>alert('Hanya format JPG, JPEG, PNG, GIF & MP4 yang diizinkan.');</script>";
            $uploadOk = 0;
        }

        
        if ($uploadOk == 0) {
            echo "<script>alert('Maaf, file Anda tidak terunggah.');</script>";
        } else {
            if (move_uploaded_file($_FILES["gambar_buku"]["tmp_name"], $target_file)) {
                
                if (!empty($gambar_buku_path) && file_exists($gambar_buku_path)) {
                    unlink($gambar_buku_path);
                }
                $gambar_buku_path = $target_file;
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file Anda.');</script>";
            }
        }
    }
    

    $kode_buku = mysqli_real_escape_string($koneksi, $kode_buku);
    $judul_buku = mysqli_real_escape_string($koneksi, $judul_buku);
    $penulis = mysqli_real_escape_string($koneksi, $penulis);
    $penerbit = mysqli_real_escape_string($koneksi, $penerbit);

    $sql_update = "UPDATE buku SET
        kode_buku='$kode_buku',
        no_buku=$no_buku,
        judul_buku='$judul_buku',
        tahun_terbit=$tahun_terbit,
        stok=$stok,
        penulis='$penulis',
        penerbit='$penerbit',
        jumlah_halaman=$jumlah_halaman,
        harga=$harga,
        gambar_buku='$gambar_buku_path'
        WHERE no_buku=$id";

        echo "<pre>$sql_update</pre>";

    if (mysqli_query($koneksi, $sql_update)) {
        echo "<script>alert('Buku berhasil diupdate!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . mysqli_error($koneksi) . "');</script>";
    }
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Buku</title>
    <style>
     
    </style>
</head>
<body>
    <form action="edit.php" method="post" enctype="multipart/form-data"> <h2>Edit Data Buku</h2>
        <input type="hidden" name="no_buku_lama" value="<?= htmlspecialchars($data['no_buku'] ?? '') ?>"> <input type="hidden" name="gambar_buku_lama" value="<?= htmlspecialchars($data['gambar_buku'] ?? '') ?>"> <input type="text" name="kode_buku" placeholder="Kode Buku" value="<?= htmlspecialchars($data['kode_buku'] ?? '') ?>" required>
        <input type="number" name="no_buku" placeholder="Nomor Buku" value="<?= htmlspecialchars($data['no_buku'] ?? '') ?>" required>
        <input type="text" name="judul_buku" placeholder="Judul Buku" value="<?= htmlspecialchars($data['judul_buku'] ?? '') ?>" required>
        <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" value="<?= htmlspecialchars($data['tahun_terbit'] ?? '') ?>" required>
         <input type="text" name="stok" placeholder="Stok Buku" value="<?= htmlspecialchars($data['stok'] ?? '') ?>" required>
        <input type="text" name="penulis" placeholder="Penulis" value="<?= htmlspecialchars($data['penulis'] ?? '') ?>" required>
        <input type="text" name="penerbit" placeholder="Penerbit" value="<?= htmlspecialchars($data['penerbit'] ?? '') ?>" required>
        <input type="number" name="jumlah_halaman" placeholder="Jumlah Halaman" value="<?= htmlspecialchars($data['jumlah_halaman'] ?? '') ?>" required>
        <input type="number" name="harga" placeholder="Harga" value="<?= htmlspecialchars($data['harga'] ?? '') ?>" required>

        <label for="gambar_buku" style="text-align: left; font-weight: bold; color: #555;">Gambar Buku:</label>
        <?php if (!empty($data['gambar_buku'])) { ?>
            <div class="current-image-container">
                <p>Gambar Saat Ini:</p>
                <img src="<?= htmlspecialchars($data['gambar_buku']) ?>" alt="Gambar Buku Saat Ini">
                <p>Pilih file baru untuk mengganti gambar.</p>
            </div>
        <?php } else { ?>
            <p style="text-align: center; color: #777;">Belum ada gambar buku.</p>
        <?php } ?>
        <input type="file" name="gambar_buku" id="gambar_buku" accept="image/*"> <input type="submit" name="edit" value="UPDATE BUKU">
    </form>
</body>
</html>