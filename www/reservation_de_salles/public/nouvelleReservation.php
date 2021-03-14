<?php
// démarrage de la session utilisateur
    session_start();
    
    $idUser = $_SESSION['userId'];
    $isAdmin = $_SESSION['isAdmin'];

?>
<!doctype html>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "reservation-salle/config.php");
require_once(constant('ROOT_DIR') . "/Database/database.php");

// appeler getBatiments
//Instance nouvelle database 
$database = new Database();

$batiments = $database->getBatiments(); // On récupère la liste des bâtiment: ["Viget", "Boissonaz"]

// date du jour pour le calendrier
$today = date("Y-m-d");

?>
<html lang="fr">

<head>
  <?php require_once(constant('ROOT_DIR') . "/Public/include/header_inc.php") ?>
</head>

<body>
  <div>
    <?php require_once(constant('ROOT_DIR') . "/Public/include/nav_inc.php") ?>

    <div class="col text-center pb-4">
      <h1 class="h1">Nouvelle réservation</h1>
    </div>

    <div class="container bg-primary shadow my-auto">

      <form action="nouvelleReservationFin.php" method="POST">
        <br>

        <div class="row">
          <div class="col-sm-12 col-lg-6">

            <div class="form-group">
              <label for="batiment" class="text-dark">Choisissez un bâtiment:</label> <br>
              <select class="form" id="batiment" name="batiment">
                <option value="" selected>Tous les bâtiments</option>
                <?php foreach ($batiments as $batiment) { ?>
                  <option value="<?php echo $batiment; ?>"><?php echo $batiment; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="date" class="text-dark">Date:</label> <br>
              <input type="date" name="date" min="<?php echo $today ?>" required><span class="glyphicon glyphicon-calendar ml-2">
            </div>

            <div class="form-group">
              <label for="heureDeb" class="text-dark">Heure de début:</label><br>
              <input type="time" name="heureDeb" id="heureDeb" required>
            </div>

            <div class="form-group">
              <label for="heureFin" class="text-dark">Heure de fin:</label><br>
              <input type="time" name="heureFin" id="heureFin" required>
            </div>
          </div>

          <div class="col-sm-12 col-lg-6">

            <div class="form-group text-dark">
              <h4>Option de récurrence</h4>
            </div>

            <div class="form-group text-dark">
              <input type="checkbox" name="recurrence" value="1" aria-describedby="reccurenceHelp">
              <label for="checkbox"> &ensp; Récurrence</label>
              <small id="reccurenceHelp" class="form-text text-muted">Cochez cette case si vous souhaitez faire une réservation récurrente</small>
            </div>

            <div class="form-group text-dark">
              <label>Fréquence de récurrence</label>
            </div>

            <div class="form-group text-dark">
              <input type="radio" name="type" value="1">
              <label for="jours"> &ensp; Journalière</label>
            </div>

            <div class="form-group text-dark">
              <input type="radio" name="type" value="2">
              <label for="semaines"> &ensp; Hebdomadaire</label>
            </div>

            <div class="form-group text-dark">
              <input type="radio" name="type" value="3">
              <label for="mois"> &ensp; Mensuelle</label>
            </div>

            <div class="form-group text-dark">
              <label for="dateFin" class="text-dark">Date de fin:</label> <br>
              <input type="date" name="dateFin" min="<?php echo $today ?>"><span class="glyphicon glyphicon-calendar ml-2">
            </div>
            
          </div>


          <div class="col-12">
            <div class="d-flex justify-content-center my-auto p-2">
              <button type="submit" name="valider" class="btn btn-success shadow rounded">Chercher une salle</button>
            </div>
          </div>

        </div>
      </form>

    </div>
  </div>

  <?php require_once(constant('ROOT_DIR') . "/Public/include/footer_inc.php") ?>
  <?php require_once(constant('ROOT_DIR') . "/Public/include/scripts_inc.php") ?>

</body>

</html>