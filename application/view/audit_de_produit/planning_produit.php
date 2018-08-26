<div class="row sticky-left upp" style="position: fixed;top: 8.7%;left: 43%;">
	<div class="form-group col-xl-auto d-inline" style="margin-left: 33%;">
		<!-- <a href="<?php echo URL; ?>administration/ajouter_reference" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Ajouter une référence</button></a> -->
	</div>
	<div class="form-group col-xl-auto d-inline">
		<a href="<?php echo URL; ?>audit_de_produit/planifier_audit_produit" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Mettre &agrave jour le Planning</button></a>
	</div>
</div>
<div class="container upp" style="position: fixed;top: 8.7%;left: 70%;width: 40%;">
    <div class="row">
        <div class="col-md-3 block">
            <div class="circle" style="color: black;background: #ffc107;">
                <p>P</p>
            </div>
            <span>Audit planifier</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: #306598;">
                <p>E</p>
            </div>
            <span>Audit encours</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: #dc3545;">
                <p>RP</p>
            </div>
            <span>Audit replanifier</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: #28a745;">
                <p>S</p>
            </div>
            <span>Audit sold&eacute</span>
        </div>
    </div>
</div>
<table class="table table-bordered table-hover text-center" style="zoom:65%;margin-top: 8.7%;overflow-x: hidden;">
	<thead>
		<th style="background-color: #6c757d;color: white;">Num&eacutero maquette</th>
		<th style="background-color: #6c757d;color: white;">R&eacutef&eacuterence</th>
		<th style="background-color: #6c757d;color: white;">D&eacutesignation</th>
		<th style="background-color: #6c757d;color: white;">Criticit&eacute</th>
	<?php foreach ($allMonth as $p) { 
		$x = explode('-', $p);
		$monthName = strftime("%B", strtotime($p));
		$monthName = substr($monthName, 0, 4);
		//color , '#e3700d', '#FF3838', '#1e8fef', '#00ce06',
		$background_colors = array('#6c757d');

	    $count = count($background_colors) - 1;

	    $i = rand(0, $count);

	    $rand_background = $background_colors[$i];?>

		<th style="background-color: <?php echo $rand_background; ?>;color: white;"><?php echo $monthName.'-'.$x[0]; ?></th>
		
	<?php } ?>
	</thead>
	<tbody>
		<?php
		$i = 0; 
		foreach ($Produits as $produit) { ?>
		<tr>
			<td><?php echo $produit->num_maq; ?></td>
			<td><?php echo $produit->nom_reference ?></td>
			<td ><?php echo $produit->designation; ?></td>
			<td><?php echo $produit->criticite_produit; ?></td>
			<?php foreach ($allMonth as $month) { ?>
			<?php if (in_array($produit->nom_reference."/".$month."/"."", $planning)) {?>
			<td class="bg-warning text-dark font-weight-bold">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.2%;" id="work <?php echo $i; ?>" class="text-center">P</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_produit/affecter_auditeur/' . htmlspecialchars($produit->nom_reference, ENT_QUOTES, 'UTF-8').'/'.htmlspecialchars($month, ENT_QUOTES, 'UTF-8');?>">
						
							<div class="form-group col-sm-6" style="margin-left: 22%;">
								<label>Nom d'auditeur</label>	
								<select name="nomAuditeur" class="form-control text-center" required>
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
			<?php }elseif (in_array($produit->nom_reference."/".$month."/"."encours", $planning)) {
				foreach ($this->produitmodel->getPlanningAuditeur($produit->nom_reference, $month) as $audit) {
				 	$Auditeur = $audit;
				 } ?>
			<td class="bg-primary text-white font-weight-bold" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.2%;" id="work <?php echo $i; ?>" class="text-center">E</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_produit/ajouter_action'?>">

							<div class="form-group col-sm-6" style="margin-left: 24%;">
								<label>Nom d'auditeur</label>
								<input type="text" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								<input type="hidden" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomProduit" value="<?php echo $produit->nom_reference; ?>">
								<input type="hidden" name="designationn" value="<?php echo $produit->designation; ?>">
							</div>

							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Ajouter une action</button>
								<button type="button" class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>						
						</form>
					</div>
				</div>
			</td>
			<?php }elseif (in_array($produit->nom_reference."/".$month."/"."Soldé", $planning)) {
				foreach ($this->produitmodel->getPlanningAuditeur($produit->nom_reference, $month) as $audit) {
				 	$Auditeur = $audit;
				 } ?>
			<td class="bg-success text-white font-weight-bold" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.2%;" id="work <?php echo $i; ?>" class="text-center">S</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_produit/action_liee'?>">

							<div class="form-group col-sm-6" style="margin-left: 24%;">
								<label>Nom d'auditeur</label>
								<input type="text" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								<input type="hidden" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomProduit" value="<?php echo $produit->nom_reference; ?>">
							</div>

							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Voir l'action li&eacute;e</button>
								<button type="button" class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>						
						</form>
					</div>
				</div>
			</td>
		<?php }elseif (in_array($produit->nom_reference."/".$month."/"."Replanifier", $planning)) {
				foreach ($this->produitmodel->getPlanningAuditeur($produit->nom_reference, $month) as $audit) {
				 	$Auditeur = $audit;
				 } ?>
			<td class="bg-danger text-white font-weight-bold" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 4.2%;" id="work <?php echo $i; ?>" class="text-center">RP</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_produit/action_liee'?>">

							<div class="form-group col-sm-6" style="margin-left: 24%;">
								<label>Nom d'auditeur</label>
								<input type="text" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								<input type="hidden" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomProduit" value="<?php echo $produit->nom_reference; ?>">
							</div>

							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Voir l'action li&eacute;e</button>
								<button type="button" class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>						
						</form>
					</div>
				</div>
			</td>
			<?php }else echo '<td></td>';$i++; } ?>
			<?php } ?>
		</tr>
	</tbody>
</table>
<div class="vimeo_player" videoID="5yIXl9PNYtw"></div>
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