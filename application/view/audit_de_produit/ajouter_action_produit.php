<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter une action produit
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php echo URL; ?>audit_de_produit/ajouter_action_produit">
			<table>
				<tr>
					<div class="form-group col-sm-6">
						<label>Date d'audit</label>
						<input type="Date" name="datePlan" class="form-control" style="text-align: center;" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Nom d'auditeur</label>
					    <input type="text" id="" class="form-control" style="text-align: center;" disabled value="<?php echo $nomAuditeur; ?>">		
						<input type="hidden" name="nom_auditeur" value="<?php echo $nomAuditeur; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Secteur</label>
						<select name="secteur" class="form-control text-center" required>
							<option></option>
							<?php
							foreach ($secteurs as $secteur) {
							 	echo '<option>'.$secteur->nom_secteur.'</option>';
							 } 
							 ?>
						</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Référence-Produit</label>	
					    <input type="text" id="" class="form-control" style="text-align: center;" disabled value="<?php echo $nom_produit; ?>">
						
						<input type="hidden" name="produit" value="<?php echo $nom_produit; ?>">
					</div>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Désignation</label>
					    <textarea class="form-control" id="" rows="2" name="designationnn" disabled><?php echo $_POST["designationn"]; ?></textarea>
					    <input type="hidden" name="designation" value="<?php echo $_POST["designationn"]; ?>">
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
						<label>Protection client</label>
						<input type="text" name="protectionClient" class="form-control" required>
					</div>
				</tr>	
				<tr>
					<div class="form-group col-sm-6">
						<label>Pilote</label>
						<input type="text" name="pilote_audit" class="form-control" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Analyse des causes</label>
						<input type="text" name="analyseCauses" class="form-control" required>
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
						<label>Pilote</label>
						<input type="text" name="pilote_action" class="form-control" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Date d'audit</label>
						<input type="Date" name="dateAction" class="form-control" style="text-align: center;">
					</div>
				</tr>
				<tr>
					<div class="custom-control custom-checkbox" style="display: flex;margin-left: 10%;">
					  <input type="checkbox" class="custom-control-input" id="customCheck5" name="conforme" value="1">
					  <label class="custom-control-label" for="customCheck5">Non conforme</label>
					</div>
				</tr>
				<tr>
					<div class="custom-control custom-checkbox" style="display: flex;margin-left: 10%;">
					  <input type="checkbox" class="custom-control-input" id="customCheck4" name="validation" value="1">
					  <label class="custom-control-label" for="customCheck4">Validation protection client</label>
					</div>
				</tr>
				<tr>
					<div class="custom-control custom-checkbox" style="display: flex;margin-left: 10%;">
					  <input type="checkbox" class="custom-control-input" id="customCheck5" name="realiser" value="1">
					  <label class="custom-control-label" for="customCheck5">Réaliser</label>
					</div>
				</tr>
				
				<tr>
					<div class="form-group">
						<button type="submit" style="margin-left: -50%;margin-top: 3.5%;" class="btn btn-outline-primary col-sm-4">Ajouter l'action</button>
					</div>
				</tr>
			</table>
		</form>		
	</div>
	<div class="card-footer <?php echo $success; ?>">Veuillez remplir tous les champs !</div>
</div>
