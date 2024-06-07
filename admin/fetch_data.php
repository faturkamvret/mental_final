<?php
include 'koneksi.php';

// Ambil data pengguna dari database
$query = "SELECT * FROM pengguna"; // Sesuaikan dengan nama tabel di database Anda
$result = mysqli_query($conn, $query);

// Tampilkan data dalam format tabel HTML
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_user'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['tgl_lahir'] . "</td>";
        echo "<td>" . $row['jenis_kelamin'] . "</td>";
        echo "<td>" . $row['alamat'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
}

mysqli_close($conn); // Tutup koneksi database
?>
