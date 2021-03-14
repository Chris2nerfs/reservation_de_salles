<div class="card shadow border-info">
	<div class="card-body">
		<div class="card-text">
			<div class="row">
				<div class="col">
					<p>Bâtiment : <?php echo $reservation->getBatiment(); ?> </p>
					<p>Étage : <?php echo $reservation->getEtage(); ?></p>
					<p>Capacité : <?php echo $reservation->getNombrePlaces(); ?></p>
				</div>
				<div class="col">
					<p>Numéro : <?php echo $reservation->getNumero(); ?> </p>
					<p>Secteur : <?php echo $reservation->getSecteur(); ?> </p>
					<p>Projecteur : <?php echo $reservation->hasProjecteur(); ?> </p>
				</div>
				<div class="col">
					<p>Heure de début : <?php echo date('H:i', strtotime($reservation->getHeuredepart())); ?>
					<p>Heure de fin : <?php echo date('H:i', strtotime($reservation->getHeurefin())); ?>
					<p>Tableau : <?php echo $reservation->hasTableau(); ?> </p>
					<p>Télévision : <?php echo $reservation->hasTele(); ?> </p>
				</div>

				<?php if ($idUser == $reservation->getUser_id()) { ?>

					<div class="col my-auto">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $reservation->getId(); ?>">
							Supprimer
						</button>
					</div>
				<?php } ?>

			</div>

		</div>
	</div>

	<div class="card-body">
		<div class="row">
			<div class="col">
				<p><?php echo $reservation->getMessage(); ?><br /></p>
			</div>
		</div>

	</div>
</div>


<!-- MODAL -->
<div class="modal fade" id="exampleModal<?php echo $reservation->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel<?php echo $reservation->getId(); ?>">Supprimer</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Etes-vous sûr de vouloir supprimer?
			</div>
			<div class="modal-footer d-flex justify-content-between">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
				<?php if ($reservation->getRecurrence_id() == null) { ?>
					<a href="Process/process-DeleteReservation.php?id=<?php echo $reservation->getId(); ?>" class="btn btn-primary">Supprimer</a>
				<?php } else { ?>
					<a href="Process/process-DeleteReservation.php?id=<?php echo $reservation->getId(); ?>" class="btn btn-primary">Supprimer cette occurrence</a>
					<a href="Process/process-deleteReservationsRecurrente.php?id=<?php echo $reservation->getId(); ?>" class="btn btn-primary">Supprimer toutes les occurrences</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>