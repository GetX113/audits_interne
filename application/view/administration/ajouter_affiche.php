<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter une affiche
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php echo URL; ?>administration/upload_affiche" enctype="multipart/form-data">
			<table>
				<tr>
					<div class="form-group col-sm-6">
						<label>Titre d'affiche</label>
						<input type="text" name="titre" class="form-control text-center" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Text/Commentaire</label>
					    <textarea class="form-control" id="" rows="2" name="commentaire" required></textarea>
					</div>
				</tr>
				<div class="input-group col-sm-6">
				  <div class="input-group-prepend">
				    <span class="input-group-text">Photo</span>
				  </div>
				  <div class="custom-file">
				    <input type="file" class="custom-file-input" id="inputGroupFile01" name="picture" required>
				    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
				  </div>
				</div>
				<tr>
					<div class="form-group" style="margin-top: 2%;">
						<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4">Ajouter l'affiche</button>
					</div>
				</tr>
			</table>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>"><?php echo $commentaire; ?></div>
</div>