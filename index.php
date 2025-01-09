<?php require_once __DIR__ . '/Classes/AutoLoader.php'; ?>
<?php require_once __DIR__ . '/includes/header.php'; ?>
<?php require_once __DIR__ . '/Classes/functions.php'; ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>Questions : </h1>
        <?php
            AutoLoader::register();
            $questions = getQuestions();
            foreach ($questions as $question) {
                $question->render();
            }
        ?>
    </main>
</body>
</html>