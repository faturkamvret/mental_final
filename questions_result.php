<?php
include_once 'questions_process.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id_user']) && isset($_GET['id_status'])) {
    $id_user = $_GET['id_user'];
    $id_status = $_GET['id_status'];

    saveOrUpdateResultToDatabase($id_user, $id_status);
} else {
    // Redirect to the index page if there is a direct access attempt
    redirectToHome();
}
?>
