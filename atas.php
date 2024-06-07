<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Mental Health</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg "> <!-- Tambahkan class navbar-light dan bg-light -->
    <a class="navbar-brand" href="dashboard.php">
        <img src="assets/img/mental.png" class="logo" alt="Logo"> <!-- Tambahkan alt pada gambar -->
        Peduli Diri
    </a>

    <!-- Button for mobile view -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav"> <!-- Tambahkan justify-content-end -->
        <ul class="navbar-nav">
            <?php
            session_start();
            if(isset($_SESSION['id_user'])){
                // Sesuaikan path ke file functions.php jika diperlukan
                require_once('functions.php');

                $id_user = $_SESSION['id_user'];
                $user_active = query("SELECT nama,username FROM pengguna WHERE id_user = '$id_user'");
                if (!empty($user_active)) {
                    $user_active = $user_active[0];
                }
                if (empty($user_active['username'])){
                    session_destroy();
                } else {
                    $user = $user_active['username'];
                }
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $user; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="user_profile.php">Profile</a>
                    <a class="dropdown-item" href="user_logout.php">Logout</a>
                </div>
            </li>
            <?php
            } else {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="user_login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_register.php">Register</a>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
</nav>

<!-- Your page content goes here -->

