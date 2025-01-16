<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionText = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correctOption = $_POST['correctOption'];
    $score = $_POST['score'];  // Récupérer le score

    // Construire les choix avec leurs valeurs
    $choices = [
        ['text' => $option1, 'value' => strtolower($option1)],
        ['text' => $option2, 'value' => strtolower($option2)],
        ['text' => $option3, 'value' => strtolower($option3)],
        ['text' => $option4, 'value' => strtolower($option4)],
    ];

    // Identifier l'option correcte
    $answer = strtolower($_POST[$correctOption]);  // l'option correcte doit être en minuscule

    // Créer une nouvelle question dans le format désiré
    $newQuestion = [
        'name' => 'cheval',  // Vous pouvez changer ce nom selon vos besoins
        'type' => 'radio',
        'text' => $questionText,
        'choices' => $choices,
        'answer' => $answer,
        'score' => (int)$score  // Utiliser la valeur du score récupéré
    ];

    $jsonFile = 'data/questions.json';
    
    // Vérifier si le fichier existe déjà
    if (file_exists($jsonFile)) {
        $questions = json_decode(file_get_contents($jsonFile), true);
    } else {
        $questions = [];
    }

    // Ajouter la nouvelle question
    $questions[] = $newQuestion;

    // Sauvegarder le fichier JSON avec la nouvelle question
    file_put_contents($jsonFile, json_encode($questions, JSON_PRETTY_PRINT));
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une question</title>
</head>
<body>
    <h1>Ajouter une question</h1>
    <form action="add_question.php" method="post">
        <!-- Champ pour la question -->
        <label for="question">Question :</label>
        <input type="text" id="question" name="question" required><br><br>

        <!-- Champs pour les options -->
        <label for="option1">Option 1 :</label>
        <input type="text" id="option1" name="option1" required><br><br>

        <label for="option2">Option 2 :</label>
        <input type="text" id="option2" name="option2" required><br><br>

        <label for="option3">Option 3 :</label>
        <input type="text" id="option3" name="option3" required><br><br>

        <label for="option4">Option 4 :</label>
        <input type="text" id="option4" name="option4" required><br><br>

        <!-- Sélectionner l'option correcte -->
        <label for="correctOption">Option correcte :</label>
        <select id="correctOption" name="correctOption" required>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
        </select><br><br>

        <!-- Champ pour définir le score -->
        <label for="score">Score :</label>
        <input type="number" id="score" name="score" value="2" required><br><br>

        <!-- Soumettre le formulaire -->
        <button type="submit">Ajouter la question</button>
    </form>
</body>
</html>
