<?php
// question.php

/**
 * Récupère la liste des questions depuis un fichier JSON.
 *
 * @return array Renvoie un tableau de questions.
 * @throws Exception Si le JSON est vide ou invalide.
 */
function getQuestions(): array
{
    $source = __DIR__ . '/data/questions.json'; 
    $content = @file_get_contents($source); 
    if ($content === false) {
        throw new Exception("Impossible de lire le fichier JSON : $source");
    }

    $questions = json_decode($content, true);

    if (empty($questions) || !is_array($questions)) {
        throw new Exception("Le contenu du fichier JSON est invalide ou vide.");
    }

    return $questions;
}
