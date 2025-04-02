<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$tache = $_POST['tache'];
if ($tache){
    // Connexion à la base de données
    $dbh = new PDO("mysql:host=localhost;dbname=db_tache", "root", "root");

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

echo $twig->render('ajout.html.twig', ['tache' => $tache]);
?>
