<?php    
require_once '../config/database.php';
require_once '../pages/formulaire_etudiant.php';


?>


<?php
if (isset($_POST['inscription'])) {

    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $phone = htmlspecialchars($_POST['phone']);
    $birth_date = htmlspecialchars($_POST['birth_date']);
   $created_at = $_POST['created_at'] ?? date('Y-m-d H:i:s');
    $gender = htmlspecialchars($_POST['gender']);
    $classes_id = $_POST['classes_id']; 
   
    $stmt = $db_connect->prepare("INSERT INTO students (classes_id, first_name, phone, birth_date, created_at, gender, last_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(['classes_id'=> $classes_id, 'first_name'=>$first_name, 'phone'=> $phone, 'birth_date' => $birth_date, 'created_at'=>  $created_at, 'gender'=> $gender,'last_name'=> $last_name]);
   
    header("Location: ../pages/formulaire_etudiant.php");
    exit;
}

?>