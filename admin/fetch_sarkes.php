<?php
include 'koneksi.php';

// Ambil data sarana kesehatan dari database
$query = "SELECT * FROM sarkes"; // Sesuaikan dengan nama tabel di database Anda
$result = mysqli_query($conn, $query);

// Tampilkan data dalam format tabel HTML
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_sarkes'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['telp'] . "</td>";
        echo "<td>" . $row['alamat'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
}

mysqli_close($conn); // Tutup koneksi database
?>
