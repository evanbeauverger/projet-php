<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

?>
<html>
<head> <title> To do list </title> 
<meta charset="utf-8">
<head>

<body>
<div style="text-align: center;">  

    <h1> To do list </h1>
    <br/>
    
    <!--ajouter une tâche -->
    <form action="ajout_taches.php" method="post">
    Ajouter une tâche : <input type=text id="tache" name="tache">  <input type=submit value="Ajouter" >
    </form>
    <br/>
    
    <!-- voir la liste de tâche -->
    <form action="liste-taches.php" >
    Voir la liste de tâches : <input type=submit value="liste tâches" >
    </form>
 
</div>
</body>
</html> 
