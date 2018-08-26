<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter une action poste
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php echo URL; ?>audit_de_poste/ajouter_action_poste">
			<table>
				<tr>
					<div class="form-group col-sm-6">
						<label>Date d'action</label>
						<input type="Date" name="dateAction" class="form-control" value="<?php echo $datePlanifier; ?>" style="text-align: center;" disabled>
						<input type="hidden" name="datePlan" value="<?php echo $datePlanifier; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Nom d'auditeur</label>
					    <input type="text" id="" class="form-control" style="text-align: center;" disabled value="<?php echo $nomAuditeur; ?>">		
						<!-- <select name="nomAuditeur" class="form-control text-center" disabled>
							<option></option>
							<?php
							foreach ($auditeurs as $auditeur) {
							 	
							 	if ($auditeur == $nomAuditeur) {
							 		echo '<option selected="selected"  style="text-align: center;">'.$auditeur.'</option>';
							 	}else echo '<option>'.$auditeur.'</option>';
							 } 
							 ?>
						</select> -->
						<input type="hidden" name="nom_auditeur" value="<?php echo $nomAuditeur; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Poste</label>	
					    <input type="text" id="" class="form-control" style="text-align: center;" disabled value="<?php echo $nom_poste; ?>">
						<!-- <select class="form-control text-center" disabled>
							<option></option>
							<?php
							foreach ($postes as $poste) {
								if ($poste->nom_poste == $nom_poste) {
							 		echo '<option selected="selected"  style="text-align: center;">'.$nom_poste.'</option>';
							 	}else echo '<option>'.$poste->nom_poste.'</option>';
							 } 
							 ?>
						</select> -->
						<input type="hidden" name="poste" value="<?php echo $nom_poste; ?>">
					</div>
					</div>
				</tr>
				<tr>
					<div style="display: -webkit-box;">
						<div class="form-group col-sm-4">
						    <label for="">R&eacutef&eacuterence</label>
						    <select id="references" class="form-control text-center" required>
								<option></option>
								<?php
								foreach ($references as $reference) {
								 	echo '<option>'.$reference->nom_reference.'</option>';
								 } 
								 ?>
							</select>
						</div>	
						<div style="margin-top: 4%;">
							<button type="button" class="btn btn-secondary" onclick="addReference()">Add</button>
							<button type="button" class="btn btn-secondary" onclick="subReference()">Sub</button>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<input type="text" id="referencess" class="form-control" disabled value="" class="text-center">	
						<input type="hidden" name="references" value="" id="ref">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Type d'&eacutecart</label>
					    <select class="form-control" id="" name="typeEcart" required>
					    	<option></option>
					    	<?php foreach ($ecarts as $ecart) { ?>
							<option><?php echo $ecart->nom; ?></option>
							<?php } ?>
						</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">&Eacutecart constat&eacute</label>
					    <textarea class="form-control" id="" rows="2" name="ecartConstate" ></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Analyse (5 pourquoi)</label>
					    <textarea class="form-control" id="" rows="2" name="analyse" ></textarea>
					</div>
				</tr>			
				<tr>
					<div class="form-group col-sm-6">
						<label>Action corrective</label>
						<input type="text" name="actionCorrective" class="form-control" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Secteur</label>	
						<input type="text" id="" class="form-control" style="text-align: center;" disabled value="<?php echo $secteures; ?>">
						<input type="hidden" name="secteur" value="<?php echo $secteures; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label for="">Responsable</label>
						    <select name="responsable" class="form-control text-center" required>
								<option></option>
								<?php
								foreach ($responsables as $responsable) {
								 	echo '<option>'.$responsable->nom_resp.'</option>';
								 } 
								 ?>
							</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label for="">Processus</label>
						    <select name="processus" class="form-control text-center" required>
								<option></option>
								<?php
								foreach ($processus as $proc) {
								 	echo '<option>'.$proc->nom.'</option>';
								 } 
								 ?>
							</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Date de r&eacutealisation</label>
						<input type="Date" name="dateRealisation" class="form-control">
					</div>
				</tr>
				<tr>
					<div class="form-group">
						<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4">Ajouter l'action</button>
					</div>
				</tr>
			</table>
		</form>		
	</div>
	<div class="card-footer <?php echo $success; ?>">Veuillez remplir tous les champs !</div>
</div>
