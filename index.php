<!-- index.php -->
<?php
include 'atas.php';
include 'questions_process.php';

$currentQuestion = $totalQuestions = $formSubmitted = $userHasStatus = 0;

if (!$formSubmitted && $_SERVER["REQUEST_METHOD"] == "POST") {
    processFormSubmission();
}

// Ensure that $userHasStatus is defined
if (!isset($userHasStatus)) {
    $userHasStatus = false;
}

?>

<body>
    <div class="container">
        <h2 class="mb-4">Kuisioner SRQ</h2>
        <h6>Mohon jawab 20 pertanyaan sesuai dengan kepribadian anda ...</h6>

        <?php if (!$formSubmitted) : ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-4" id="srqForm">
                <div id="questionsContainer">
                    <?php displayQuestions(); ?>
                </div>

                <div class="btn-group">
                    <button type="submit" name="submitForm" class="btn btn-primary btn-square" id="submitBtn">Submit</button>
                </div>
            </form>
        <?php else : ?>
            <div id='resultContainer'>
                <p class='mt-4'>Skor Total: <?php echo $totalScore; ?></p>

                <?php
                if ($mostLikelyCondition !== 'Normal') {
                    echo "<p>Kondisi Kesehatan Mental: $mostLikelyCondition</p>";
                } else {
                    echo "<p>Kondisi Kesehatan Mental: Normal</p>";
                }
                ?>

                <?php if (isset($_SESSION['id_user'])) : ?>
                    <?php
                    $buttonText = 'Simpan Hasil';
                    $onClickFunction = 'saveOrUpdateResultToDatabase';

                    if ($userHasStatus) {
                        $buttonText = 'Simpan';
                        $onClickFunction = 'updateResult';
                    }
                    ?>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary btn-square" id="questions_resultBtn">Simpan Hasil</button>
                    </div>

                <?php else : ?>
                    <div class="text-center mt-3">
                        <p>Login untuk menyimpan hasil.</p>
                        <a id="loginToSaveBtn" href="user_login.php" class="btn btn-primary btn-square">Login</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>


    <script>
    let formSubmitted = <?php echo ($formSubmitted) ? 'true' : 'false'; ?>;
    let userId = <?php echo (isset($_SESSION['id_user'])) ? $_SESSION['id_user'] : 'null'; ?>;

    document.getElementById('questions_resultBtn').addEventListener('click', function() {
        // Redirect to saveresult.php with id_user and id_status as query parameters
        window.location.href = `questions_result.php?id_user=${userId}&id_status=<?php echo $mostLikelyConditionId; ?>`;
    });

    // Display questions only if the form is not submitted
    if (!formSubmitted) {
        displayQuestions();
    }
</script>

<?php include 'bawah.php'; ?>