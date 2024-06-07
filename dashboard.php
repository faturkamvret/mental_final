<?php
include 'atas.php';

// Check if the user is logged in
if (!isset($_SESSION['id_user'])) {
    header('Location: index.php'); // Redirect to the login page if not logged in
    exit();
}

// Get user information
$userId = $_SESSION['id_user'];
$userStatus = getUserStatus($userId);
$userStatusName = "";

if ($userStatus !== null) {
    $userStatusName = getUserStatusName($userStatus);
} else {
    $userStatusName = "Belum Diketahui";
}

// Get recommended activities based on user status
$recommendedActivities = getRecommendedActivities($userStatus);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $consultationType = $_POST['consultation_type'];
    // Add logic to redirect based on the selected consultation type
    if ($consultationType == 'online') {
        header('Location: konsultasi_online.php');
        exit();
    } elseif ($consultationType == 'offline') {
        header('Location: konsultasi_offline.php');
        exit();
    }
}

// Get the list of consultations
$consultations = getConsultations($userId);

?>

<body>
    <header>
        <h1>Selamat Datang <?php echo $user_active = $user_active['nama']; ?></h1>
    </header>

    <section class="container mt-4">
        <h2>Status Anda: <?php echo $userStatusName; ?></h2>

        <!-- Button to go to the quiz -->
        <a href="index.php" class="btn btn-primary mb-3">Isi Kuisioner Sekarang</a>

        <h2>Rekomendasi Aktivitas:</h2>
        <ul class="list-group mb-4">
            <?php foreach ($recommendedActivities as $activity) : ?>
                <li class="list-group-item"><?php echo $activity; ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Konsultasi:</h2>
        <p>Pilih Jenis Konsultasi:</p>
        <form action="" method="post">
            <div class="form-check mb-2">
                <input type="radio" name="consultation_type" value="offline" id="offline" class="form-check-input" required>
                <label for="offline" class="form-check-label">Offline</label>
            </div>

            <div class="form-check mb-3">
                <input type="radio" name="consultation_type" value="online" id="online" class="form-check-input" required>
                <label for="online" class="form-check-label">Online</label>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>

        <!-- Daftar List Konsultasi -->
        <h2 class="mt-4">Daftar Konsultasi:</h2>
        <ul class="list-group">
            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center font-weight-bold">
                <span class="col-md-2">Jenis</span>
                <span class="col-md-4">Nama</span>
                <span class="col-md-2">Tanggal</span>
                <span class="col-md-2">Waktu</span>
                <span class="col-md-2">Actions</span>
            </li>
            <?php foreach ($consultations as $consultation) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="col-md-2"><?= $consultation['jenis']; ?></span>
                    <span class="col-md-4">
                        <?php
                        $namaToShow = ($consultation['jenis'] == 'online') ? $consultation['nama_psikolog'] : $consultation['nama_sarkes'];
                        $namaToShow = !empty($namaToShow) ? $namaToShow : 'Nama Not Available';

                        echo '<span>' . $namaToShow . '</span>';
                        ?>
                    </span>
                    <span class="col-md-2"><?= $consultation['tanggal']; ?></span>
                    <span class="col-md-2"><?= $consultation['waktu']; ?></span>
                    <span class="col-md-2">
                        <button class="btn btn-info" data-toggle="modal" data-target="#detailModal">Detail</button>
                        <form action="konsultasi_hapus.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $consultation['id_penanganan']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menhapus jadwal konsultasi ini ?')">Hapus</button>
                        </form>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- Modal for Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Konsultasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your code for detailed information here -->
                    <p>Evaluasi: ...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and Popper.js -->
    <?php include 'bawah.php'; ?>

    <?php
    // Display success or error message based on URL parameter
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $message = ($status == 'success') ? 'Jadwal Konsultasi Berhasil Dihapus.' : 'Gagal Menghapus Jadwal Konsultasi.';
        echo "<script>alert('$message');</script>";
    }
    ?>
</body>

</html>
