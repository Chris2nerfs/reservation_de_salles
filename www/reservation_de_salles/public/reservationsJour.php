<?php
// démarrage de la session utilisateur
    session_start();
    
    $idUser = $_SESSION['userId'];
    $isAdmin = $_SESSION['isAdmin'];

?>
<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "reservation-salle/config.php");
  require_once(constant('ROOT_DIR') . "/Database/database.php");

  $database = new Database;
  $dateJour = date("Y-m-d");

  // take the current date

  //my function which i create for all reservation 
  $initialTab = $database->getFullReservationbydate($dateJour);

  //first create the empty arry 
  $result = [];
  foreach ($initialTab as $resa) {
    if (array_key_exists($resa->getBatiment(), $result)) {
      if (array_key_exists($resa->getNumero(), $result[$resa->getBatiment()])) {
        array_push($result[$resa->getBatiment()][$resa->getNumero()], $resa);
      } else {
        $result[$resa->getBatiment()][$resa->getNumero()] = [$resa];
      }
      } else {
      $result[$resa->getBatiment()][$resa->getNumero()] = [$resa];
      }
  }
  ?>
  <head>
    <?php require_once(constant('ROOT_DIR') . "/Public/include/header_inc.php") ?>
  </head>
<body>
  <div>
    <?php require_once(constant('ROOT_DIR') . "/Public/include/nav_inc.php") ?>
    
    
    <div class="col text-center pb-4">
      <h1 class="h1"> Réservations du jour</h1>
    </div>


    <div class="container">

    <!--start of main accordion-->

    <div id="accordion">
      <?php foreach ($result as $batiment => $salleTable) { ?>
        <div class="card">

          <div class="card-header" id="heading<?php echo $batiment ?>">
            <h5 class="mb-0 d-inline">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $batiment ?>" aria-expanded="true" aria-controls="collapse<?php echo $batiment ?>">
                <?php echo $batiment; ?>
              </button>
            </h5>
          </div>

          <div id="collapse<?php echo $batiment ?>" class="collapse show" aria-labelledby="heading<?php echo $batiment ?>" data-parent="#accordion">

            <!--start of second accordion-->
            <div class="card-body" id="child<?php echo $batiment ?>">
              <?php foreach ($salleTable as $salle => $reservationTable) { ?>
                <div class="card">
                  <div class="card-header">
                    <a href="#" data-toggle="collapse" data-target="#collapse<?php echo $salle ?>">
                      Salle <?php echo $salle  ?>
                    </a>
                  </div>
                  <div class="card-body collapse" data-parent="#child<?php echo $batiment ?>" id="collapse<?php echo $salle ?>">
                    <?php foreach ($reservationTable as $reservation) {
                          include(constant('ROOT_DIR') . "/Public/include/reservation_inc.php");
                        } ?>
                  </div>
                </div>
              <?php } ?>
              <!--end of second accordion-->
            </div>

          </div>

        </div>
      <?php } ?>

      <!--end of  main accordion-->
    </div>

    </div>


  </div>
  <?php require_once(constant('ROOT_DIR') . "/Public/include/footer_inc.php") ?>
  <?php require_once(constant('ROOT_DIR') . "/Public/include/scripts_inc.php") ?>

</body>

</html>