<?php

$db_server = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'aplikasi';

// inisialisasi koneksi database
$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);


// mulai query ke database
function query($query) {
    global $conn;

    // hasilnya array asosiative
    $result = mysqli_query($conn, $query);
    // Collect results for SELECT queries
    $users = [];
    // memecah lagi array assosiative 
    while ($user = mysqli_fetch_assoc($result)) {
        $users[] = $user;
    }
    
    return$users;
}


?>