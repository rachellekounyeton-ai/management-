<?php    
require_once '../config/database.php';
require_once '../pages/formulaire_classe.php';


?>


<?php
if (isset($_POST['creer'])) {

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $created_at = $_POST['created_at']?? date('Y-m-d H:i:s') ;


    $stmt = $db_connect->prepare("INSERT INTO classes (name, description, created_at) VALUES ( ?, ?, ?)");
    $stmt->execute([$name, $description, $created_at]);




    header("Location: ../pages/formulaire_classe.php");
    exit;
}

?>