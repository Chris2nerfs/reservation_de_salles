<?php
// démarrage de la session utilisateur
session_start();

$idUser = $_SESSION['userId'];
$isAdmin = $_SESSION['isAdmin'];

?>
<!doctype html>
<html lang="fr">
<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "reservation-salle/config.php");
require_once(constant('ROOT_DIR') . "/Database/database.php");

$padding = "w-75";

$batiment = $_POST['batiment'];
$date = $_POST['date'];
$heureDebut = $_POST['heureDeb'];
$heureFin = $_POST['heureFin'];
if (isset($_POST['recurrence'])) {
  $recurrence = $_POST['recurrence'];
  $type = $_POST['type'];
  $dateFin = $_POST['dateFin'];
} else {
  $recurrence = 0;
  $type = 0;
  $dateFin = null;
}

$database = new Database();

$salles = $database->getSalleByCreneau($batiment, $date, $heureDebut, $heureFin);

?>

<head>
  <?php require_once(constant('ROOT_DIR') . "/Public/include/header_inc.php") ?>
</head>

<body>
  <div>
    <?php require_once(constant('ROOT_DIR') . "/Public/include/nav_inc.php") ?>

    <div class="col text-center pb-4">
      <h1 class="h1">Nouvelle réservation</h1>
    </div>

    <div class="container bg-primary shadow rounded my-auto">

      <form action="Process/process-insertReservations.php" method="POST">
        <br>

        <div class="row">
          <div class="col-sm-12 col-lg-6">

            <div class="form-group">
              <label for="batiment" class="text-dark">Bâtiment(s):</label> <br>
              <input class="form" id="batiment" name="batiment" readonly value="<?php echo ($batiment == "") ? "Tous les bâtiments": $batiment; ?>">
            </div>

            <div class="form-group">
              <label for="date" class="text-dark">Date</label> <br>
              <input id="id" type="date" name="dateJour" readonly value="<?php echo $date ?>">
              <span class="glyphicon glyphicon-calendar ml-1"></span>

            </div>

            <div class="form-group">
              <label for="heureDeb" class="text-dark">Heure de début:</label><br>
              <input type="time" id="heureDeb" name="heureDeb" value="<?php echo $heureDebut; ?>" readonly>
            </div>

            <div class="form-group">
              <label for="heureFin" class="text-dark">Heure de fin:</label><br>
              <input type="time" id="heureFin" name="heureFin" value="<?php echo $heureFin; ?>" readonly>
            </div>

            <div class=" <?php if($heureDebut < $heureFin){ echo "d-none";} ?> alert alert-danger">
            <?php if($heureDebut > $heureFin) { echo "Attention! Veuillez changer de créneau, l'heure de début et de fin sont inversées."; }
                  ?>
            </div>

          </div>

          <div class="col-sm-12 col-lg-6">

            <div class="form-group text-dark">
              <h4>Option de récurrence</h4>
            </div>

            <div class="form-group text-dark">

              <input type="checkbox" name="recurrence" value="1" <?php echo ($recurrence == 1) ? "checked" : "" ?> readonly>
              <label for="checkbox"> &ensp; <?php if ($recurrence == 1) {
                                              echo "Récurrence activée";
                                            } else {
                                              echo "Récurrence désactivée";
                                            } ?></label>
            </div>

            <div class="form-group text-dark">
              <label>Fréquence de récurrence</label>
            </div>

            <div class="form-group text-dark">
              <input type="radio" name="type" value="1" <?php echo ($type == 1) ? "checked" : ""  ?> readonly>
              <label for="jours"> &ensp; Journalière</label>
            </div>

            <div class="form-group text-dark">
              <input type="radio" name="type" value="2" <?php echo ($type == 2) ? "checked" : ""  ?> readonly>
              <label for="semaines"> &ensp; Hebdomadaire</label>
            </div>

            <div class="form-group text-dark">
              <input type="radio" name="type" value="3" <?php echo ($type == 3) ? "checked" : ""  ?> readonly>
              <label for="mois"> &ensp; Mensuelle</label>
            </div>

            <div class="form-group text-dark">
              <label for="dateFin" class="text-dark">Date de fin</label> <br>
              <input type="date" name="dateFin" readonly value="<?php echo $dateFin ?>">
              <span class="glyphicon glyphicon-calendar ml-1"></span>
            </div>
          </div>


          <div class="col-12">
            <div class="d-flex justify-content-center my-auto p-2">
              <a href="nouvelleReservation.php" class="btn btn-danger shadow rounded">Changer de créneau</a>

            </div>
          </div>

        </div>

    </div>


    <div class="container">

      <div class="form-group">
        <!-- Scroll Bar -->
        <div class="panelSalle col  pt-4 border_panel">
          <h4 class="h4">Choisissez une salle:</h4><br>
          <?php foreach ($salles as $salle) { ?>
            <div class="input-group">
              <div class="container">
                <div class="row">
                  <div class="custom-control custom-radio d-flex align-items-center">
                    <div class="input-group-text">
                      <input type="radio" name="salle_id" id="salle_id" value="<?php echo $salle->getId(); ?>" required>
                    </div>
                  </div>
                  <div class="col-11 bordure_verticale">
                    <?php include(constant('ROOT_DIR') . "/Public/include/salle_inc.php") ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group col  pt-4">
        <h4 class="h4" for="informations">Informations (noms des personnes, meeting, cours, etc...)</h4>
        <input type="text" maxlength="100" name="message" required class="form-control" id="informations" placeholder="Entrez les informations">
      </div>
      <div class="form-group col  pt-4">
        <button type="submit" class="btn btn-success shadow rounded">Réserver</button>
      </div>
    </div>
    </form>

  </div>

  <?php require_once(constant('ROOT_DIR') . "/Public/include/footer_inc.php") ?>
  <?php require_once(constant('ROOT_DIR') . "/Public/include/scripts_inc.php") ?>

</body>

</html>