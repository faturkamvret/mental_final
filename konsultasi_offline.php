<?php
include 'atas.php';

// Check if the user is logged in
if (!isset($_SESSION['id_user'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

// Get user information
$userId = $_SESSION['id_user'];
$userStatus = getUserStatus($userId);
$userStatusName = getUserStatusName($userStatus);

// Get sarkes list
$sarkesList = query('SELECT * FROM sarkes');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $consultationType = 'offline'; // Set the consultation type to offline

    $idSarkes = $_POST['sarkes'];
    $tanggalKunjungan = $_POST['tanggal_kunjungan'];
    $waktuKunjungan = $_POST['waktu_kunjungan'];

    // Add logic to handle the offline consultation (e.g., save to database)
    $result = query("INSERT INTO penanganan (tanggal, waktu, jenis, id_pengguna, id_sarkes) 
                     VALUES ('$tanggalKunjungan', '$waktuKunjungan', '$consultationType', $userId, $idSarkes)");

    if ($result) {
        echo "<script>alert('Konsultasi offline berhasil disimpan.')</script>";
    } else {
        echo "<script>alert('Error saat menyimpan konsultasi offline.')</script>";
    }
}

// Display dashboard
?>

<body>
    <header>
        <h2>Konsultasi Offline</h2>
    </header>

    <section class="container">
        <h2>Status Anda: <?php echo $userStatusName; ?></h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="sarkes">Pilih Sarkes:</label>
                <select name="sarkes" id="sarkes" class="form-control" required>
                    <?php foreach ($sarkesList as $sarkes) : ?>
                        <option value="<?php echo $sarkes['id_sarkes']; ?>"><?php echo $sarkes['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
                <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="waktu_kunjungan">Waktu Kunjungan:</label>
                <input type="time" name="waktu_kunjungan" id="waktu_kunjungan" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>

        <!-- Daftar List Konsultasi offline -->
        <h2>Daftar Konsultasi Offline :</h2>
        <ul class="list-group">
            <?php
            // Get the list of offline consultations
            $offlineConsultations = getOfflineConsultations($userId);

            foreach ($offlineConsultations as $offlineConsultation) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $offlineConsultation['nama_sarkes']; ?> <!-- Assuming you want to display the Sarkes name -->
                    <span><?= $offlineConsultation['tanggal'] . ' ' . $offlineConsultation['waktu']; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- Bootstrap JS and Popper.js -->
    <?php include 'bawah.php'; ?>
