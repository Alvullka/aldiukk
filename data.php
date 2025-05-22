<?php
session_start();
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <style>
        /* Reset default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Orbitron', sans-serif; /* Tambahkan font cyberpunk kalau bisa */
    background-color: #0f0f0f;
    color: #fff;
    padding: 40px;
    background-image: linear-gradient(135deg, #ff00ff33 25%, #00ffff33 75%);
    background-size: 200% 200%;
    animation: bgMove 10s infinite alternate;
}

/* Background gradient animation */
@keyframes bgMove {
    0% { background-position: left top; }
    100% { background-position: right bottom; }
}

/* Heading */
h2 {
    color: #00ffff;
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
    text-shadow: 0 0 10px #00ffff, 0 0 20px #ff00ff;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: rgba(0, 0, 0, 0.6);
    border: 2px solid #00ffff;
    box-shadow: 0 0 20px #00ffff55;
}

th, td {
    padding: 12px 15px;
    border: 1px solid #00ffff55;
    text-align: center;
    color: #ffffff;
}

th {
    background-color: #1a1a1a;
    color: #00ffff;
    text-shadow: 0 0 5px #00ffff;
    font-size: 16px;
}

td {
    background-color: rgba(255, 255, 255, 0.05);
    font-size: 14px;
    transition: background-color 0.3s ease;
}

/* Row hover effect */
tr:hover td {
    background-color: rgba(0, 255, 255, 0.1);
    cursor: pointer;
}

/* Image style */
img {
    border-radius: 5px;
    box-shadow: 0 0 10px #ff00ff;
    transition: transform 0.3s ease;
}

img:hover {
    transform: scale(1.2);
}

/* Scrollable on small screens */
@media (max-width: 768px) {
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
}

    </style>
<body>
    <h2>DAFTAR BUKU</h2>
    <table border="1">
        <tr>
            <th>KODE BUKU</th>
            <th>NO BUKU</th>
            <th>JUDUL BUKU</th>
            <th>TAHUN TERBIT</th>
            <th>STOK</th>
            <th>NAMA PENULIS</th>
            <th>PENERBIT</th>
            <th>JUMLAH HALAMAN</th>
            <th>HARGA</th>
            <th>GAMBAR</th>
            </tr>


            <?php
               $sql = mysqli_query($koneksi, "SELECT * FROM buku");
               while($data = mysqli_fetch_array($sql)){

                ?>
                <tr>
                <td><?=$data['kode_buku']?></td>
                <td><?=$data['no_buku']?></td>
                <td><?=$data['judul_buku']?></td>
                <td><?=$data['tahun_terbit']?></td>
                <td><?=$data['stok']?></td>
                <td><?=$data['penulis']?></td>
                <td><?=$data['penerbit']?></td>
                <td><?=$data['jumlah_halaman']?></td>
                <td><?=$data['harga']?></td>
               <td>
                <img src="<?=$data['gambar_buku']?> "alt="cover" width= "80px">
               </td>
               <td class="action-buttons">
                    <a href="pinjam.php?kode_buku=<?= urlencode($data['kode_buku']) ?>" class="borrow-btn">Pinjam</a>
                    <a href="kembalikan.php?kode_buku=<?= urlencode($data['kode_buku']) ?>" class="return-btn">Kembalikan</a>
                </td>
             </tr>
               <?php
               }   
            ?>
        </table>    
</body>
</html>