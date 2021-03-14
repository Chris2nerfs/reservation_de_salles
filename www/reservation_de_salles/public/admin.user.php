<?php
// démarrage de la session utilisateur
session_start();

$idUser = $_SESSION['userId'];
$isAdmin = $_SESSION['isAdmin'];

if ($isAdmin != 1) {
  // Redirection vers les reservations
  header("Location:reservations.php");
  exit;
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/public/config.php");
require_once(constant('ROOT_DIR') . "../database/database.php");
$database = new Database();
$users = $database->getAllUsers();
$padding = "";
?>
<!doctype html>
<html lang="fr">


<head>
  <?php require_once(constant('ROOT_DIR') . "../include/header_inc.php") ?>
</head>

<body>
  <div>
    <?php require_once(constant('ROOT_DIR') . "../include/nav_inc.php") ?>
    <div class="col text-center pb-4">
      <h1 class="h1">Utilisateurs</h1>
    </div>
    <div class="container p-4">

      <?php
      foreach ($users as $user) {

        include('../include/adminUser_inc.php');
      }
      ?>
    </div>
  </div>
  <?php require_once(constant('ROOT_DIR') . "../include/footer_inc.php") ?>
  <?php require_once(constant('ROOT_DIR') . "../include/scripts_inc.php") ?>
</body>

</html>
