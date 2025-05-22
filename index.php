<?php
    session_start();
    include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <style>
        /* General body styling */
body {
    font-family: Arial, sans-serif;
    margin: 0; /* Remove default margin */
    padding: 20px; /* Add some padding around the main content */
    min-height: 100vh; /* Ensure the background covers at least the full viewport height */
    
    /* Subtle Blue Sky Gradient */
    background: linear-gradient(to bottom, #E0F2F7, #F0F8FF); /* Very light blue to almost white */
    /* Alternative: More pronounced blue
    background: linear-gradient(to bottom, #ADD8E6, #B0E0E6); /* Light blue to Powder Blue */
    */
    color: #333; /* Default text color */
}

/* Styles for the main data container to make it stand out against the background */
.data-container {
    max-width: 1200px;
    margin: 0 auto; /* Center the container */
    background-color: rgba(255, 255, 255, 0.95); /* Slightly transparent white for content */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Soft shadow */
}

/* Existing table styles (assuming you have them or need them) */
.book-data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.book-data-table th,
.book-data-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.book-data-table th {
    background-color: #f2f2f2;
    color: #555;
}

.book-data-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.book-data-table img {
    max-width: 100px; /* Make the book cover image smaller */
    height: auto;
    display: block; /* Remove extra space below image */
    margin: 0 auto; /* Center the image in its cell */
}

.action-links a {
    text-decoration: none;
    color: #007bff;
}

.action-links a:hover {
    text-decoration: underline;
}

/* Header styling */
h1, h2 {
    color: #0056b3;
    margin-bottom: 15px;
}

    </style>
</head>
<body>
<h1>DATA BUKU<br>SMK Telkom Lampung<br>Tahun 2024-2025</h1>

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
                    <?php if (!empty($data['gambar_buku'])) { ?>
                        <img src="<?= htmlspecialchars($data['gambar_buku']) ?>" alt="Gambar Buku" width="80px">
                    <?php } else {
                        echo "Tidak ada gambar";
                    } ?>
                </td>
                <td class="action-buttons">
                    <a href="pinjam.php?kode_buku=<?= urlencode($data['kode_buku']) ?>" class="borrow-btn">Pinjam</a>
                    <a href="kembalikan.php?kode_buku=<?= urlencode($data['kode_buku']) ?>" class="return-btn">Kembalikan</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</body>
</html>