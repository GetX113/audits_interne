<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter un processus
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php if(isset($nomProcessus)){ echo URL."administration/update_processus";}else echo URL."administration/Ajouter_processus"; ?>">
			<tr>
				<div class="form-group col-sm-6">
					<label>Nom de processus</label>
					<input type="text" name="nomProcessus" class="form-control text-center" value="<?php if(isset($nomProcessus)){echo $nomProcessus;} ?>" required>
					<input type="hidden" name="id" value="<?php if(isset($id)){echo $id;} ?>">
				</div>
			</tr>
			<tr>
				<div class="form-group">
					<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4"><?php if (!isset($nomProcessus)) {echo "Ajouter";}else echo "Modifier"; ?> le processus</button>
				</div>
			</tr>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>">
		<?php echo $commentaire; ?>
	</div>	
</div>