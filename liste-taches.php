<?php
// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root"; // Nom d'utilisateur pour MySQL
$password = ""; // Mot de passe pour MySQL
$dbname = "gestion_taches"; // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Traitement des cases à cocher (mettre à jour le statut de la tâche)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tache_id']) && isset($_POST['fait'])) {
        $tache_id = $_POST['tache_id'];
        $fait = $_POST['fait'] == 'on' ? 1 : 0;
        
        // Mettre à jour l'état de la tâche
        $sql = "UPDATE taches SET fait = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $fait, $tache_id);
        $stmt->execute();
    }
}

// Récupérer toutes les tâches depuis la base de données
$sql = "SELECT id, tache, fait FROM taches";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tâches</title>
</head>
<body>
    <h1>Liste des Tâches</h1>

    <form method="post">
        <table border="1">
            <tr>
                <th>Tâche</th>
                <th>Fait</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['tache']); ?></td>
                    <td>
                        <input type="checkbox" name="fait" <?php echo $row['fait'] == 1 ? 'checked' : ''; ?> 
                               onchange="this.form.submit()">
                        <input type="hidden" name="tache_id" value="<?php echo $row['id']; ?>">
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </form>

    <h2>Ajouter une Tâche</h2>
    <form action="ajouter_tache.php" method="post">
        <input type="text" name="tache" placeholder="Nouvelle tâche" required>
        <button type="submit">Ajouter</button>
    </form>

</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>
