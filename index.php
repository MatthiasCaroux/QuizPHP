<?php
// ---------------------------------------------------------------------------
// index.php
// Point d’entrée principal du site de Quiz
// ---------------------------------------------------------------------------

// 1. Chargement de l'autoloader (si nécessaire)
require_once __DIR__ . '/Classes/Autoloader.php';
Autoloader::register();

// 2. (Optionnel) Import de classes de formulaire que tu souhaites utiliser
use Form\Type\Text;
use Form\Type\Textarea;
// use Form\Type\Checkbox;
// use Form\Type\Radio;


// 3. Inclusion de la fonction pour charger les questions
require_once __DIR__ . '/question.php';

// Tentative de chargement des questions
try {
    $questions = getQuestions();
} catch (Exception $e) {
    // En cas d'erreur (fichier manquant, JSON corrompu, etc.)
    die("Erreur lors de la récupération des questions : " . $e->getMessage());
}

// 4. Variables pour le calcul du score
$totalScore   = 0;           // score total possible
$scoreObtenu  = 0;           // score de l'utilisateur
$reponsesUser = [];          // on stockera les réponses de l'utilisateur

// 5. Si le formulaire est soumis, on compare chaque réponse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($questions as $question) {

        $qName   = $question['name'];     // nom du champ (ex: 'ultime')
        $qType   = $question['type'];     // type du champ (text, radio, checkbox...)
        $qAnswer = $question['answer'];   // réponse attendue
        $qScore  = $question['score'];    // points accordés si bonne réponse

        // Incrément du score total
        $totalScore += $qScore;

        // Récupération de la réponse de l'utilisateur
        $userValue = $_POST[$qName] ?? null;

        // On stocke la réponse de l'utilisateur pour l'afficher ensuite
        $reponsesUser[$qName] = $userValue;

        // Vérification de la réponse
        if ($qType === 'checkbox') {
            // S'assure que ce soit un tableau
            if (!is_array($userValue)) {
                $userValue = [];
            }
            // Tri pour comparer sans se soucier de l'ordre
            sort($userValue);
            $expected = (array) $qAnswer;
            sort($expected);

            if ($userValue == $expected) {
                $scoreObtenu += $qScore;
            }

        } else {
            // text ou radio (ou tout autre champ simple)
            if ($userValue === $qAnswer) {
                $scoreObtenu += $qScore;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Quiz PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Bienvenue sur mon mini-site de Quiz</h1>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <!-- 
                Formulaire soumis : 
                1) Afficher le score 
                2) Afficher les réponses de l'utilisateur et la réponse attendue 
            -->
            <h2>Résultat du Quiz</h2>
            <p>Score obtenu : <strong><?= $scoreObtenu ?></strong> / <?= $totalScore ?></p>

            <h3>Vos réponses :</h3>
            <ul>
                <?php foreach ($questions as $question): ?>
                    <?php
                        $qName    = $question['name'];
                        $userVal  = $reponsesUser[$qName] ?? null;
                        $expected = $question['answer'];

                        // Formatage pour l'affichage
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
                <a href="index.php">Recommencer le Quiz</a>
            </p>

        <?php else: ?>
            <!-- 
                Formulaire non soumis : 
                Afficher le quiz (questions + champs de saisie)
            -->
            <form method="post" action="">
                <?php foreach ($questions as $question): ?>
                    <div class="form-group">
                        <label><strong><?= htmlentities($question['text']) ?></strong></label><br>

                        <?php
                        $qName = $question['name'];
                        $qType = $question['type'];
                        
                        switch ($qType) {
                            case 'text':
                                // Exemple d’utilisation de ta classe Text
                                // (Tu peux éventuellement passer un 3e param "value" si tu veux un placeholder)
                                $textInput = new Text($qName, false, '');
                                echo $textInput->render();
                                break;

                            case 'radio':
                                // On boucle sur les 'choices'
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
                                        </label>
                                        <br>
                                        <?php
                                    }
                                }
                                break;

                            case 'checkbox':
                                // Pour récupérer un tableau de réponses : name="drapeau[]"
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
                                        </label>
                                        <br>
                                        <?php
                                    }
                                }
                                break;

                            case 'textarea':
                                // Exemple d'utilisation de ta classe Textarea
                                $textArea = new Textarea($qName, false, '');
                                echo $textArea->render();
                                break;

                            default:
                                // Si tu as d’autres types (date, select, etc.), gère-les ici.
                                echo "<input type=\"text\" name=\"" . htmlentities($qName) . "\" />";
                                break;
                        }
                        ?>
                    </div>
                <?php endforeach; ?>

                <button type="submit">Envoyer</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
