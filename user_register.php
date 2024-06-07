<!-- Include header -->
<?php 
    require_once 'atas.php';
?>

<section class="form-register">
    <h1><center>Silahkan Daftar</center></h1>
    <br>

    <?php
    if (isset($_POST['register'])) {
        require_once('functions.php');
        if (register($_POST) > 0) {
            echo "<script>
                    alert('Berhasil Register');
                    window.location.href = 'user_login.php';
                </script>";
            exit(); // Pastikan keluar dari skrip untuk menghindari eksekusi kode selanjutnya
        } else {
            echo "<center><h4 style='color: red'>Gagal Register </h4></center>";
        }
    }    
    ?>

    <form method="POST" enctype="multipart/form-data">
        <table class="center">
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" name="username" id="username" required></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password" required></td>
            </tr>
        </table>
        <center><button name="register" type="submit">DAFTAR</button></center>
    </form>
    <center>Sudah Punya Akun ? Masuk <a href="user_login.php" class="start">disini</a></center>
</section>

<?php include 'bawah.php'; ?>
