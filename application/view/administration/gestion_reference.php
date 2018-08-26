<div class="row sticky-left" style="margin-top: 5.7%;margin-left: 22%;">
	<div class="form-group col-xl-auto d-inline" style="margin-left: 33%;">
		<a href="<?php echo URL; ?>administration/ajouter_reference" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Ajouter une référence</button></a>
	</div>
	<div class="form-group col-xl-auto d-inline">
		<a href="<?php echo URL; ?>administration/update_criticite_references" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Mettre &agrave jour les criticités</button></a>
	</div>
	<div class="col-sm-3 fixed-left">
		<form class="d-flex" method="POST" action="<?php echo URL; ?>administration/recherche_reference">
              <input class="form-control py-2" type="search" placeholder="Recherche ..." id="example-search-input" name="recherche">
              <span class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">
                <i class="fa fa-search"></i>
              </button>
              </span>
        </form>
    </div>
</div>
<div class="card text-center" style="width: 60%; margin: 0px 3% auto;display: inline-table;">
	<div class="card-header <?php echo $success; ?>">
		La liste des références
	</div>
	<div class="card-body" style="width: 100%;">
		<table class="table table-hover table-bordered">
			<thead class="">
				<th>Nom référence</th>
				<th>Poste</th>
				<th>Désignation</th>
				<th>Numéro maquette</th>
				<th>Durée Démarrage</th>
				<th>Nombre de non-conformité</th>
				<th>Sécurité Réglementation</th>
				<th>Modification processus/produit</th>
				<th>Top50</th>
				<th>PPM interne</th>
				<th>Criticité produit</th>
				<th>Criticité processus</th>
				<th>Paramètre</th>
			</thead>
			<tbody>
				<?php foreach ($references as $reference) {
				 ?>
				<tr>
					<td><?php echo $reference->nom_reference; ?></td>
					<td><?php echo $reference->poste; ?></td>
					<td><?php echo $reference->designation; ?></td>
					<td><?php echo $reference->num_maq; ?></td>
					<td><?php if ($reference->duree_demarrage == "fin") {
						echo "Fin de vie";
					}elseif ($reference->duree_demarrage == "serie") {
						echo "Série";
					}else echo "Projet(Phase E.I - DMS - Ramp UP)"; ?></td>
					<td><?php echo $reference->nbr_nc; ?></td>
					<td><?php if ($reference->sr == 3) {
						echo '<img src="'.URL.'img/check.png" width="19%">';
					}else echo ""; ?></td>
					<td><?php if ($reference->modif_proc == 3) {
						echo '<img src="'.URL.'img/check.png" width="16%">';
					}else echo ""; ?></td>
					<td><?php if ($reference->top50 == 3) {
						echo '<img src="'.URL.'img/check.png" width="46%">';
					}else echo ""; ?></td>
					<td><?php if ($reference->ppm == 3) {
						echo '<img src="'.URL.'img/check.png" width="40%">';
					}else echo ""; ?></td>
					<td><?php echo $reference->criticite_produit; ?></td>
					<td><?php echo $reference->criticite_processus; ?></td>
					<td><a href="<?php echo URL . 'administration/modifier_reference/' . htmlspecialchars($reference->id_ref, ENT_QUOTES, 'UTF-8');?>"><img src="<?php echo URL; ?>img/2.svg" width="45%"></a><a href="<?php echo URL . 'administration/supprimer_reference/' . htmlspecialchars($reference->id_ref, ENT_QUOTES, 'UTF-8');?>" onclick="return confirm('êstes-vous sûr?')"><img src="<?php echo URL; ?>img/1.svg" width="25%"></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer <?php echo $success; ?>">
		<?php if (isset($id_page)){ ?>
		<nav aria-label="...">
		  <ul class="pagination">
		  	<?php if ($page == 1) {?>
		  	<li class="page-item disabled">
		      <a class="page-link" href="#" tabindex="-1">Previous</a>
		    </li>
		  	<?php }else{ ?>
		    <li class="page-item">
		      <a class="page-link" href="<?php echo URL . 'administration/gestion_references/' . htmlspecialchars($page-1, ENT_QUOTES, 'UTF-8');?>" tabindex="-1">Previous</a>
		    </li>
		    <?php } ?>
		    <?php for ($i=1; $i <= $total_pages; $i++) { 
		    	if ($i == $page) { ?>
		    <li class="page-item active">
		      <a class="page-link" href="#"><?php echo $i; ?><span class="sr-only">(current)</span></a>
		    </li>
		    <?php }else{?>
		    <li class="page-item"><a class="page-link" href="<?php echo URL . 'administration/gestion_references/' . htmlspecialchars($i, ENT_QUOTES, 'UTF-8');?>"><?php echo $i; ?></a></li>
		    <?php }} 
		    if ($page == $total_pages) {?>
		    <li class="page-item disabled">
		      <a class="page-link" href="#">Next</a>
		    </li>
		    <?php }else{ ?>
		    <li class="page-item">
		      <a class="page-link" href="<?php echo URL . 'administration/gestion_references/' . htmlspecialchars($page+1, ENT_QUOTES, 'UTF-8');?>">Next</a>
		    </li>
		    <?php } ?>
		  </ul>
		</nav>

		<?php echo $commentaire; }?>
			
	</div>
</div>