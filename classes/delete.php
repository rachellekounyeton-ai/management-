
<?php    
require_once '../config/database.php';


?>
<?php

// Supprimer une tâche
if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    $stmt = $db_connect->prepare(
        "DELETE FROM classes WHERE id = ?"
    );

    $stmt->execute([$id]);

    header("Location: ../pages/liste_classe.php");
    exit;
}
 header("Location: ../pages/liste_classe.php");   


?>


