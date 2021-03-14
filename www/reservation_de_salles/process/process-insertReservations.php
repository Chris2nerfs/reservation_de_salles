<?php
// démarrage de la session utilisateur
session_start();
    
$idUser = $_SESSION['userId'];
$isAdmin = $_SESSION['isAdmin'];


require_once ($_SERVER['DOCUMENT_ROOT']."reservation-salle/config.php");
require_once (constant('ROOT_DIR')."/Database/database.php");

$database = new Database();

$reccurente = 0;
if(isset($_POST['recurrence'])){
    $reccurente = $_POST['recurrence'];
}

// Données communes du formulaire
$batiment = $_POST ['batiment'];
$salle_id = $_POST ['salle_id'];
$dateJour = $_POST ['dateJour'];
$heureDepart = $_POST ['heureDeb'];
$heureFin = $_POST ['heureFin'];
$message = $_POST ['message'];

if($reccurente == 1){
    // récupérer les données spécifiques à la reccurence
    $type = $_POST['type'];
    $dateFin = date("Y-m-d");
    if(isset($_POST['dateFin'])){
        $dateFin = $_POST['dateFin'];
    }
    

    $reccurenceId = $database->insertRecurrenteReservation($dateJour, $dateFin, $type, $idUser);

    switch($type){
        case 1 : $shift = "day";
                break;
        case 2 : $shift ="week";
                break;
        case 3 : $shift = "month";
                break;      

    }

    $dateResa = $dateJour;

    while($dateResa <= $dateFin){
        $database->insertReservation($salle_id, $idUser, $dateResa, $heureDepart, $heureFin, $message, $reccurenceId);
        $dateResa = strtotime(date("Y-m-d",strtotime($dateResa))."+ 1 ".$shift);
        $dateResa = date("Y-m-d",$dateResa);

    }
   

}
else{

    $insertreservation = $database->insertReservation($salle_id, $idUser, $dateJour, $heureDepart, $heureFin, $message, null);
}

header("Location: ../reservations.php");
