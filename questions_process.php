<?php
include_once 'questions.php';
include_once 'functions.php';

function countCheckedConditions($questions)
{
    $count = 0;

    foreach ($questions as $question) {
        $answer = $_POST["q$question"] ?? 0;
        $count += $answer;
    }

    return $count;
}

function getMostLikelyCondition($conditionsScores)
{
    arsort($conditionsScores);
    return key($conditionsScores);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalScore = 0;

    for ($i = 1; $i <= 20; $i++) {
        $answer = $_POST["q$i"] ?? 0;
        $totalScore += $answer;
    }

    $mostLikelyCondition = 'Normal';

    if ($totalScore >= 3 && $totalScore <= 20) {
        $depressionQuestions = [2, 9, 10, 11, 12, 14, 15, 17];
        $anxietyQuestions = [4, 5, 6, 16];
        $somatoformQuestions = [1, 7, 19];
        $neuroticQuestions = [3, 8, 13, 18, 20];

        $conditionsScores = [
            'Depresi' => countCheckedConditions($depressionQuestions),
            'Gangguan Kecemasan' => countCheckedConditions($anxietyQuestions),
            'Gangguan Somatoform' => countCheckedConditions($somatoformQuestions),
            'Gangguan Neurotik' => countCheckedConditions($neuroticQuestions),
        ];

        $mostLikelyCondition = getMostLikelyCondition($conditionsScores);
    }

    $conditionIdMapping = [
        'Normal' => 9000,
        'Depresi' => 9001,
        'Gangguan Kecemasan' => 9002,
        'Gangguan Somatoform' => 9003,
        'Gangguan Neurotik' => 9004,
    ];

    $mostLikelyConditionId = $conditionIdMapping[$mostLikelyCondition] ?? 9000;

    $formSubmitted = true;
}

function processFormSubmission()
{
    global $totalScore, $mostLikelyConditionId, $formSubmitted;

    if ($totalScore >= 3 && $totalScore <= 20) {
        $userId = $_SESSION['user_id'] ?? null;
        $saveAction = $_POST['saveAction'] ?? null;

        if ($userId !== null && $saveAction !== null) {
            saveOrUpdateResultToDatabase($userId, $mostLikelyConditionId);
        }
    }

    $formSubmitted = true;
}

function displayQuestions()
{
    global $srqQuestions;

    echo "<div class='question'>";
    for ($i = 1; $i <= 20; $i++) {
        // Tambahkan kelas 'bg-light' untuk memberikan latar belakang warna
        echo "<div class='mb-4 p-3 bg-light rounded'>";
        // Gunakan kelas 'text-dark' untuk memastikan teks terlihat dengan warna latar belakang
        echo "<p class='mb-2 text-dark'>Pertanyaan $i: " . $srqQuestions[$i - 1] . "</p>";
        echo "<div class='form-check form-check-inline'>";
        // Ganti warna untuk tombol radio dan label
        echo "<input class='form-check-input' type='radio' name='q$i' id='ya$i' value='1' required>";
        echo "<label class='form-check-label text-success' for='ya$i'>YA</label>";
        echo "</div>";
        echo "<div class='form-check form-check-inline'>";
        echo "<input class='form-check-input' type='radio' name='q$i' id='tidak$i' value='0' required>";
        echo "<label class='form-check-label text-danger' for='tidak$i'>TIDAK</label>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
}

function checkUserHasStatus($userId)
{
    global $conn;

    // Pastikan untuk menyesuaikan query sesuai dengan struktur tabel Anda
    $result = query("SELECT id_status FROM pengguna WHERE id_user = '$userId'");

    return count($result) > 0;
}

function saveOrUpdateResultToDatabase($id_user, $mostLikelyConditionId)
{
    global $conn;

    // Check if the user already has a status
    $checkStatus = query("SELECT id_status FROM pengguna WHERE id_user = $id_user");

    if (count($checkStatus) > 0) {
        // Update the existing status
        query("UPDATE pengguna SET id_status = $mostLikelyConditionId WHERE id_user = $id_user");
    } else {
        // Insert a new record for the user
        query("INSERT INTO pengguna (id_user, id_status) VALUES ($id_user, $mostLikelyConditionId)");
    }
    closeConnection();
    // Display a success message using JavaScript alert
    echo "<script>
            alert('Telah berhasil menyimpan hasil.');
            setTimeout(function(){
                window.location.href = 'dashboard.php';
            }, 1000); // Delay in milliseconds (e.g., 2000ms = 2 seconds)
          </script>";
}

?>
