<?php
include 'functions.php';
?>

<!-- Include header -->
<?php include 'atas.php'; ?>

<section class="form-login">
    <h1><center>Login Disini</center></h1>
    <br>

    <center><?php require_once('user_ceklogin.php') ?></center>

    <form action="" method="POST">
        <table class="center">
            <tr>
                <td><label for="email_or_username">Email or Username</label></td>
                <td><input type="text" id="email_or_username" name="email_or_username" class="login-input"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password" class="login-input"></td>
            </tr>
        </table>
        <center><button type="submit" name="login">Login</button></center>
    </form>
    <br>
    <center>Belum Punya Akun ? Daftar <a href="user_register.php" class="start">disini</a></center>

    <br>
    <center><a href="admin/index.php">Halaman Admin</a></center>
</section>


<?php include 'bawah.php'; ?>
