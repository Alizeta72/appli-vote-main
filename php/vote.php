<?php
$vote = $_POST['vote'] ?? null;

if ($vote) {
    $host = getenv('POSTGRES_HOST');
    $dbname = getenv('POSTGRES_DB');
    $user = getenv('POSTGRES_USER');
    $password = getenv('POSTGRES_PASSWORD');

    try {
        $dsn = "pgsql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $stmt = $pdo->prepare("INSERT INTO votes (vote_option) VALUES (:vote)");
        $stmt->execute(['vote' => $vote]);

        $message = "Merci d'avoir voté pour : <strong>" . htmlspecialchars($vote) . "</strong>";
        $success = true;
    } catch (PDOException $e) {
        $message = "Erreur de connexion à la base de données : " . htmlspecialchars($e->getMessage());
        $success = false;
    }
} else {
    $message = "Aucun vote sélectionné. Veuillez voter.";
    $success = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat du vote</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
        }
        h1 {
            font-size: 1.5rem;
            color: <?= $success ? "#28a745" : "#dc3545" ?>;
        }
        p {
            font-size: 1rem;
            color: #333;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background: #0056b3;
        }
        .secondary {
            background: #6c757d;
        }
        .secondary:hover {
            background: #565e64;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $success ? "✅ Vote enregistré" : "❌ Erreur" ?></h1>
        <p><?= $message ?></p>
        <a href="index.php" class="secondary">Retour au vote</a>
      
    </div>
</body>
</html>
