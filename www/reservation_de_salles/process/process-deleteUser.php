<?php
// démarrage de la session utilisateur

    session_start();
    $idUser = $_SESSION['userId'];
    $isAdmin = $_SESSION['isAdmin'];
    
// Import de la databse
require_once($_SERVER['DOCUMENT_ROOT']."reservation-salle/config.php");
require_once (constant('ROOT_DIR')."/Database/database.php");
// Création de la connexion
$database = new Database();
// Récupérer l'id depuis l'url
$user = $_GET["id"];
// Je supprime la réservation et je récupère le resultat
$resultat = $database->deleteUser($user);
if($resultat == true){
    // Si la supression a fonctionné je redirige vers quoi?
    // php url redirection
    header('Location: ../admin.user.php'); 
}else{
    // Si ca n'a pas fonctionné afficher un message
    echo "Suppression impossible";
}
?>
