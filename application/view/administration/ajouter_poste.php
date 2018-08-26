<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter un poste
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php if(isset($nomPoste)){echo URL."administration/update_poste";}else echo URL."administration/Ajouter_poste"; ?>">
			<table>
				<tr>
					<div class="form-group col-sm-6">
						<label>Nom de poste</label>
						<input type="text" name="nomPoste" class="form-control text-center" value="<?php if(isset($nomPoste)){echo $nomPoste;} ?>" required>
						<input type="hidden" name="id" value="<?php echo $id; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Secteur</label>
						<select name="secteur" class="form-control text-center" required>
							<option></option>
							<?php
							foreach ($secteurs as $secteur) {
								if ($secteur->nom_secteur == $secteure) {
									echo '<option selected="selected">'.$secteur->nom_secteur.'</option>';
								}else
							 	echo '<option>'.$secteur->nom_secteur.'</option>';
							 } 
							 ?>
						</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Premiere date d'audit</label>
						<input type="date" name="dateAudit" class="form-control text-center" value="<?php if(isset($premiereDate)){echo $premiereDate;} ?>" required>
					</div>
				</tr>
				<tr>
					<div class="form-group">
						<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4"><?php if(isset($nomPoste)){echo "Modifier";}else echo "Ajouter"; ?> le poste</button>
					</div>
				</tr>
			</table>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>">Veuillez remplir tous les champs !</div>
</div>
