<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "taches_db");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer toutes les tâches
$result = $conn->query("SELECT id, description, fait FROM taches ORDER BY date_creation DESC");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des tâches</title>
</head>
<body>
    <h1>Liste des tâches</h1>

    <form action="enregistrer_taches.php" method="POST">
        <table border="1">
            <thead>
                <tr>
                    <th>Tâche</th>
                    <th>Fait</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Vérifier si des tâches existent
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Afficher chaque tâche avec une case à cocher
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td><input type='checkbox' name='taches[]' value='" . $row['id'] . "' " . ($row['fait'] ? 'checked' : '') . "></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Aucune tâche trouvée.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <button type="submit">Enregistrer</button>
    </form>

</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>
