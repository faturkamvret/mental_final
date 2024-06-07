<?php include 'koneksi.php'; 

// Menghitung jumlah data dalam tabel pengguna
$query_pengguna = "SELECT COUNT(*) AS total_pengguna FROM pengguna";
$result_pengguna = mysqli_query($conn, $query_pengguna);
$row_pengguna = mysqli_fetch_assoc($result_pengguna);
$total_pengguna = $row_pengguna['total_pengguna'];

// Menghitung jumlah data dalam tabel psikolog
$query_psikolog = "SELECT COUNT(*) AS total_psikolog FROM psikolog";
$result_psikolog = mysqli_query($conn, $query_psikolog);
$row_psikolog = mysqli_fetch_assoc($result_psikolog);
$total_psikolog = $row_psikolog['total_psikolog'];

// Menghitung jumlah data dalam tabel sarana kesehatan
$query_sarkes = "SELECT COUNT(*) AS total_sarkes FROM sarkes";
$result_sarkes = mysqli_query($conn, $query_sarkes);
$row_sarkes = mysqli_fetch_assoc($result_sarkes);
$total_sarkes = $row_sarkes['total_sarkes'];

mysqli_close($conn); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <a href="../index.php">Halaman User</a>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pengguna Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pengguna</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_pengguna; ?></div>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="fas fa-user fa-2x text-gray-300 card-click" data-toggle="modal"
                                    data-target="#userModal" data-table="pengguna"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Psikolog Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Psikolog</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_psikolog; ?></div>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="fas fa-star-of-life fa-2x text-gray-300 card-click" data-toggle="modal"
                                    data-target="#psychologistModal" data-table="psikolog"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sarana Kesehatan Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Sarana Kesehatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_sarkes; ?></div>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="fas fa-clinic-medical fa-2x text-gray-300 card-click" data-toggle="modal"
                                    data-target="#saranaKesehatanModal" data-table="sarkes"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                        <!-- Tabel untuk menampilkan data pengguna -->
                        <div class="container mt-4" id="userTableContainer" style="display: none;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="userTable">
                                            <thead>
                                                <tr>
                                                    <th>ID User</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Alamat</th>
                                                    <th>Email</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data dari fetch_data.php akan ditampilkan di sini -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Tabel -->

                        <!-- Tabel untuk menampilkan data psikolog -->
                        <div class="container mt-4" id="psychologistTableContainer" style="display: none;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="psychologistTable">
                                            <thead>
                                                <tr>
                                                    <th>ID Psikolog</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Spesialis</th>
                                                    <th>Email</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data dari fetch_psychologist.php akan ditampilkan di sini -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Tabel Psikolog -->
                        <!-- Tabel untuk menampilkan data sarana kesehatan -->
<div class="container mt-4" id="saranaKesehatanTableContainer" style="display: none;">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="saranaKesehatanTable">
                    <thead>
                        <tr>
                            <th>ID Sarana Kesehatan</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari fetch_sarana_kesehatan.php akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

                        <!-- ... -->

                    </div>
                    <!-- ... -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Script to fetch and display user data -->
    <script>
    $(document).ready(function () {
    $('.card-click').click(function () {
        var table = $(this).data('table');
        var url = table === 'pengguna' ? 'fetch_data.php' : (table === 'psikolog' ? 'fetch_psychologist.php' : (table === 'sarkes' ? 'fetch_sarkes.php' : ''));

        $.ajax({
            url: url,
            method: 'POST',
            data: { table: table },
            success: function (response) {
                if (table === 'pengguna') {
                    $('#userTable tbody').html(response);
                    $('#userTableContainer').show();
                    $('#psychologistTableContainer').hide();
                    $('#saranaKesehatanTableContainer').hide();
                } else if (table === 'psikolog') {
                    $('#psychologistTable tbody').html(response);
                    $('#psychologistTableContainer').show();
                    $('#userTableContainer').hide();
                    $('#saranaKesehatanTableContainer').hide();
                } else if (table === 'sarkes') {
                    $('#saranaKesehatanTable tbody').html(response);
                    $('#saranaKesehatanTableContainer').show();
                    $('#userTableContainer').hide();
                    $('#psychologistTableContainer').hide();
                }
            }
        });
    });
});


</script>

</body>

</html>
