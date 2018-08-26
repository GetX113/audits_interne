<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Modifier une action
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form action="<?php echo URL; ?>audit_de_poste/update_action" class="needs-validation" method="POST">
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
					    <input type="hidden" name="id_action" value="<?php echo $id_action; ?>">
						<input type="hidden" name="nom_auditeur" value="<?php echo $nomAuditeur; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Poste</label>	
					    <input type="text" id="" class="form-control" style="text-align: center;" disabled value="<?php echo $nom_poste; ?>">
						<input type="hidden" name="poste" value="<?php echo $nom_poste; ?>">
					</div>
					</div>
				</tr>
				<tr>
					<div style="display: -webkit-box;">
						<div class="form-group col-sm-4">
						    <label for="">Référence</label>
						    <select id="references" class="form-control text-center">
								<option></option>
								<?php
								foreach ($referencess as $reference) {
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
						<input type="text" id="referencess" class="form-control" disabled value="<?php echo $references; ?>" class="text-center">	
						<input type="hidden" name="references" value="<?php echo $references; ?>" id="ref">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Type d'écart</label>
					    <select class="form-control" id="" name="typeEcart" required>
					    	<option></option>
					    	<?php foreach ($ecarts as $ecart) {
					    	if ($ecart->nom == $typeEcart) { 
							 echo '<option selected="selected">'.$ecart->nom.'</option>';
							}else{  echo '<option>'.$ecart->nom.'</option>'; }} ?>
								
						</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Écart constaté</label>
					    <textarea class="form-control" id="" rows="2" name="ecartConstate" required><?php echo $ecartConstate; ?></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Analyse (5 pourquoi)</label>
					    <textarea class="form-control" id="" rows="2" name="analyse" required><?php echo $analyse; ?></textarea>
					</div>
				</tr>			
				<tr>
					<div class="form-group col-sm-6">
						<label>Action corrective</label>
						<input type="text" name="actionCorrective" class="form-control" value="<?php echo $actionCorrective; ?>" required>
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
									if ($responsable->nom_resp == $resp) {
										echo '<option selected="selected">'.$responsable->nom_resp.'</option>';
									}else
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
									if ($proc->nom == $nomProcessus) {
										echo '<option selected="selected">'.$proc->nom.'</option>';
									}else
								 	echo '<option>'.$proc->nom.'</option>';
								 } 
								 ?>
							</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Date de réalisation</label>
						<input type="Date" name="dateRealisation" class="form-control">
					</div>
				</tr>
				<tr>
					<div class="form-group">
						<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4">Modifier l'action</button>
					</div>
				</tr>
			</table>
		</form>	
	</div>
	<div class="card-footer <?php echo $success; ?>">Veuillez remplir tous les champs !</div>
</div>
