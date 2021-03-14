<?php
// démarrage de la session utilisateur

    session_start();
    $idUser = $_SESSION['userId'];
    $isAdmin = $_SESSION['isAdmin'];
    
//PAGE INTERMEDIAIRE  => QUE DU PHP

// Import de la database
require_once($_SERVER['DOCUMENT_ROOT']."reservation-salle/config.php");
require_once(constant('ROOT_DIR')."/Database/database.php");

//Création de la connexion avec la database
$database = new Database();

//Récupérer toutes les données de la salle avec $_POST
$id = $_POST["id"];
$salle_id = $_POST["salle_id"];
$dateJour= $_POST["dateJour"];
$heureDepart = $_POST["heureDep"];
$heureFin = $_POST["heureFin"];
$message =$_POST["message"];

if (isset($_POST['projecteur'])) {
    //$projecteur is checked and value = 1
    $projecteur = $_POST['projecteur'];
    } else {
    //$projecteur is not checked and value=0
    $projecteur = 0;
    }

if (isset($_POST['tableau'])) {
        //$projecteur is checked and value = 1
        $tableau = $_POST['tableau'];
        } else {
        //$projecteur is not checked and value=0
        $tableau = 0;
        }


// Appeler la fonction updateSalle en lui passant les paramètres
$database->updateReservation($id,$salle_id,$idUser,$dateJour,$heureDepart,$heureFin, $message,$projecteur, $tableau);

// Redirection vers la salle
header("Location:../reservations.php");
?>