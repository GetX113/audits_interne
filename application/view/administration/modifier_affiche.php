<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Modifier une affiche
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php echo URL; ?>administration/update_affiche" enctype="multipart/form-data">
			<table>
				<tr>
					<div class="form-group col-sm-6">
						<label>Titre d'affiche</label>
						<input type="text" name="titre" class="form-control text-center" value="<?php echo $titre; ?>" required>
						<input type="hidden" name="id_affiche" value="<?php echo $id_affiche; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Text/Commentaire</label>
					    <textarea class="form-control" id="" rows="2" name="commentaire" required><?php echo $commentairee; ?></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group" style="margin-top: 2%;">
						<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4">Modifier l'affiche</button>
					</div>
				</tr>
			</table>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>"><?php echo $commentaire; ?></div>
</div>