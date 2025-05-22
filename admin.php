<?php
session_start();
include('koneksi.php');

if (isset($_POST['tambah'])) {
    $kode_buku = $_POST['kode_buku'];
    $no_buku = $_POST['no_buku'];
    $judul_buku = $_POST['judul_buku'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $jumlah_halaman = $_POST['jumlah_halaman'];
    $harga = $_POST['harga'];

    
    $gambar_buku = ''; // Default empty
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
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["gambar_buku"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

       
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        
        } else {
            if (move_uploaded_file($_FILES["gambar_buku"]["tmp_name"], $target_file)) {
                $gambar_buku = $target_file; 
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $kode_buku = mysqli_real_escape_string($koneksi, $kode_buku);
    $judul_buku = mysqli_real_escape_string($koneksi, $judul_buku);
    $penulis = mysqli_real_escape_string($koneksi, $penulis);
    $penerbit = mysqli_real_escape_string($koneksi, $penerbit);
    

    $sql = "INSERT INTO buku(kode_buku, no_buku, judul_buku, tahun_terbit, stok, penulis, penerbit, jumlah_halaman, harga, gambar_buku)
            VALUES ('$kode_buku', $no_buku, '$judul_buku', $tahun_terbit, '$stok','$penulis', '$penerbit', $jumlah_halaman, $harga, '$gambar_buku')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Buku berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PAGE</title>
    <style>
      
    </style>
</head>
<body>
    <form action="admin.php" method="post" enctype="multipart/form-data"> <h2>Tambah Buku Baru</h2> <input type="text" name="kode_buku" placeholder="Kode Buku" required>
    <input type="number" name="no_buku" placeholder="Nomor Buku" required>
    <input type="text" name="judul_buku" placeholder="Judul Buku" required>
    <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" required>
    <input type="text" name="stok" placeholder="Stok" required>
    <input type="text" name="penulis" placeholder="Penulis" required>
    <input type="text" name="penerbit" placeholder="Penerbit" required>
    <input type="number" name="jumlah_halaman" placeholder="Jumlah Halaman" required>
    <input type="number" name="harga" placeholder="Harga" required>
    <label for="gambar_buku" style="text-align: left; font-weight: bold; color: #555;">Pilih Gambar Buku:</label>
    <input type="file" name="gambar_buku" id="gambar_buku" accept="image/*" required> <input type="submit" name="tambah" value="TAMBAH BUKU">
    </form>

    <table border="1"> <thead>
            <tr>
                <th>kode buku</th>
                <th>no buku</th>
                <th>judul buku</th>
                <th>tahun terbit</th>
                <th>stok</th>
                <th>penulis</th>
                <th>penerbit</th>
                <th>jumlah halaman</th>
                <th>harga</th>
                <th>gambar buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql="SELECT * FROM buku";
            $row=mysqli_query($koneksi,$sql);
            while ($data = mysqli_fetch_array($row)){
        ?>
            <tr>
                <td><?= htmlspecialchars($data ['kode_buku']) ?></td>
                <td><?= htmlspecialchars($data ['no_buku']) ?></td>
                <td><?= htmlspecialchars($data ['judul_buku']) ?></td>
                <td><?= htmlspecialchars($data ['tahun_terbit']) ?></td>
                <td><?= htmlspecialchars($data ['stok']) ?></td>
                <td><?= htmlspecialchars($data ['penulis']) ?></td>
                <td><?= htmlspecialchars($data ['penerbit']) ?></td>
                <td><?= htmlspecialchars($data ['jumlah_halaman']) ?></td>
                <td><?= htmlspecialchars($data ['harga']) ?></td>
                <td>
                    <?php if ($data['gambar_buku']) { ?>
                        <img src="<?= htmlspecialchars($data['gambar_buku']) ?>" alt="Gambar Buku" width="80px">
                    <?php } else {
                        echo "Tidak ada gambar";
                    } ?>
                </td>
                <td>
                    <a href="edit.php?no_buku=<?= htmlspecialchars($data['no_buku']) ?>">Edit</a>
                    <a href="hapus.php?no_buku=<?= htmlspecialchars($data['no_buku']) ?>">Hapus</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</body>
</html>