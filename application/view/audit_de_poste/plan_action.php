<div class="row sticky-left" style="margin-top: 5.7%;margin-left: 22%;">
	<!-- <div class="form-group col-xl-auto d-inline" style="margin-left: 33%;">
		<a href="<?php echo URL; ?>administration/ajouter_reference" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Ajouter une référence</button></a>
	</div>
	<div class="form-group col-xl-auto d-inline">
		<a href="<?php echo URL; ?>administration/update_criticite_references" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Mettre à jour les criticités</button></a>
	</div> -->
	<div class="col-sm-3 fixed-left" style="margin-left: 66%;">
		<form class="d-flex" method="POST" action="<?php echo URL; ?>audit_de_poste/recherche_action">
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
		<b>Plan d'action d'audit de poste</b>
	</div>
	<div class="card-body" style="width: 100%;zoom:90%">
		<table class="table table-hover table-bordered">
			<thead class="">
				<th>Date d'action</th>
				<th>Auditeur</th>
				<th>Secteur audit</th>
				<th>Poste</th>
				<th>Reference</th>
				<th>Type d'écart</th>
				<th>Écart constaté</th>
				<th>Analyse (5 pourquoi)</th>
				<th>Action corrective</th>
				<th>Responsable</th>
				<th>Processus</th>
				<th>Date de réalisation</th>
				<th>Status</th>
				<th>Paramètre</th>
			</thead>
			<tbody>
				<?php foreach ($actions as $action) {
				 ?>
				<tr>
					<td><?php echo $action->date_prevue; ?></td>
					<td><?php echo $action->auditeur; ?></td>
					<td><?php echo $action->secteur_audite; ?></td>
					<td><?php echo $action->poste; ?></td>
					<td><?php echo $action->reference; ?></td>
					<td><?php echo $action->type_ecart; ?></td>
					<td><?php echo $action->ecart_constate; ?></td>
					<td><?php echo $action->analyse; ?></td>
					<td><?php echo $action->action_corrective; ?></td>
					<td><?php echo $action->nom_resp; ?></td>
					<td><?php echo $action->processus; ?></td>
					<td><?php if ($action->date_realisation == '0000-00-00') {
						echo "";
					}else echo $action->date_realisation; ?></td>
					<?php if ($action->status == "Soldé") {?>
						<td class="bg-success text-white font-weight-bold"><?php echo $action->status; ?></td>
					<?php }elseif ($action->status == "encours") {?>
						<td class="bg-primary text-white font-weight-bold"><?php echo $action->status; ?></td>
					<?php }elseif ($action->status == "Retard") {?>
						<td class="bg-danger text-white font-weight-bold"><?php echo $action->status; ?></td>
					<?php } ?>
					<td><a href="<?php echo URL . 'audit_de_poste/modifier_action_poste/' . htmlspecialchars($action->id_action, ENT_QUOTES, 'UTF-8');?>"><img src="<?php echo URL; ?>img/2.svg" width="45%"></a><a href="<?php echo URL . 'audit_de_poste/supprimer_action/' . htmlspecialchars($action->id_action, ENT_QUOTES, 'UTF-8');?>" onclick="return confirm('êtes-vous sûr?')"><img src="<?php echo URL; ?>img/1.svg" width="25%"></a></td>
				</tr>
				<?php } ?>
				<tr></tr>
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
		      <a class="page-link" href="<?php echo URL . 'audit_de_poste/Plan_action/' . htmlspecialchars($page-1, ENT_QUOTES, 'UTF-8');?>" tabindex="-1">Previous</a>
		    </li>
		    <?php } ?>
		    <?php for ($i=1; $i <= $total_pages; $i++) { 
		    	if ($i == $page) { ?>
		    <li class="page-item active">
		      <a class="page-link" href="#"><?php echo $i; ?><span class="sr-only">(current)</span></a>
		    </li>
		    <?php }else{?>
		    <li class="page-item"><a class="page-link" href="<?php echo URL . 'audit_de_poste/Plan_action/' . htmlspecialchars($i, ENT_QUOTES, 'UTF-8');?>"><?php echo $i; ?></a></li>
		    <?php }} 
		    if ($page == $total_pages) {?>
		    <li class="page-item disabled">
		      <a class="page-link" href="#">Next</a>
		    </li>
		    <?php }else{ ?>
		    <li class="page-item">
		      <a class="page-link" href="<?php echo URL . 'audit_de_poste/Plan_action/' . htmlspecialchars($page+1, ENT_QUOTES, 'UTF-8');?>">Next</a>
		    </li>
		    <?php } ?>
		  </ul>
		</nav>

		<?php }echo $commentaire; ?>
	</div>
</div>