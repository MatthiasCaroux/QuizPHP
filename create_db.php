<?php
// create_db.php

try {
    // 1. Connexion à SQLite (fichier local quiz.db)
    $pdo = new PDO('sqlite:' . __DIR__ . '/quiz.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Création de la table "players" si elle n'existe pas déjà
    $sql = "CREATE TABLE IF NOT EXISTS players (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                score INTEGER NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )";
    $pdo->exec($sql);

    echo "Base de données et table créées (ou déjà existantes).";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
