<?php
// démarrage de la session utilisateur
    session_start();
    
    $idUser = $_SESSION['userId'];
    $isAdmin = $_SESSION['isAdmin'];

    if($isAdmin != 1){
      // Redirection vers les reservations
      header("Location:reservations.php");
      exit;
    }
?>
<!doctype html>
<html lang="fr">

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "reservation-salle/config.php");
require_once(constant('ROOT_DIR') . "/Database/database.php");

$padding = "";

$database = new Database();

$salles = $database->getAllSalle();

?>

  <head>
    <?php require_once(constant('ROOT_DIR') . "/Public/include/header_inc.php") ?>
  </head>

  <body>
    <?php if($isAdmin == 1){ ?>
      <div>
        <?php require_once(constant('ROOT_DIR') . "/Public/include/nav_inc.php") ?>
        <div class="col text-center pb-4">
          <h1 class="h1"> Salles à disposition</h1>
        </div>
          <?php 
          foreach ($salles as $salle) {
          include('include/salle_inc.php');
          }
          ?>
        </div>
        <?php } ?>
      <?php require_once(constant('ROOT_DIR') . "/Public/include/footer_inc.php") ?>
      <?php require_once(constant('ROOT_DIR') . "/Public/include/scripts_inc.php") ?>
  </body>
</html>