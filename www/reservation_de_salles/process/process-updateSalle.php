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
$batiment = $_POST["batiment"];
$numero = $_POST["numero"];
$etage = $_POST["etage"];
$secteur= $_POST["secteur"];
$nbPlaces=$_POST["nbPlaces"];

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

if (isset($_POST['tele'])) {
    //$tele is checked and value = 1
    $tele = $_POST['tele'];
} else {
    //$tele is not checked and value=0
    $tele = 0;
}


// Appeler la fonction updateSalle en lui passant les paramètres
$database->updateSalle($id, $batiment, $numero, $etage, $secteur, $nbPlaces, $projecteur, $tableau, $tele);

// Redirection vers la salle
header("Location:../admin.listeSalle.php");
?>