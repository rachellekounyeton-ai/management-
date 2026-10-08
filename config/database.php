<?php 

$db_username = 'root';
$db_userpass = '';
$db_name = 'management';

try{
$db_name = 'management';
$db_connect = new PDO("mysql:host=localhost;dbname=$db_name;charset=utf8" , $db_username, $db_userpass);
$db_connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
// die ('Une erreur est survenue lors de la connexion au site web')
echo "Erreur de connexion a la base de donnee" . $e->getMessage();
exit;


}



?>