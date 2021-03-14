<div class="card  shadow border-info">
  <div class="card-body">
    <div class="card-text">
      <div class="row">

        <div class="col my-auto">
          <h5>Nom: <?php echo $user->getnom(); ?></h5>
          <h5>Prénom: <?php echo $user->getprenom(); ?></h5>

        </div>
        <div class="col my-auto">

          <h5> <?php if ($user->isAdmin()) {
                  echo "administrateur";
                } else {
                  echo "utilisateur";
                } ?>
            <div class="administrateur"><span class="td"></span></div>
            <?php
            $admin = 1;
            if ($user->isAdmin()) {
              $admin = 0;
            }
            ?></h5>


        </div>
        <?php if($isAdmin == 1){ ?>
        <div class="col my-auto">
          <h5><a class="btn btn-primary shadow" href="Process/process-updateUserStatus.php?id=<?php echo $user->getId(); ?>
            &status=<?php echo $admin; ?>">Changer statut</a>

            </a></h5>
        </div>


        <div class="col my-auto">
          <button type="button" class="btn btn-danger shadow" data-toggle="modal" data-target="#exampleModal<?php echo $user->getId(); ?>">
            Supprimer
          </button>
          <div class="modal fade" id="exampleModal<?php echo $user->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel<?php echo $user->getId(); ?>">Supprimer</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Etes-vous sûr de vouloir supprimer?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                  <a href="Process/process-deleteUser.php?id=<?php echo $user->getId(); ?>" id="delete" class="btn btn-primary">Oui</a>
                </div>
              </div>
            </div>
          </div>
        </div>
          <?php } ?>
      </div>
    </div>
  </div>
</div>