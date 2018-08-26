<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter un secteur
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php echo URL; ?>administration/update_secteur">
			<tr>
				<div class="form-group col-sm-6">
					<label>Nom de secteur</label>
					<input type="text" name="nomSecteur" class="form-control text-center" value="<?php echo htmlspecialchars($nomSecteur, ENT_QUOTES, 'UTF-8'); ?>" required>
				</div>
			</tr>
			<tr>
				<div class="form-group col-sm-6">
					<label>Nom de responsable</label>
					<input type="text" name="nomResponsable" class="form-control text-center" value="<?php echo htmlspecialchars($nomResponsable, ENT_QUOTES, 'UTF-8'); ?>" required>
					<input type="hidden" name="idSecteur" value="<?php echo htmlspecialchars($idSecteur, ENT_QUOTES, 'UTF-8'); ?>" />
				</div>
			</tr>
			<tr>
				<div class="form-group">
					<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4">Modifier le secteur</button>
				</div>
			</tr>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>">
		Veuillez remplir tous les champs !
	</div>	
</div>