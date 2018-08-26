
<div class="row sticky-left upp" style="position: fixed;top: 8.7%;left: 43%;">
	<div class="form-group col-xl-auto d-inline" style="margin-left: 33%;">
		<!-- <a href="<?php echo URL; ?>administration/ajouter_reference" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Ajouter une référence</button></a> -->
	</div>
	<div class="form-group col-xl-auto d-inline">
		<a href="<?php echo URL; ?>audit_de_poste/planifier_audit_poste" style=""><button type="button" class="btn btn-outline-secondary col-xl-auto">Mettre &agrave jour le Planning</button></a>
	</div>
</div>
<div class="container upp" style="position: fixed;top: 8.7%;left: 62%;width: 40%;">
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
                <p>RE</p>
            </div>
            <span>Audit en retard</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: lightgreen;">
                <p>R</p>
            </div>
            <span>Audit r&eacutealis&eacute</span>
        </div>
        <div class="col-md-3 block">
            <div class="circle" style="color: white;background: #28a745;">
                <p>S</p>
            </div>
            <span>Audit sold&eacute</span>
        </div>
    </div>
</div>
<table class="table table-bordered table-hover text-center" style="zoom:65%;margin-top: 8.7%;">
	<thead>
		<th colspan="2" class="border border-top-0">Semaines</th>
		<?php
		$test = new DateTime($allDate[0]); 
		$testWeek = $test->Format("W");
		foreach ($allDate as $day) {
			$days = new DateTime($day);
			if ($days->Format("W") != $testWeek) {
				$week = intval($days->Format("W"))-1;
				if ($week == 0) {
					$week = 52;
				}
				echo '<th colspan="7" style="text-align:center;">S'.$week.'</th>';
				$testWeek = $days->Format("W");
		 } }?>
	
	</thead>
	<tbody>
		<tr>
			<td>Famille de processus</td>
			<td>Criticit&eacute</td>
		<?php foreach ($allDate as $day) { 
			$days = explode('-', $day); 
			setlocale (LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
			$monthName = strftime("%B", strtotime($day));
			// $monthName = date('F', mktime(0, 0, 0, $days[1], 10)); 
			$monthName = substr($monthName, 0, 4);
			if (in_array($day, $works)) {?>
				<td style="writing-mode: vertical-rl;text-orientation: sideways;text-align: center;" class="border-right border-dark"><?php echo $monthName."-".$days[2]; ?></td>
			<?php }else{ ?>
				<td style="writing-mode: vertical-rl;text-orientation: sideways;text-align: center;" class="border-right border-dark bg-secondary"><?php echo $monthName."-".$days[2]; ?></td>

			<?php }} ?>
		</tr>
	<?php
		$i = 0;
		foreach ($postes as $poste) {?>
		<!-- $planning = $this->postemodel->getPlanningPoste($poste->nom_poste); -->
		<tr>	
			<td><?php echo $poste->nom_poste; ?></td>
			<td><?php echo $poste->criticite_poste; ?></td>
			<?php foreach ($allDate as $date) {?>
			<?php if (in_array($poste->nom_poste."/".$date."/"."", $plannings)) {?>
			<td class="bg-warning text-dark font-weight-bold">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 1.6%;" id="work <?php echo $i; ?>" class="text-center">P</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_poste/affecter_auditeur/' . htmlspecialchars($poste->nom_poste, ENT_QUOTES, 'UTF-8').'/'.htmlspecialchars($date, ENT_QUOTES, 'UTF-8');?>">
						
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
			<?php }elseif (in_array($poste->nom_poste."/".$date."/"."encours", $plannings)) {
				foreach ($this->postemodel->getPlanningAuditeur($poste->nom_poste, $date) as $audit) {
				 	$Auditeur = $audit;
				 } ?>
			<td class="bg-primary text-white font-weight-bold" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 1.6%;" id="work <?php echo $i; ?>" class="text-center">E</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_poste/ajouter_action'?>">

							<div class="form-group col-sm-6" style="margin-left: 24%;">
								<label>Nom d'auditeur</label>
								<input type="text" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								<input type="hidden" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomPoste" value="<?php echo $poste->nom_poste; ?>">
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
			<?php }elseif (in_array($poste->nom_poste."/".$date."/"."Retard", $plannings)) { 
				foreach ($this->postemodel->getPlanningAuditeur($poste->nom_poste, $date) as $audit) {
				 	$Auditeur = $audit;
				 }?>
			<td class="bg-danger text-white font-weight-bold" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 1.6%;" id="work <?php echo $i; ?>" class="text-center">RE</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_poste/ajouter_action'?>">

							<div class="form-group col-sm-6" style="margin-left: 24%;">
								<label>Nom d'auditeur</label>
								<input type="text" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								<input type="hidden" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomPoste" value="<?php echo $poste->nom_poste; ?>">
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
			<?php }elseif (in_array($poste->nom_poste."/".$date."/"."Soldé", $plannings)) { 
				foreach ($this->postemodel->getPlanningAuditeur($poste->nom_poste, $date) as $audit) {
				 	$Auditeur = $audit;
				 } ?>
			<td class="bg-success text-white font-weight-bold" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 1.6%;" id="work <?php echo $i; ?>" class="text-center">S</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<?php foreach ($this->postemodel->getIdAction($poste->nom_poste, $date) as $ids) { $id = $ids->id_action; }  ?>
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_poste/ajouter_action'?>">

							<div class="form-group col-sm-6" style="margin-left: 24%;">
								<label>Nom d'auditeur</label>
								<input type="text" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								<input type="hidden" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomPoste" value="<?php echo $poste->nom_poste; ?>">
							</div>

							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Ajouter une action</button>
								<button type="button" class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>
							<div class="form-group">
								<a href="<?php echo URL . 'audit_de_poste/select_action/' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');?>" class="btn btn-outline-primary col-sm-8">Voir les actions li&eacutee</a>
							</div>						
						</form>
					</div>
				</div>
			</td>
			<?php }elseif (in_array($poste->nom_poste."/".$date."/"."Réalisé", $plannings)) { 
				foreach ($this->postemodel->getPlanningAuditeur($poste->nom_poste, $date) as $audit) {
				 	$Auditeur = $audit;
				 } ?>
			<td class="text-white font-weight-bold text-dark" style="background-color: lightgreen;" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $Auditeur; ?>">
				<div onclick="change(this.id);" style="z-index: 0;position: absolute;width: 1.6%;" id="work <?php echo $i; ?>" class="text-center">R</div>
				<div id="working <?php echo $i; ?>" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;width: 31%;">
					<div class="bg-light border border-warning" style="width: 100%;">
						<?php foreach ($this->postemodel->getIdAction($poste->nom_poste, $date) as $ids) { $id_action = $ids->id_action; }  ?>
						<form class="needs-validation" method="POST" action="<?php echo URL . 'audit_de_poste/ajouter_action'?>">

							<div class="form-group col-sm-6" style="margin-left: 24%;">
								<label>Nom d'auditeur</label>
								<input type="text" name="nomAuditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>" disabled>
								<input type="hidden" name="nomAudit" class="form-control text-center" value="<?php echo $Auditeur; ?>">
								<input type="hidden" name="nomPoste" value="<?php echo $poste->nom_poste; ?>">
							</div>

							<div class="form-group">
								<button type="submit" style="" class="btn btn-outline-primary col-sm-4">Ajouter une action</button>
								<button type="button" class="btn btn-outline-primary col-sm-4" onclick="change(this.id);" id="working <?php echo $i; ?>">Fermer</button>
								<input type="hidden" name="datePlanifier" value="<?php echo $date; ?>">
							</div>
							<div class="form-group">
								<a href="<?php echo URL . 'audit_de_poste/select_action/' . htmlspecialchars($id_action, ENT_QUOTES, 'UTF-8');?>" class="btn btn-outline-primary col-sm-8">Voir les actions li&eacutee</a>
							</div>						
						</form>
					</div>
				</div>
			</td>
			<?php }elseif (in_array($date, $works)) {?>
			<td>
				<!-- <div class="click1" onclick="change(this)"></div> -->
			</td>
			<?php }else echo '<td class="bg-secondary"></td>';$i++;} ?>
		</tr>
		<?php } ?>
	</tbody>
	
</table>
<!-- <div onclick="change(this)" style="z-index: 0;position: absolute;" id="work">P</div><div id="working" style="visibility: hidden;position: absolute;z-index: 1;color: red;margin-bottom: 2%;" onclick="change(this)">This working !</div> -->
<?php 
 ?>
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