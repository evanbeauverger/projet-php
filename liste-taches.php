<html>
    <center>
    <h1>Liste de tâches</h1>

<?php
// connexion BD
$dbh = new PDO('mysql:host=localhost;dbname=db_tache', "root", "root");

// selectionne les tâches dans la table tache
$stmt = $dbh->query("SELECT nom_tache FROM tache");

// affiche les tâches de la BD avec une case de type checkbox
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row['nom_tache'] . " " . "<input type='checkbox' name='id' id='id' />" . "<br>";
}

echo "<br><br>";

// Supprimes les tâches cocher
echo "<input type='submit' name='tache_fait' id='tache_fait' value='Enregistrer'>";
echo "</form>";

if (isset($_POST['tache-fait'])) {
    // Vérifier si des tâches ont été sélectionnées
    if (isset($_POST['id'])) {

        $taches_cochées = $_POST['id'];
        
        foreach ($taches_cochées as $id) {
            // connexion a la BD pour supprimer les tâches cocher
            $dbh = new PDO('mysql:host=localhost;dbname=db_tache', 'root', 'root');
            $stmt = $dbh->prepare("DELETE FROM tache WHERE id = :id");
            $id=$row['id'];
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }
}

?>
    
    </center>

