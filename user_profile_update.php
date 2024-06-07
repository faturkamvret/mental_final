<?php
require('atas.php');

// Ambil data user berdasarkan ID
$userData = query("SELECT * FROM pengguna WHERE id_user = '$id_user'")[0];

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = mysqli_real_escape_string(createConnection(), $_POST['nama']);
    $tgl_lahir = mysqli_real_escape_string(createConnection(), $_POST['tgl_lahir']);
    $jenis_kelamin = mysqli_real_escape_string(createConnection(), $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string(createConnection(), $_POST['alamat']);
    $email = mysqli_real_escape_string(createConnection(), $_POST['email']);

    // Lakukan validasi atau proses lain sesuai kebutuhan
    // ...

    // Lakukan update data
    $updateResult = mysqli_query(createConnection(), "UPDATE pengguna SET nama = '$nama', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', email = '$email' WHERE id_user = '$id_user'");

    if ($updateResult) {
        echo "<script>alert('Data berhasil diupdate.')</script>";
        header("Location: user_profile.php");
        // Redirect ke halaman lain atau lakukan sesuatu setelah update
    } else {
        echo "Error: " . mysqli_error(createConnection());
    }
}

// ... (kode HTML atau tampilan form)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Profile</title>
    <link rel="stylesheet" href="path/to/your/style.css"> <!-- Ganti dengan path CSS Anda -->
</head>
<body>

<!-- Tambahkan HTML untuk tampilan form -->
<!-- Gunakan data $userData untuk mengisi nilai default pada form -->

<section class="ubah-user">
    <h1><center>Ubah Profile</center></h1>
    <br>
    <form method="post" action="user_profile_update.php" class="mt-4">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?= $userData['nama']; ?>" required>
        <br>

        <label for="tgl_lahir">Tanggal Lahir:</label>
        <input type="date" name="tgl_lahir" value="<?= $userData['tgl_lahir']; ?>" required>
        <br>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="Laki-Laki" <?= ($userData['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
            <option value="Perempuan" <?= ($userData['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
        </select>
        <br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required><?= $userData['alamat']; ?></textarea>
        <br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" value="<?= $userData['email']; ?>" required>
        <br>

        <!-- Tambahkan elemen-elemen form lainnya sesuai dengan kebutuhan -->

        <button type="submit">Simpan Perubahan</button>
    </form>
</section>


<?php include 'bawah.php'; ?>

<?php
// Pastikan untuk memanggil closeConnection() setelah selesai menggunakan koneksi
closeConnection();
?>
