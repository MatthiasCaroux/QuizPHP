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
    $source = __DIR__ . '/data/questions.json'; // Chemin vers ton fichier JSON
    $content = @file_get_contents($source); // @ pour éviter l'avertissement si le fichier n'existe pas

    if ($content === false) {
        throw new Exception("Impossible de lire le fichier JSON : $source");
    }

    $questions = json_decode($content, true);

    if (empty($questions) || !is_array($questions)) {
        throw new Exception("Le contenu du fichier JSON est invalide ou vide.");
    }

    return $questions;
}
