<?php
// Connexion à la base de données
$dbh = new PDO('mysql:host=localhost;dbname=tache', $user, $pass);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tache'])) {
    $tache = $_POST['tache'];
    // Préparation de la requête
    $stmt = $dbh->prepare("INSERT INTO taches (tache) VALUES ($tache)");

    // Exécution de la requête
    $stmt->execute();
}
?>
<html>
    <body>
    <center>
        <h1>Tâche ajoutée à la liste de tâche</h1>
        <form action="main.html" >
            <button>Accueil</button>
        </form>
    </center>
    </body>
</html>