<?php 
    require('atas.php');
    $aku = query("SELECT * FROM pengguna WHERE id_user='$id_user' ")[0];
    ?>
<html>
<body>
<section class="ubah-user">
    <h1><center>Profile</center></h1>
    <br>
    <table class="center" border="1">
        <tr>
            <td colspan="2" class="boxFoto" align="center">
                <img src="assets/img/user.png" alt="profil" height="150" width="150">
            </td>
        </tr>
        <tr>
            <td><label for="nama">Nama </label></td>
            <td class="profile_username"><p><?= $aku['nama']; ?></p></td>
        </tr>
        <tr>
            <td><label for="username">Username </label></td>
            <td><p><?= $aku['username'] ?></p></td>
        </tr>
        <tr>
            <td><label for="jenis_kelamin">Jenis Kelamin </label></td>
            <td><p><?= $aku['jenis_kelamin'] ?></p></td>
        </tr>
        <tr>
            <td><label for="tgl_lahir">Tanggal Lahir </label></td>
            <td><p><?= $aku['tgl_lahir'] ?></p></td>
        </tr>
        <tr>
            <td><label for="alamat">Alamat</label></td>
            <td><p><?= $aku['alamat'] ?></p></td>
        </tr>
        <tr>
            <td><label for="email">E-mail</label></td>
            <td><p><?= $aku['email'] ?></p></td>
        </tr>
    </table>
    <center class="button_link"><a href="user_profile_update.php?id=<?= $id_user; ?>" >Ubah</a></center>
</section>



<?php include 'bawah.php'; ?>