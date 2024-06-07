<?php
// Sambungkan ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table']) && $_POST['table'] === 'psikolog') {
    // Query untuk mengambil data psikolog dari tabel psikolog
    $query = "SELECT * FROM psikolog";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Membuat array untuk menyimpan hasil query
        $psychologist_data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Menambahkan data psikolog ke dalam array
            $psychologist_data[] = $row;
        }

        // Mengubah array ke dalam format JSON
        echo json_encode($psychologist_data);
    } else {
        // Jika tidak ada data psikolog
        echo "Tidak ada data psikolog.";
    }
} else {
    // Jika permintaan bukan dari metode POST atau tabel yang diminta bukan psikolog
    echo "Permintaan tidak valid.";
}

// Tutup koneksi database
mysqli_close($conn);
?>
