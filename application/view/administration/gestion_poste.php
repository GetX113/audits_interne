<div class="row" style="margin-top: 5%;margin-left: 7%;">
	<div class="form-group col-sm-5 d-inline" style="margin-left: 33%;">
		<a href="<?php echo URL; ?>administration/ajouter_poste" style=""><button type="button" class="btn btn-outline-secondary col-sm-4">Ajouter un poste</button></a>
	</div>
	<div class="form-group col-xl-auto d-inline">
		<a href="<?php echo URL; ?>administration/update_criticite_postes" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Mettre &agrave jour criticité poste</button></a>
	</div>
	<div class="col-sm-3">
		<form class="d-flex" method="POST" action="<?php echo URL; ?>administration/recherche_poste">
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
		La liste des postes
	</div>
	<div class="card-body" style="width: 100%;">
		<table class="table table-hover table-bordered">
			<thead class="">
				<th>Nom de poste</th>
				<th>Secteur</th>
				<th>Première date d'audit</th>
				<th>Criticité</th>
				<th>Paramètres</th>
			</thead>
			<tbody>
				<?php foreach ($postes as $poste) {
				 ?>
				<tr>
					<td><?php echo $poste->nom_poste; ?></td>
					<td><?php echo $poste->secteur; ?></td>
					<td><?php echo $poste->premiere_date; ?></td>
					<td><?php echo $poste->criticite_poste; ?></td>
					<td><a href="<?php echo URL . 'administration/modifier_poste/' . htmlspecialchars($poste->id_poste, ENT_QUOTES, 'UTF-8');?>"><img src="<?php echo URL; ?>img/2.svg" width="13%"></a><a href="<?php echo URL . 'administration/supprimer_poste/' . htmlspecialchars($poste->id_poste, ENT_QUOTES, 'UTF-8');?>" onclick="return confirm('êtes-vous sûr?')"><img src="<?php echo URL; ?>img/1.svg" width="7%"></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer <?php echo $success; ?>"><?php echo $commentaire; ?></div>
</div>