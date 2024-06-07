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

// Get psikolog list
$psikologs = query('SELECT * FROM psikolog');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $consultationType = 'online'; // Set the consultation type to online

    $idPsikolog = $_POST['psikolog'];
    $tanggalKunjungan = $_POST['tanggal_kunjungan'];
    $waktuKunjungan = $_POST['waktu_kunjungan'];

    // Add logic to handle the online consultation (e.g., save to database)
    $result = query("INSERT INTO penanganan (tanggal, waktu, jenis, id_pengguna, id_psikolog) 
                     VALUES ('$tanggalKunjungan', '$waktuKunjungan', '$consultationType', $userId, $idPsikolog)");

    if ($result) {
        echo "<script>alert('Konsultasi online berhasil disimpan.')</script>";
    } else {
        echo "<script>alert('Error saat menyimpan konsultasi online.')</script>";
    }
}

// Get the list of online consultations for the logged-in user
$onlineConsultations = getOnlineConsultations($userId);

// Display dashboard
?>

<body>
    <header>
        <h2>Konsultasi Online</h2>
    </header>

    <section class="container">
        <h2>Status Anda: <?php echo $userStatusName; ?></h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="psikolog">Pilih Psikolog:</label>
                <select name="psikolog" id="psikolog" class="form-control" required>
                    <?php foreach ($psikologs as $psikolog) : ?>
                        <option value="<?php echo $psikolog['id_psikolog']; ?>">
                            <?php echo $psikolog['nama'] . ' ( spesialis : ' . $psikolog['spesialis'] . ')'; ?>
                        </option>
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

        <!-- Daftar List Konsultasi -->
        <h2>Daftar Konsultasi Online :</h2>
        <ul class="list-group">
            <?php foreach ($onlineConsultations as $onlineConsultation) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $onlineConsultation['nama_psikolog']; ?>
                    <span><?= $onlineConsultation['tanggal'] . ' ' . $onlineConsultation['waktu']; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- Bootstrap JS and Popper.js -->
    <?php include 'bawah.php'; ?>