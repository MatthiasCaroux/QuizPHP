<?php
// leaderboard.php
try {
    $pdo = new PDO('sqlite:' . __DIR__ . '/quiz.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion à la base SQLite : " . $e->getMessage());
}


$sql = "SELECT name, score, created_at
        FROM players
        ORDER BY score DESC, created_at ASC
        ";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement</title>
    <link rel="stylesheet" href="static/css/leaderboard.css">
</head>
<body>

<div class="container">
    <h1>Classement des joueurs</h1>
    <?php if (!empty($rows)): ?>
        <table>
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Nom</th>
                    <th>Score</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $position = 1;
            foreach ($rows as $player): 
            ?>
                <tr>
                    <td><?= $position++ ?></td>
                    <td><?= htmlentities($player['name']) ?></td>
                    <td><?= $player['score'] ?></td>
                    <td><?= htmlentities($player['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun joueur enregistré pour le moment.</p>
    <?php endif; ?>

    <p style="margin-top:1em;">
        <a href="index.php">Retour au Quiz</a>
    </p>
</div>

</body>
</html>
