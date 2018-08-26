<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter un type d'écart
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php if(isset($nomEcart)){ echo URL."administration/update_Ecart";}else echo URL."administration/Ajouter_Ecart"; ?>">
			<tr>
				<div class="form-group col-sm-6">
					<label>Nom de l'écart</label>
					<input type="text" name="nomEcart" class="form-control text-center" value="<?php if(isset($nomEcart)){echo $nomEcart;} ?>" required>
					<input type="hidden" name="id" value="<?php if(isset($id)){echo $id;} ?>">
				</div>
			</tr>
			<tr>
				<div class="form-group">
					<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4"><?php if (!isset($nomEcart)) {echo "Ajouter";}else echo "Modifier"; ?> le type d'écart</button>
				</div>
			</tr>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>">
		<?php echo $commentaire; ?>
	</div>	
</div>