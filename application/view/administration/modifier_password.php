<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Modifier votre mot de passe
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php echo URL."administration/update_password"; ?>">
			<tr>
				<div class="form-group col-sm-6">
					<label>Mot de passe actuel</label>
					<input type="password" name="oldPassword" class="form-control text-center" id="oldPassword" required>
				</div>
			</tr>
			<tr>
				<div class="form-group col-sm-6">
					<label>Nouveau mot de passe</label>
					<input type="password" name="newPassword" class="form-control text-center" id="password" required>
				</div>
			</tr>
			<tr>
				<div class="form-group col-sm-6">
					<label>Confirmez votre mot de passe</label>
					<input type="password" name="newPassword1" class="form-control text-center" id="confirm_password" required>
					<span id='message'></span>
				</div>
			</tr>
			<tr>
				<div class="form-group">
					<button type="submit" style="margin-left: -50%;" class="btn btn-outline-primary col-sm-4">Modifier le mot de passe</button>
				</div>
			</tr>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>">
		<?php echo $commentaire; ?>
	</div>	
</div>
<script src="<?php echo URL; ?>js/md5.js"></script>
<script type="text/javascript">
	var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password")
  ,	oldPassword = document.getElementById("oldPassword");
	function validatePassword(){
	  if(password.value != confirm_password.value) {
	    confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
	  } else {
	    confirm_password.setCustomValidity('');
	  }
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;


	function checkPass(){
	  if('<?php echo $_SESSION["password"]; ?>' != calcMD5(oldPassword.value).toString()) {
	    oldPassword.setCustomValidity("Le mots de passe est incorrect");
	  } else {
	    oldPassword.setCustomValidity('');
	  }
	}
	oldPassword.onchange = checkPass;
	oldPassword.onkeyup = checkPass;

</script>