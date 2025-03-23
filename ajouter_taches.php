<?php
// Vérifier si la description de la tâche est envoyée
if (isset($_POST['tache'])) {
    // Récupérer la description de la tâche
    $tache = $_POST['tache'];

    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "taches_db");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer et exécuter la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO taches (tache) VALUES (?)");
    $stmt->bind_param("s", $tache);  // "s" indique que la variable est une chaîne
    $stmt->execute();

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}

// Rediriger vers la page d'accueil
header("Location: index.php");
exit();