<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/reservation_de_salles/public/config.php");
require_once(constant('ROOT_DIR') . "../../database/database.php");


/*
$user = 'root';
$pass = 'digital2019';

try {
     $dbh = new PDO('mysql:host=mariadb;dbname=mysql', $user, $pass);
     $dbh = null;
     echo "Success: A proper connection to MySQL was made! The docker database is great.<br>";
} catch (PDOException $e) {
     echo "Error: Unable to connect to MySQL. <br>";
     print $e->getMessage() . "<br>";
     die();
}
*/


echo 'ROOT_DIR => ' . __DIR__ . "<br><br>";

echo 'DOCUMENT_ROOT => ' . $_SERVER['DOCUMENT_ROOT'] . "<br><br>";

echo "HTTP_HOST => [{$_SERVER['HTTP_HOST']}]<br><br>";

echo "SERVER_NAME => [{$_SERVER['SERVER_NAME']}]<br><br>";


// Je retourne la liste des réservations

/*
//$insertuser = $database->insertUser("Nawaz", "bugti", "nawazt", "password", 0, 0, "token 10");
//echo "<h1> $insertuser u have insert the new user";
$password = $database->getPassword(888888887);
echo $password;

//$user = $database->getUserById(1);
//echo $user;
echo '<pre>';
  var_dump($password);
  echo '</pre>';
*/
/*
$insertuser = $database->insertUser("Tommy", "Boower", "tommy.boower@realise.ch", "password", 0, 1, "token 10");
echo "<h1> $insertuser You have insert the new user.\n";
*/

/*
$getreservationbydate = $database->getReservationByDate("2019-09-12" );
    echo " <br><ul>";

    foreach( $getreservationbydate as $test){
        echo "<li> ID =" ." ".$test->getId().", "."</li>".
        "<li> Salle ID ="." ". $test->getSalle_id().", "."<br>"."</li>".
        "<li> User ID ="." ". $test->getUser_id().", "."<br>"."</li>".
        "<li> Date Jour ="." ". $test->getDateJour().", "."<br>"."</li>".
        "<li> Heure Depart ="." ".$test->getHeuredepart().", "."<br>"."</li>".
        "<li> Heure Fin =" ." ". $test->getHeurefin().", "."<br>"."</li>".
        "<li> Message ="." ".$test->getMessage().", "."<br>"."</li>"."<br>".


        "</li>";
       }
       "</ul>";



       $salle = $database->getAllSalle();

       echo "<ul> <h1> Reservation by salle </h1> <br>";
       foreach($salle as $Salle){
          echo "<li> ID =" ." ".$Salle->getId().", "."</li>".
          "<li> Numero Salle  ="." ".$Salle->getNumero().", "."<br>"."</li>".
          "<li> Stage ="." ". $Salle->getEtage().", "."<br>"."</li>".
          "<li> Batiment ="." ". $Salle->getBatiment().", "."<br>"."</li>".
          "<li> Sector ="." ".$Salle->getSecteur().", "."<br>"."</li>".
          "<li> Nombre de place =" ." ". $Salle->getNombrePlaces().", "."<br>"."</li>".
          "<li> Projecture ="." ".$Salle->hasProjecteur().", "."<br>"."<br>".
          "</li>";
     }
     "</ul>";



   $currentdate = date("Y-m-d");
     $fullreservation = $database->getFullReservationbydate($currentdate);



     echo "<ul>";
     foreach($fullreservation as $Fullreservation){
        echo "<h1> Reservation by date </h1> <br><li> ID =" ." ".$Fullreservation->getId().", "."</li>"."<br>".
        "<li> User id  ="." ".$Fullreservation->getUser_id().", "."<br>"."</li>"."<br>".
        "<li> Date de Jour ="." ". $Fullreservation->getDateJour().", "."<br>"."</li>"."<br>".
        "<li> Numero De salle ="." ". $Fullreservation->getNumero().", "."<br>"."</li>"."<br>".
        "<li> Sector ="." ".$Fullreservation->getSecteur().", "."<br>"."</li>".
        "<li> Etage =" ." ". $Fullreservation->getEtage().", "."<br>"."</li>".
        "<li> Number de place ="." ".$Fullreservation->getNombrePlaces().", "."<br>"."<br>"."</li>".
        "<li> Heure de depart ="." ".$Fullreservation->getHeuredepart().", "."<br>"."<br>"."</li>".
        "<li> Heure de fin ="." ".$Fullreservation->getHeurefin().", "."<br>"."<br>"."</li>".
        "<li> Projecture ="." ".$Fullreservation->hasProjecteur().", "."<br>"."<br>"."</li>".
        "<li> Batiment  ="." ".$Fullreservation->getBatiment().", "."<br>"."<br>"."</li>".
        "<li> Message ="." ".$Fullreservation->getMessage().", "."<br>"."<br>"."</li>".
        "<li> Salle ="." ".$Fullreservation->getSalle_id().", "."<br>"."<br>"."</li>".


        "</li>";
   }
   "</ul>";



// Tester activation du user
// 1. Récupérer un user dans la base de données
$user = $database->getUserById(93);
// 2. Vérifier que le user n'est pas actif
if ($user->isActif() == 0) {
     echo "le user n'est pas actif";

     // 3. Activer le user
     $database->activeUser($user->getId());

     // 4. Re-récupérer le user dans la base de données
     $user = $database->getUserById($user->getId());

     // 5. Vérifier que le user est actif
     if ($user->isActif() == 1) {
          echo "le user a été activé => test OK";
     } else {
          echo "le user n'a pas été activé => test Fail";
     }
} else {
     echo "le user est déjà actif";
}
*/
