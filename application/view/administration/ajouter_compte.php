<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter un compte utilisateur
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php  echo URL."administration/Ajouter_compte"; ?>">
			<tr>
				<div class="form-group col-sm-6">
					<label>Nom</label>
					<input type="text" name="nom" class="form-control text-center"  required>
				</div>
			</tr>
			<tr>
				<div class="form-group col-sm-6">
					<label>Prenom</label>
					<input type="text" name="prenom" class="form-control text-center" required>
				</div>
			</tr>
			<tr>
				<div class="form-group col-sm-6">
					<label>Username</label>
					<input type="text" name="username" class="form-control text-center" required>
				</div>
			</tr>
			<tr>
				<div class="form-group col-sm-6">
					<label>Password</label>
					<input type="password" name="password" class="form-control text-center" required>
				</div>
			</tr>
			<tr>
				<div class="form-group col-sm-6">
					<label>Fonction</label>
					<select name="fonction" class="form-control text-center" required>
						<option></option>
						<option value="responsable">Responsable</option>
						<option value="chef equipe">Chef d'équipe</option>
						<option value="auditeur">Auditeur</option>
					</select>
				</div>
			</tr>
			<tr>
				<div class="form-group">
					<button type="submit" style="margin-left: -50%;margin-top: 4%;" class="btn btn-outline-primary col-sm-4">Ajouter le compte</button>
				</div>
			</tr>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>">
		<?php echo $commentaire; ?>
	</div>	
</div>