<!-- questions_process.php -->
<?php
include_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalScore = 0;

    for ($i = 1; $i <= 20; $i++) {
        $answer = isset($_POST["q$i"]) ? $_POST["q$i"] : 0;
        $totalScore += $answer;
    }

    $mentalHealthConditions = [];

    if ($totalScore >= 8 && $totalScore <= 20) {
        $depressionQuestions = [2, 3, 8, 9, 10, 11, 12, 14, 15, 16, 17, 18, 20];
        $anxietyQuestions = [4, 5, 6, 16];
        $somatoformQuestions = [1, 7, 19];
        $neuroticQuestions = [3, 8, 13, 18, 20];

        if (checkCondition($depressionQuestions)) {
            $mentalHealthConditions[] = 'Depresi';
        }

        if (checkCondition($anxietyQuestions)) {
            $mentalHealthConditions[] = 'Gangguan Kecemasan';
        }

        if (checkCondition($somatoformQuestions)) {
            $mentalHealthConditions[] = 'Gangguan Somatoform';
        }

        if (checkCondition($neuroticQuestions)) {
            $mentalHealthConditions[] = 'Gangguan Neurotik';
        }
    }

    if (empty($mentalHealthConditions)) {
        $mentalHealthConditions[] = 'Normal';
    }

    $formSubmitted = true;
}

function checkCondition($questions)
{
    foreach ($questions as $question) {
        $answer = isset($_POST["q$question"]) ? $_POST["q$question"] : 0;
        if ($answer == 1) {
            return true;
        }
    }
    return false;
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

?>
