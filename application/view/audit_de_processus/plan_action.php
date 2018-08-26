<div class="row sticky-left" style="margin-top: 5.7%;margin-left: 22%;">
	<div class="col-sm-3 fixed-left" style="margin-left: 73%;">
		<form class="d-flex" method="POST" action="<?php echo URL; ?>audit_de_produit/recherche_action">
              <input class="form-control py-2" type="search" placeholder="Recherche ..." id="example-search-input" name="recherche">
              <span class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">
                <i class="fa fa-search"></i>
              </button>
              </span>
        </form>
    </div>
</div>
<div class="card text-center" style="width: 60%; margin: 0px 2% auto;display: inline-table;">
	<div class="card-header <?php echo $success; ?>">
		<b>Plan d'action d'audit de processus</b>
	</div>
	<div class="card-body" style="width: 100%;zoom:65%;">
		<table class="table table-hover table-bordered" style="width: 100%;">
			<thead class="">
				<th>Date d'audit</th>
				<th>Processus</th>
				<th>Auditeur</th>
				<th>Secteur</th>
				<th>type (6M)</th>
				<th>N° question</th>
				<th>Critére</th>
				<th>Référence</th>
				<th>Ecarte constaté</th>
				<th>Cotation</th>
				<th>Actions immédiates</th>
				<th>Délai</th>
				<th>ANALYSE (5 POURQUOI)</th>
				<th>Action corrective</th>
				<th>Pilote</th>
				<th>Processus</th>
				<th>Délai</th>
				<th>Date réalisation</th>
				<th>Réalisé</th>
				<th>Paramètre</th>
			</thead>
			<tbody>
				<?php foreach ($actions as $action) {
				 ?>
				<tr>
					<td><?php echo $action->date_audit; ?></td>
					<td><?php echo $action->processus; ?></td>
					<td><?php echo $action->auditeur; ?></td>
					<td><?php echo $action->secteur; ?></td>
					<td><?php echo $action->type6m; ?></td>
					<td><?php echo $action->question; ?></td>
					<td><?php echo $action->critere; ?></td>
					<td><?php echo $action->reference; ?></td>
					<td><?php echo $action->ecart_constate; ?></td>
					<td><?php echo $action->cotation; ?></td>
					<td><?php echo $action->action_immediate; ?></td>
					<td><?php echo $action->delai; ?></td>
					<td><?php echo $action->analyse; ?></td>
					<td><?php echo $action->action_corrective; ?></td>
					<td><?php echo $action->pilote; ?></td>
					<td><?php echo $action->process; ?></td>
					<td><?php echo $action->delai_action; ?></td>
					<td><?php echo $action->date_realisation; ?></td>
					<?php if ($action->etat == "retard") {?>
						<td class="bg-danger text-white font-weight-bold">Retard</td>
					<?php }elseif ($action->etat == "planifier") {?>
						<td class="bg-warning text-white font-weight-bold">P</td>
					<?php }elseif ($action->etat == "solde") {?>
						<td class="bg-success text-white font-weight-bold">Soldé</td>
					<?php } ?>
					
					<td><a href="<?php echo URL . 'audit_de_processus/modifier_action/' . htmlspecialchars($action->id_action, ENT_QUOTES, 'UTF-8');?>"><img src="<?php echo URL; ?>img/2.svg" width="45%"></a><a href="<?php echo URL . 'audit_de_processus/supprimer_action/' . htmlspecialchars($action->id_action, ENT_QUOTES, 'UTF-8');?>" onclick="return confirm('êtes-vous sûr?')"><img src="<?php echo URL; ?>img/1.svg" width="25%"></a></td>
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
		      <a class="page-link" href="<?php echo URL . 'audit_de_processus/Plan_action/' . htmlspecialchars($page-1, ENT_QUOTES, 'UTF-8');?>" tabindex="-1">Previous</a>
		    </li>
		    <?php } ?>
		    <?php for ($i=1; $i <= $total_pages; $i++) { 
		    	if ($i == $page) { ?>
		    <li class="page-item active">
		      <a class="page-link" href="#"><?php echo $i; ?><span class="sr-only">(current)</span></a>
		    </li>
		    <?php }else{?>
		    <li class="page-item"><a class="page-link" href="<?php echo URL . 'audit_de_processus/Plan_action/' . htmlspecialchars($i, ENT_QUOTES, 'UTF-8');?>"><?php echo $i; ?></a></li>
		    <?php }} 
		    if ($page == $total_pages) {?>
		    <li class="page-item disabled">
		      <a class="page-link" href="#">Next</a>
		    </li>
		    <?php }else{ ?>
		    <li class="page-item">
		      <a class="page-link" href="<?php echo URL . 'audit_de_processus/Plan_action/' . htmlspecialchars($page+1, ENT_QUOTES, 'UTF-8');?>">Next</a>
		    </li>
		    <?php } ?>
		  </ul>
		</nav>

		<?php }echo $commentaire; ?>
	</div>
</div>