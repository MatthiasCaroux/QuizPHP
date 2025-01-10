<?php

require_once('src/Autoloader.php');
require_once('./questions/RadioQuestions.php');

// Charger le fichier JSON
$jsonData = json_decode(file_get_contents("https://geoffroycochard.github.io/iuto.but2.php/resources/data/model.json")
, true);

// Liste des questions
$questions = array();

foreach ($jsonData as $data) {
    if ($data['type'] === 'radio') {
        $questions[] = new RadioQuestions($data['uuid'], $data['label'], $data['choices'], $data['correct']);
    }
    // } elseif ($data['type'] === 'text') {
    //     $questions[] = new TextField($data['uuid'], $data['label']);
    // }
}
?>
<h1>Répondez aux questions</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php foreach ($questions as $question): ?>
        <?php $question->display(); ?>
    <?php endforeach; ?>
