<?php
require_once('functions.php');

if (!isset($_SESSION['id_user'])) {
    if (isset($_POST['login'])) {
        $user = mysqli_real_escape_string($conn, $_POST['email_or_username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Lakukan query dengan menghindari SQL injection
        $query = "SELECT id_user, username, email, password FROM pengguna WHERE username = '$user' OR email = '$user'";
        $result = mysqli_query($conn, $query);

        // Memeriksa apakah ada hasil yang cocok
        if ($result && mysqli_num_rows($result) > 0) {
            $login = mysqli_fetch_assoc($result);
            var_dump($password);
            var_dump($login['password']);
            
            // Memeriksa kecocokan password secara langsung
            if (password_verify($password, $login['password']) || $password == $login['password']) {
                $_SESSION['id_user'] = $login['id_user'];
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Username/Email atau Password Salah";
            }
        } else {
            echo "Username/Email tidak ditemukan";
        }
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
