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

  $initialTab = $database->getUserReservation($idUser);

  $result = [];
  foreach ($initialTab as $resa) {
    if (array_key_exists($resa->getDateJour(), $result)) {
      array_push($result[$resa->getDateJour()], $resa);
    } else {
    $result[$resa->getDateJour()] = [$resa];
  }
}

?>

<head>
  <?php require_once(constant('ROOT_DIR') . "/Public/include/header_inc.php") ?>
</head>

<body>
  <div>
    <div>
      <?php require_once(constant('ROOT_DIR') . "/Public/include/nav_inc.php") ?>
    </div>
    <div class="col text-center pb-4">
      <h1 class="h1">Vos réservations</h1>
    </div>
    <div class="container">
      <!--start of main accordion-->
      <div id="accordion">
        <?php foreach ($result as $date => $resaTable) { ?>
          <div class="card">
            <div class="card-header bg-primary" id="heading<?php echo $date ?>">
              <h5 class="mb-0 d-inline">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $date ?>" aria-expanded="true" aria-controls="collapse<?php echo $date ?>">
                  <?php echo date ("d-m-Y", strtotime($date)); ?>
                </button>
              </h5>
            </div>
            <div id="collapse<?php echo $date ?>" class="collapse show" aria-labelledby="heading<?php echo $date ?>" data-parent="#accordion">
              <!--start of second accordion-->
              <div class="card-body" id="child<?php echo $date ?>">
                <?php foreach ($resaTable as $reservation) {
                    include(constant('ROOT_DIR') . "/Public/include/reservation_inc.php");
                  } ?>
                <!--end of second accordion-->
              </div>
            </div>
          </div>
        <?php } ?>
        <!--end of  main accordion-->
      </div>
      <br>
    </div>
  </div>
  <?php require_once(constant('ROOT_DIR') . "/Public/include/footer_inc.php") ?>

  <?php require_once(constant('ROOT_DIR') . "/Public/include/scripts_inc.php") ?>
</body>

</html>