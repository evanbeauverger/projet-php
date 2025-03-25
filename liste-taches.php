<html>
    <center>
    <h1>Liste de tâches</h1>

<?php
$dbh = new PDO('mysql:host=localhost;dbname=db_tache', "root", "");
$stmt = $pdo->query("SELECT nom_tache FROM tache");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row['tache'] . " " . "<input type='checkbox' />" . "<br>";
}
echo "<br><br>";
echo "<input type='submit' name='tache_fait' id='tache_fait' value='Enregistrer'>";
echo "</form>";

if (isset($_POST['tache-fait'])) {
    // Vérifier si des tâches ont été sélectionnées
    if (isset($_POST['taches'])) {

        $taches_cochées = $_POST['taches'];

        foreach ($taches_cochées as $id) {

            $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
            $stmt = $dbh->prepare("DELETE FROM tache WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }
}

?>
    
    </center>

