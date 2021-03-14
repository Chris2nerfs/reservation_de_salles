<?php
//PAGE INTERMEDIARE => QUE du PHP

//Importer et instancier une database
require_once($_SERVER['DOCUMENT_ROOT']."reservation-salle/config.php");
require_once (constant('ROOT_DIR')."/Database/database.php");

//creation de la connexion avec la database
$database = new Database();

//Récupérer les infos du formulaire avec $_POST
$batiment = $_POST["batiment"];
$numero = $_POST["numero"];
$etage = $_POST["etage"];
$secteur = $_POST["secteur"];
$nbPlaces= $_POST["nbPlaces"];

$intProjecteur = 0;
if(isset($_POST["projecteur"])){
    $intProjecteur = 1;
}

$intTableau = 0;
if(isset($_POST["tableau"])){
    $intTableau = 1;
}

$intTele = 0;
if(isset($_POST["tele"])){
    $intTele = 1;
}

//Appeler la function insertSalle en lui passant les infos du formulaire
$nouvelId = $database->insertSalle($batiment, $numero, $etage, $secteur, $nbPlaces, $intProjecteur, $intTableau, $intTele);

// Redirection vers la salle
header("Location:../admin.listeSalle.php");
?>