<?php
// index.php

require_once __DIR__ . '/Classes/Autoloader.php';
Autoloader::register();

use Form\Type\Text;
use Form\Type\Textarea;

// Récupération des questions
require_once __DIR__ . '/question.php';

try {
    $questions = getQuestions();
} catch (Exception $e) {
    die("Erreur lors de la récupération des questions : " . $e->getMessage());
}

$totalScore   = 0;
$scoreObtenu  = 0;
$reponsesUser = [];  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $pdo = new PDO('sqlite:' . __DIR__ . '/quiz.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($questions as $question) {
        $qName   = $question['name'];
        $qType   = $question['type'];
        $qAnswer = $question['answer'];
        $qScore  = $question['score'];

        $totalScore += $qScore;

        // Récupération de la réponse de l'utilisateur
        // (si tu as modifié Input.php/Textarea.php pour enlever "form[]")
        $userValue = $_POST[$qName] ?? null;
        
        $reponsesUser[$qName] = $userValue;

        // Vérification de la réponse pour calculer le score
        if ($qType === 'checkbox') {
            if (!is_array($userValue)) {
                $userValue = [];
            }
            sort($userValue);
            $expected = (array) $qAnswer;
            sort($expected);

            if ($userValue == $expected) {
                $scoreObtenu += $qScore;
            }
        } else {
            if ($userValue === $qAnswer) {
                $scoreObtenu += $qScore;
            }
        }
    }

    // -- 2) On récupère le nom du joueur (ex: "player_name") 
    // pour l'insérer en base :
    $playerName = $reponsesUser['player_name'] ?? 'Anonyme';

    // -- 3) Insertion du nom et du score dans la table "players"
    $stmt = $pdo->prepare("INSERT INTO players (name, score) VALUES (:name, :score)");
    $stmt->bindValue(':name',  $playerName, PDO::PARAM_STR);
    $stmt->bindValue(':score', $scoreObtenu, PDO::PARAM_INT);
    $stmt->execute();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Quiz PHP</title>
    <link rel="stylesheet" href="static/css/style.css">
</head>
<body>

<div class="container">
    <h1>Bienvenue sur mon mini-site de Quiz</h1>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Résultat du Quiz</h2>
        <p class="score">
            Score obtenu : <strong><?= $scoreObtenu ?></strong> / <?= $totalScore ?>
        </p>
        <h3>Vos réponses :</h3>
        <ul>
            <?php foreach ($questions as $question): ?>
                <?php
                    $qName    = $question['name'];
                    $userVal  = $reponsesUser[$qName] ?? null;
                    $expected = $question['answer'];

                    if (is_array($userVal)) {
                        $userVal = implode(', ', $userVal);
                    }
                    if (is_array($expected)) {
                        $expected = implode(', ', $expected);
                    }
                ?>
                <li>
                    <strong><?= htmlentities($question['text']) ?></strong><br>
                    Votre réponse : <em><?= htmlentities($userVal) ?></em><br>
                    Réponse attendue : <em><?= htmlentities($expected) ?></em>
                </li>
            <?php endforeach; ?>
        </ul>
        <p>
            <a href="index.php" class="retry-link">Recommencer le Quiz</a>
        </p>

    <?php else: ?>
        <form method="post" action="">
            <?php foreach ($questions as $question): ?>
                <div>
                    <label><strong><?= htmlentities($question['text']) ?></strong></label><br>
                    <?php
                    $qName = $question['name'];
                    $qType = $question['type'];
                    
                    switch ($qType) {
                        case 'text':
                            $textInput = new Text($qName, false, '');
                            echo $textInput->render();
                            break;
                        case 'radio':
                            if (!empty($question['choices'])) {
                                foreach ($question['choices'] as $choice) {
                                    ?>
                                    <label>
                                        <input 
                                            type="radio" 
                                            name="<?= htmlentities($qName) ?>" 
                                            value="<?= htmlentities($choice['value']) ?>"
                                        >
                                        <?= htmlentities($choice['text']) ?>
                                    </label><br>
                                    <?php
                                }
                            }
                            break;
                        case 'checkbox':
                            if (!empty($question['choices'])) {
                                foreach ($question['choices'] as $choice) {
                                    ?>
                                    <label>
                                        <input 
                                            type="checkbox"
                                            name="<?= htmlentities($qName) ?>[]"
                                            value="<?= htmlentities($choice['value']) ?>"
                                        >
                                        <?= htmlentities($choice['text']) ?>
                                    </label><br>
                                    <?php
                                }
                            }
                            break;
                        case 'textarea':
                            $textArea = new Textarea($qName, false, '');
                            echo $textArea->render();
                            break;
                        default:
                            echo "<input type=\"text\" name=\"" . htmlentities($qName) . "\" />";
                            break;
                    }
                    ?>
                </div>
            <?php endforeach; ?>

            <button type="submit">Envoyer</button>
        </form>
    <?php endif; ?>
    <p style="margin-top:2em;">
        <a href="leaderboard.php">Voir le classement</a>
    </p>
</div>

</body>
</html>
