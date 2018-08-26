<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter une référence
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php echo URL; ?>administration/update_reference">
			<table>
				<tr>
					<div class="form-group col-sm-6">
						<label>Nom de référence</label>
						<input type="text" name="nom_Reference" class="form-control text-center" value="<?php echo $nomReference; ?>" required>
						<input type="hidden" name="nomReference" class="form-control text-center" value="<?php echo $nomReference; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Numéro de maquette</label>
						<input type="text" name="num_Maquette" class="form-control text-center" value="<?php echo $numMaquette; ?>" required>
						<input type="hidden" name="numMaquette" class="form-control text-center" value="<?php echo $numMaquette; ?>" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Désignation d'article</label>
					    <textarea class="form-control" id="" rows="2" name="designation" required><?php echo $designation; ?></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Poste de démarrage</label>	
						<select name="posteDemarrage" class="form-control text-center" required>
							<option></option>
							<?php
							foreach ($postes as $poste) {
							 	if ($poste->nom_poste == $posteDemarrage) {
							 		echo '<option selected>'.$poste->nom_poste.'</option>';			
							 	}else echo '<option>'.$poste->nom_poste.'</option>';
							 }
							 ?>
						</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Nombre de la non-conformité</label>
						<input type="number" name="nbr_NC" class="form-control text-center" value="<?php echo $nbrNC; ?>" required>
						<input type="hidden" name="nbrNC" class="form-control text-center" value="<?php echo $nbrNC; ?>" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Durée de démarrage de la référence</label>	
						<select name="dureeDemarrage" class="form-control text-center" required>
							<option></option>
							<option value="fin" <?php if ($dureeDemarrage == "fin") {
								echo "selected";
							}else echo ""; ?>>Fin de vie</option>
							<option value="serie" <?php if ($dureeDemarrage == "serie") {
								echo "selected";
							}else echo ""; ?>>Série</option>
							<option value="projet" <?php if ($dureeDemarrage == "projet") {
								echo "selected";
							}else echo ""; ?>>Projet(Phase E.I - DMS - Ramp UP)</option>
						</select>
					</div>
				</tr>
			<!-- 	<tr>
					<div style="display: ruby;margin-left: -53%;">
						<div class="form-group col-sm-4">
						    <label for="">Le processus de fabrication</label>
						    <select class="form-control" id="processuss" required>
						    	<option></option>
								<?php
								foreach ($postes as $poste) {
							 	echo '<option>'.$poste->nom_poste.'</option>';
								} 
								?>
							</select>
						</div>	
						<div>
							<button type="button" class="btn btn-secondary" onclick="addProcessus()">Add</button>
							<button type="button" class="btn btn-secondary" onclick="subProcessus()">Sub</button>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<input type="text" name="processus" id="processus" class="form-control" disabled value="">	
					</div>
				</tr> -->
				<tr>
					<div class="custom-control custom-checkbox" style="display: flex;margin-left: 10%;">
					  <input type="checkbox" class="custom-control-input" id="customCheck1" name="sr" value="3" <?php if ($sr == 3) {
					  	echo "checked";
					  }else echo ""; ?>>
					  <label class="custom-control-label" for="customCheck1">Pièce Sécurité Réglementation</label>
					</div>
				</tr>
				<tr>
					<div class="custom-control custom-checkbox" style="display: flex;margin-left: 10%;">
					  <input type="checkbox" class="custom-control-input" id="customCheck2" name="top50" value="3" <?php if ($top50 == 3) {
					  	echo "checked";
					  }else echo ""; ?>>
					  <label class="custom-control-label" for="customCheck2">La référence est-il parmi les Top 50 ?</label>
					</div>
				</tr>
				<tr>
					<div class="custom-control custom-checkbox" style="display: flex;margin-left: 10%;">
					  <input type="checkbox" class="custom-control-input" id="customCheck3" name="modifProc" value="3" <?php if ($modifProc == 3) {
					  	echo "checked";
					  }else echo ""; ?>>
					  <label class="custom-control-label" for="customCheck3">Le produit/processus est-il modifier ?</label>
					</div>
				</tr>
				<tr>
					<div class="custom-control custom-checkbox" style="display: flex;margin-left: 10%;">
					  <input type="checkbox" class="custom-control-input" id="customCheck4" name="ppm" value="3" <?php if ($ppm == 3) {
					  	echo "checked";
					  }else echo ""; ?>>
					  <label class="custom-control-label" for="customCheck4">Le PPM interne a-t-il dépassé l'objectif ?</label>
					</div>
				</tr>
				<tr>
					<div class="form-group" style="margin-top: 2%;">
						<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4">Modifier la référence</button>
					</div>
				</tr>
			</table>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>"><?php echo $commentaire; ?></div>
</div>