<?php
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penanganan = $_POST['id'];
    $userId = $_SESSION['id_user'];

    $result = query("DELETE FROM penanganan 
                     WHERE id_penanganan = '$id_penanganan'");

    if ($result) {
        // Redirect back to the dashboard with success status
        header('Location: dashboard.php?status=success');
        exit();
    } else {
        // Redirect back to the dashboard with error status
        header('Location: dashboard.php?status=error');
        exit();
    }
}
?>
