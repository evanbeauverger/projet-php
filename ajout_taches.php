<?php
$tache = $_POST['tache'];
if ($tache){
    // Connexion à la base de données

    $dbh = new PDO('mysql:host=localhost;dbname=db_tache', "root", "root");

    // Préparation de la requête
    $stmt = $dbh->prepare("INSERT INTO tache (nom_tache) VALUES (:tache)");

    //Déclaration des variables
    $tache = $_POST['tache'];

    // Liaison des paramètres
    $stmt->bindParam(':tache', $tache);

    // Exécution de la requête
    $stmt->execute();

    $log = new Logger('fichier.log');
    $log->info("La tâche à été ajoutée");

}
?>
<html>
    <center>
    <h1>Tâche ajouté</h1>
    <form action="index.php">
        <input type="submit" value="retour">
    </form>