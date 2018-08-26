<div class="row" style="margin-top: 5%;margin-left: 7%;">
	<div class="form-group col-sm-5 d-inline" style="margin-left: 33%;">
		<a href="<?php echo URL; ?>administration/ajouter_compte" style=""><button type="button" class="btn btn-outline-secondary col-sm-4">Ajouter un compte</button></a>
	</div>
	<div class="col-sm-3">
		<form class="d-flex" method="POST" action="<?php echo URL; ?>administration/recherche_compte">
              <input class="form-control py-2" type="search" placeholder="Recherche ..." id="example-search-input" name="recherche">
              <span class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">
                <i class="fa fa-search"></i>
              </button>
              </span>
        </form>
    </div>
</div>
<div class="card text-center" style="width: 60%; margin: 0 auto;">
	<div class="card-header <?php echo $success; ?>">
		La liste des comptes d'utilisateurs
	</div>
	<div class="card-body" style="width: 100%;">
		<table class="table table-hover table-bordered">
			<thead class="">
				<th>Nom</th>
				<th>Prénom</th>
				<th>Username</th>
				<th>Fonction</th>
				<th>Paramètres</th>
			</thead>
			<tbody>
				<?php foreach ($comptes as $compte) {
				 ?>
				<tr>
					<td><?php echo $compte->nom; ?></td>
					<td><?php echo $compte->prenom; ?></td>
					<td><?php echo $compte->username; ?></td>
					<td><?php echo $compte->fonctionnalite; ?></td>
					<td><a href="<?php echo URL . 'administration/supprimer_poste/' . htmlspecialchars($compte->id, ENT_QUOTES, 'UTF-8');?>" onclick="return confirm('êtes-vous sûr?')"><img src="<?php echo URL; ?>img/1.svg" width="17%"></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer <?php echo $success; ?>"><?php echo $commentaire; ?></div>
</div>