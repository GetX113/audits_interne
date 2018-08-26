<div class="row sticky-left upp" style="position: fixed;top: 8.7%;left: 43%;">
	<div class="form-group col-xl-auto d-inline" style="margin-left: 33%;">
		<!-- <a href="<?php echo URL; ?>administration/ajouter_reference" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Ajouter une référence</button></a> -->
	</div>
	<div class="form-group col-xl-auto d-inline">
		<a href="<?php echo URL; ?>audit_de_processus/planifier_audit_processus" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Mettre &agrave jour le Planning</button></a>
	</div>
</div>
<div class="container upp" style="position: fixed;top: 8.7%;left: 62%;width: 40%;">
    <div class="row">
        <div class="col-md-3 block">
            <div class="circle" style="color: black;background: #ffc107;">
                <p style="font-size: 63%;">P</p>
            </div>
            <span>Audit planifier</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: #306598;">
                <p style="font-size: 63%;">E</p>
            </div>
            <span>Audit encours</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: #FF8800;">
                <p style="font-size: 63%;">A.NQ</p>
            </div>
            <span>Non Qualifi&eacute</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: #dc3545;">
                <p style="font-size: 63%;">A.NR</p>
            </div>
            <span>Audit non r&eacutealis&eacute</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: #28a745;">
                <p style="font-size: 63%;">A.Q</p>
            </div>
            <span>Audit Qualifi&eacute</span>
        </div>
    </div>
</div>
<table class="table table-bordered table-hover text-center" style="zoom:65%;margin-top: 8.7%;">
	<thead>
		<th></th>
	<?php foreach ($allMonth as $p) { 
		$x = explode('-', $p);?>

		<th><?php echo strftime("%B", strtotime($p)).'-'.$x[0]; ?> <span style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;color: white;" unselectable="on" onselectstart="return false;" onmousedown="return false;">**************</span></th>
		
	<?php } ?>
	</thead>
	<tbody>
		<tr>
			<td class="font-weight-bold">Famille de processus</td>
			<?php $i = 0; 
			foreach ($allMonth as $month) {$j=0;
			foreach ($plannings as $plan) {	$j++;
			if ($month == $plan->date_plan) {
			if (empty($plan->processus)) { ?>
			<td class="bg-warning text-dark font-weight-bold">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.3%;" id="work <?php echo $i; ?>" class="text-center">P</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<label>Nom de Produit</label>
						<input type="text" id="" class="form-control text-center" disabled value="<?php echo $plan->produit; ?>" class="text-center">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_processus/affecter_processus/'. htmlspecialchars($plan->id, ENT_QUOTES, 'UTF-8'); ?>">
						
							<div class="form-group col-sm-6" style="margin-left: 25%;">
								<label>Nom de Processus</label>	
								<select name="processus" class="form-control text-center" required>
									<option></option>
									<?php
									foreach ($processusss as $procc) {
									 	echo '<option>'.$procc["nom"].'</option>';
									 } 
									 ?>
								</select>
							</div>
							
							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Affecter le processus</button>
								<button class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
							</div>
						
						</form>
					</div>
				</div>
			</td>
			<?php $i++; }else{  ?>
			<td></td>
			<?php }break;}if ($j == count($plannings)) { ?>
				<td></td>
			<?php }}} ?>
		</tr>
		<?php foreach ($processusss as $procc) { ?>
		<tr>
			<td><?php echo $procc["nom"]; ?></td>
			<?php foreach ($allMonth as $month) {?>
			<?php if (in_array($procc["nom"]."/".$month."/"."", $planning)) {
				foreach ($this->processusmodel->getPlanningAuditeur($procc["nom"], $month) as $audit) {
				 	$produit = $audit["produit"];
				 } ?>

			<td class="bg-warning text-dark font-weight-bold">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.3%;" id="work <?php echo $i; ?>" class="text-center">P</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<label>Nom de Produit</label>
						<input type="text" id="" class="form-control text-center" disabled value="<?php echo $produit; ?>" class="text-center">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_processus/affecter_auditeur/'.htmlspecialchars($month, ENT_QUOTES, 'UTF-8');?>">
							<input type="hidden" name="process" value="<?php echo $procc["nom"]; ?>">
							<div class="form-group col-sm-6" style="margin-left: 22%;">
								<label>Nom d'auditeur</label>	
								<select name="Auditeurr" class="form-control text-center" required>
									<option></option>
									<?php
									foreach ($auditeurs as $auditeur) {
									 	echo '<option>'.$auditeur.'</option>';
									 } 
									 ?>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Affecter l'auditeur</button>
								<button class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
							</div>
						
						</form>
					</div>
				</div>
			</td>
			<?php $i++;}elseif (in_array($procc["nom"]."/".$month."/"."encours", $planning)) {
				foreach ($this->processusmodel->getPlanningAuditeur($procc["nom"], $month) as $audit) {
					$id = $audit["id"];
				 	$Auditeur = $audit["auditeur"];
				 	$produit = $audit["produit"];
				 	$proc = $audit["processus"];
				 	$cotation = $audit["cotation"];
				 	$mois = $audit["date_plan"];
				 	$ic = $audit["ic"];
				 } ?>
			<td class="bg-primary text-white font-weight-bold" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.3%;" id="work <?php echo $i; ?>" class="text-center">E</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<div class="form-group row" style="margin-top: 2%;">
							<label style="margin-left: 18%;">Nom de Produit :</label>
							<div class="col-sm-6">
								<input type="text" class="form-control text-center" value="<?php echo $produit; ?>" disabled>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -3%;">
							<label style="margin-left: 18%;">Indice de confiance :</label>
							<div class="col-sm-5">
								<input type="text" class="form-control text-center" value="<?php echo $ic.'%'; ?>" disabled>
							</div>
						</div>

						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_processus/Ajouter_action'?>">

							<div class="form-group row " style="margin-left: 17%;margin-top: -3%;">
								<label>Nom d'auditeur :</label>
								 <div class="col-sm-6">
									<input type="text" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								</div>
								<input type="hidden" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomProduit" value="<?php echo $produit; ?>">
								<input type="hidden" name="nomProcessus" value="<?php echo $proc; ?>">
								<input type="hidden" name="cotation" value="<?php echo $cotation; ?>">
								<input type="hidden" name="moisAudit" value="<?php echo $mois; ?>">
							</div>

							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Ajouter une action</button>
								<button type="button" class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>	
							<div class="form-group">
								<a href="<?php echo URL . 'audit_de_processus/ajouter_information_audit/' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');?>" class="btn btn-outline-primary col-sm-8">Changer les informations d'audit</a>
							</div>						
						</form>
					</div>
				</div>
			</td>
			<?php $i++;}elseif (in_array($procc["nom"]."/".$month."/"."qualifie", $planning)) {
				foreach ($this->processusmodel->getPlanningAuditeur($procc["nom"], $month) as $audit) {
					$id = $audit["id"];
				 	$Auditeur = $audit["auditeur"];
				 	$produit = $audit["produit"];
				 	$proc = $audit["processus"];
				 	$cotation = $audit["cotation"];
				 	$mois = $audit["date_plan"];
				 	$ic = $audit["ic"];
				 } ?>
			<td class="bg-success text-white font-weight-bold" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.3%;" id="work <?php echo $i; ?>" class="text-center">A.Q</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<div class="form-group row" style="margin-top: 2%;">
							<label style="margin-left: 18%;">Nom de Produit :</label>
							<div class="col-sm-6">
								<input type="text" class="form-control text-center" value="<?php echo $produit; ?>" disabled>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -3%;">
							<label style="margin-left: 18%;">Indice de confiance :</label>
							<div class="col-sm-5">
								<input type="text" class="form-control text-center" value="<?php echo $ic.'%'; ?>" disabled>
							</div>
						</div>

						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_processus/Ajouter_action'?>">

							<div class="form-group row " style="margin-left: 17%;margin-top: -3%;">
								<label>Nom d'auditeur :</label>
								 <div class="col-sm-6">
									<input type="text" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								</div>
								<input type="hidden" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomProduit" value="<?php echo $produit; ?>">
								<input type="hidden" name="nomProcessus" value="<?php echo $proc; ?>">
								<input type="hidden" name="cotation" value="<?php echo $cotation; ?>">
								<input type="hidden" name="moisAudit" value="<?php echo $mois; ?>">
							</div>

							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Ajouter une action</button>
								<button type="button" class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>
							<div class="form-group" style="margin-top: -1%;">
								<a href="<?php echo URL . 'audit_de_processus/select_action/' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');?>" class="btn btn-outline-primary col-sm-8">Voir les actions li&eacutee</a>
							</div>		
							<div class="form-group" style="margin-top: -3%;">
								<a href="<?php echo URL . 'audit_de_processus/ajouter_information_audit/' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');?>" class="btn btn-outline-primary col-sm-8">Changer les informations d'audit</a>
							</div>						
						</form>
					</div>
				</div>
			</td>
			<?php $i++;}elseif (in_array($procc["nom"]."/".$month."/"."non qualifie", $planning)) {
				foreach ($this->processusmodel->getPlanningAuditeur($procc["nom"], $month) as $audit) {
					$id = $audit["id"];
				 	$Auditeur = $audit["auditeur"];
				 	$produit = $audit["produit"];
				 	$proc = $audit["processus"];
				 	$cotation = $audit["cotation"];
				 	$mois = $audit["date_plan"];
				 	$ic = $audit["ic"];
				 	$suivi = $audit["date_suivi"];
				 } ?>
			<td class="text-white font-weight-bold" data-toggle="tooltip" style="background-color: #FF8800;" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.3%;" id="work <?php echo $i; ?>" class="text-center">A.NQ <img src="<?php echo URL; ?>img/2arrow.png" width="30%" style="z-index:  100;margin-left: 106%;margin-top: -27%;"></div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<div class="form-group row" style="margin-top: 2%;">
							<label style="margin-left: 18%;">Nom de Produit :</label>
							<div class="col-sm-6">
								<input type="text" class="form-control text-center" value="<?php echo $produit; ?>" disabled>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -3%;">
							<label style="margin-left: 18%;">Indice de confiance :</label>
							<div class="col-sm-5">
								<input type="text" class="form-control text-center" value="<?php echo $ic.'%'; ?>" disabled>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -3%;">
							<label style="margin-left: 18%;">Date de suivi :</label>
							<div class="col-sm-5">
								<input type="text" class="form-control text-center" value="<?php echo $suivi; ?>" disabled>
							</div>
						</div>

						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_processus/Ajouter_action'?>">

							<div class="form-group row " style="margin-left: 17%;margin-top: -3%;">
								<label>Nom d'auditeur :</label>
								 <div class="col-sm-6">
									<input type="text" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								</div>
								<input type="hidden" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomProduit" value="<?php echo $produit; ?>">
								<input type="hidden" name="nomProcessus" value="<?php echo $proc; ?>">
								<input type="hidden" name="cotation" value="<?php echo $cotation; ?>">
								<input type="hidden" name="moisAudit" value="<?php echo $mois; ?>">
							</div>

							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Ajouter une action</button>
								<button type="button" class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>	
							<div class="form-group" style="margin-top: -1%;">
								<a href="<?php echo URL . 'audit_de_processus/select_action/' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');?>" class="btn btn-outline-primary col-sm-8">Voir les actions li&eacutee</a>
							</div>	
							<div class="form-group" style="margin-top: -3%;">
								<a href="<?php echo URL . 'audit_de_processus/ajouter_information_audit/' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');?>" class="btn btn-outline-primary col-sm-8">Changer les informations d'audit</a>
							</div>					
						</form>
					</div>
				</div>
			</td>
			<?php $i++;}elseif (in_array($procc["nom"]."/".$month."/"."non realiser", $planning)) {
				foreach ($this->processusmodel->getPlanningAuditeur($procc["nom"], $month) as $audit) {
					$id = $audit["id"];
				 	$Auditeur = $audit["auditeur"];
				 	$produit = $audit["produit"];
				 	$proc = $audit["processus"];
				 	$cotation = $audit["cotation"];
				 	$mois = $audit["date_plan"];
				 	$suivi = $audit["date_suivi"];
				 	$replanification = $audit["date_replanification"];
				 } ?>
			<td class="bg-danger text-white font-weight-bold" data-toggle="tooltip" style="background-color: #FF8800;" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.3%;" id="work <?php echo $i; ?>" class="text-center">A.NR <img src="<?php echo URL; ?>img/arrow.png" width="17%"></div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<div class="form-group row" style="margin-top: 2%;">
							<label style="margin-left: 18%;">Nom de Produit :</label>
							<div class="col-sm-6">
								<input type="text" class="form-control text-center" value="<?php echo $produit; ?>" disabled>
							</div>
						</div>
						<div class="form-group row" style="margin-top: -3%;">
							<label style="margin-left: 18%;">Date de replanification :</label>
							<div class="col-sm-5">
								<input type="text" class="form-control text-center" value="<?php echo $replanification; ?>" disabled>
							</div>
						</div>

						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_processus/Ajouter_action'?>">

							<div class="form-group row " style="margin-left: 17%;margin-top: -3%;">
								<label>Nom d'auditeur :</label>
								 <div class="col-sm-6">
									<input type="text" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								</div>
								<input type="hidden" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomProduit" value="<?php echo $produit; ?>">
								<input type="hidden" name="nomProcessus" value="<?php echo $proc; ?>">
								<input type="hidden" name="cotation" value="<?php echo $cotation; ?>">
								<input type="hidden" name="moisAudit" value="<?php echo $mois; ?>">
								<input type="hidden" name="dateSuivi" value="<?php echo $suivi; ?>">
							</div>

							<div class="form-group">
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>	
								
							<div class="form-group" style="margin-top: 0%;">
								<a href="<?php echo URL . 'audit_de_processus/ajouter_information_audit/' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');?>" class="btn btn-outline-primary col-sm-8">Changer les informations d'audit</a>
								<button type="button" class="btn btn-outline-primary col-sm-8" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
							</div>					
						</form>
					</div>
				</div>
			</td>
			<?php $i++;}else{ ?>
			<td></td>
			<?php }} ?>
		</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	// window.onload = function () {
        function change(id){
        	// alert(id);
        var num = id.split(" ");
		var work = document.getElementById("work "+num[1]);
	    var working = document.getElementById("working "+num[1]);
	  
	    if (working.style.visibility == 'hidden')
	    {
	        working.style.visibility = 'visible';
	        work.style.visibility = 'hidden';
	    }
	    else                                     
	    {
	        working.style.visibility = 'hidden';
	        work.style.visibility = 'visible';
	    }
		// }
	}
</script>