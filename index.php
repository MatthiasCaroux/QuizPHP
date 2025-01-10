<?php 



require_once __DIR__ . '/Classes/AutoLoader.php';
require_once __DIR__ .'/includes/header.php';



AutoLoader::register();

use models\Questions;
use models\Questions_simple;
use models\Provider;


?>


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
            $provider = new Provider();        
            $questions = $provider->getQuestions();
            foreach ($questions as $question) {
                echo $question->render();
            }
        ?>
    </main>
</body>
</html>