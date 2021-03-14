<nav class="navbar navbar-expand-sm navbar-light bg-primary shadow-lg">
  <a class="navbar-brand" href="#"><img src="img/logo-realise.png" id="logo" class="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse"  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <!--Côté gauche du Navbar-->
    <ul class="navbar-nav mr-auto">

      <!-- Lien Réservations -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Réservations
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="reservations.php">Vos réservations</a>
          <a class="dropdown-item" href="reservationsJour.php">Réservations du jour</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item bg-success text-white" href="nouvelleReservation.php">Nouvelle réservation</a>
        </div>
      </li>

      <?php if($isAdmin == 1){ ?>
      <!-- Lien Salles -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Salles
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="admin.listeSalle.php">Les salles</a>
          <a class="dropdown-item" href="admin.newSalle.php">Créer salle</a>
        </div>
      </li>

      <!-- Lien Utilisateurs -->
      <li class="nav-item">
        <a class="nav-link" href="admin.user.php">Utilisateurs</a>
      </li>
      <?php } ?>
    </ul> 
      
      <!-- Lien Deconnexion -->
    <ul class="navbar-nav ml-auto navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="Process/logout.php">Déconnexion</a>      
      </li>
    </ul>      
</nav>