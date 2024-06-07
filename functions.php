<?php

$db_server = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'aplikasi';

// inisialisasi koneksi database
$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

function query($query, $params = null) {
    global $conn;

    if ($params) {
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt === false) {
            die("Error in preparing statement: " . mysqli_error($conn));
        }

        $bindResult = call_user_func_array(array($stmt, 'bind_param'), $params);
        if ($bindResult === false) {
            die("Error in binding parameters: " . mysqli_error($conn));
        }

        $executeResult = mysqli_stmt_execute($stmt);
        if ($executeResult === false) {
            die("Error in executing statement: " . mysqli_error($conn));
        }

        $result = mysqli_stmt_get_result($stmt);

        if ($result === false) {
            die("Error in getting result: " . mysqli_error($conn));
        }
    } else {
        $result = mysqli_query($conn, $query);
        if ($result === false) {
            die("Error in query: " . mysqli_error($conn));
        }
    }

    if ($result === true) {
        // For non-select queries (e.g., INSERT, UPDATE, DELETE)
        return $result;
    }
    

    // mengumpulkan hasil
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// untuk update profil 
function createConnection()
{
    global $conn;
    return $conn;
}

function closeConnection()
{
    global $conn;
    $conn->close();
}

function redirectToLogin()
{
    header("Location: login.php");
    exit();
}

function redirectToHome()
{
    header("Location: index.php");
    exit();
}

function register($data)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $data['email']);
    $username = mysqli_real_escape_string($conn, $data['username']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    // Check if email or username already exists
    $checkUser = query("SELECT * FROM pengguna WHERE email = '$email' OR username = '$username'");
    if (count($checkUser) > 0) {
        // Email or username already exists
        echo "<script>alert('Email or username already exists.')</script>";
    } else {
        // Insert the new user into the database
        $result = mysqli_query($conn, "INSERT INTO pengguna (email, username, password) VALUES ('$email', '$username', '$password')");

        // Check if the query was successful
        if ($result) {
            return mysqli_affected_rows($conn);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Kegiatan

function getUserStatus($userId)
{
    global $conn;

    // Adjust the query based on your database structure
    $result = query("SELECT id_status FROM pengguna WHERE id_user = $userId")[0]['id_status'];

    return $result;
}



function getRecommendedActivities($userStatus)
{
    global $conn;
    // Adjust the query based on your database structure
    $result = query("SELECT nama FROM kegiatan WHERE id_status = '$userStatus'");
    
    $activities = [];
    foreach ($result as $row) {
        $activities[] = $row['nama'];
    }

    return $activities;
}

function getUserStatusName($id_status)
{
    global $conn;

    // Adjust the query based on your database structure
    $result = query("SELECT nama FROM status WHERE id_status = $id_status");

    // Periksa apakah query mengembalikan hasil
    if ($result) {
        // Periksa apakah ada baris data yang dikembalikan
        if (count($result) > 0) {
            // Ambil nama dari baris pertama
            $nama = $result[0]['nama'];
            return $nama;
        } else {
            // Handle jika tidak ada baris data
            return "Status tidak ditemukan";
        }
    } else {
        // Handle jika query gagal
        return "Error dalam eksekusi query";
    }
}

// functions.php

// ...

function getConsultations($userId) {
    global $conn;

    // Adjust the query based on your database structure
    $result = query("SELECT
                    p.id_penanganan,
                    p.jenis,
                    p.tanggal,
                    p.waktu,
                    s.nama AS nama_sarkes,
                    ps.nama AS nama_psikolog
                 FROM
                    penanganan p
                 LEFT JOIN
                    sarkes s ON p.id_sarkes = s.id_sarkes
                 LEFT JOIN
                    psikolog ps ON p.id_psikolog = ps.id_psikolog
                 WHERE
                    p.id_pengguna = $userId");

    // Provide default values if the fields are not present in the result
    $consultations = [];
    foreach ($result as $row) {
        $consultation = [
            'id_penanganan' => $row['id_penanganan'],
            'jenis' => $row['jenis'],
            'tanggal' => $row['tanggal'],
            'waktu' => $row['waktu'],
            'nama_sarkes' => $row['nama_sarkes'] ?? null,
            'nama_psikolog' => $row['nama_psikolog'] ?? null,
        ];

        $consultations[] = $consultation;
    }

    return $consultations;
}

// Add this function to your PHP file
function getOfflineConsultations($userId) {
    global $conn;

    $result = query("SELECT
                        p.tanggal,
                        p.waktu,
                        s.nama AS nama_sarkes
                     FROM
                        penanganan p
                     LEFT JOIN
                        sarkes s ON p.id_sarkes = s.id_sarkes
                     WHERE
                        p.id_pengguna = $userId
                        AND p.jenis = 'offline'");

    $offlineConsultations = [];
    foreach ($result as $row) {
        $offlineConsultation = [
            'tanggal' => $row['tanggal'],
            'waktu' => $row['waktu'],
            'nama_sarkes' => $row['nama_sarkes'] ?? null,
        ];

        $offlineConsultations[] = $offlineConsultation;
    }

    return $offlineConsultations;
}


// Add this function to your PHP file
function getOnlineConsultations($userId) {
    global $conn;

    $result = query("SELECT
                        p.tanggal,
                        p.waktu,
                        ps.nama AS nama_psikolog
                     FROM
                        penanganan p
                     LEFT JOIN
                        psikolog ps ON p.id_psikolog = ps.id_psikolog
                     WHERE
                        p.id_pengguna = $userId
                        AND p.jenis = 'online'");

    $onlineConsultations = [];
    foreach ($result as $row) {
        $onlineConsultation = [
            'tanggal' => $row['tanggal'],
            'waktu' => $row['waktu'],
            'nama_psikolog' => $row['nama_psikolog'] ?? null,
        ];

        $onlineConsultations[] = $onlineConsultation;
    }

    return $onlineConsultations;
}







?>
