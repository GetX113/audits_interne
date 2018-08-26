<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Changer les informations d'audit
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php  echo URL."audit_de_processus/update_information_audit/".htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" novalidate>
			<tr>
				<div class="slidecontainer" >
				<div class="form-group col-sm-6">
					<label>Indice de confiance</label>
				</div>
				  <input type="range" min="0" max="100" class="slider" id="ex1" list="grade" style="width: 43%;margin-left: -50%;" onchange="updateTextInput(this.value);" value="<?php echo $ic; ?>">
				  <datalist id="grade">
					<option value="0" label="0%">
					<option value="10">
					<option value="20">
					<option value="30">
					<option value="40">
					<option value="50" label="50%">
					<option value="60">
					<option value="70">
					<option value="80">
					<option value="90">
					<option value="100" label="100%">
				  </datalist>
				  <input type="text" id="textInput" class="form-control text-center" style="width: 8%;margin-left: 21%;"  value="<?php echo $ic.'%'; ?>" disabled>
				  <input type="hidden" id="ic" name="ic" class="form-control text-center" value="<?php echo $ic; ?>">
				  <input type="hidden" id="datePlan" name="datePlan" class="form-control text-center" value="<?php echo $datePlan; ?>">
				  <input type="hidden" id="produit" name="produit" class="form-control text-center" value="<?php echo $produit; ?>">
				  <input type="hidden" id="cotation" name="cotation" class="form-control text-center" value="<?php echo $cotation; ?>">
				  <input type="hidden" id="processus" name="processus" class="form-control text-center" value="<?php echo $processus; ?>">
				  <input type="hidden" id="Auditeur" name="Auditeur" class="form-control text-center" value="<?php echo $Auditeur; ?>">
				</div>
			</tr>
			<br>
			<tr>
				<div class="form-group col-sm-6">
					<label>État d'audit</label>
					<select name="status" class="form-control text-center" onchange="retardCheck(this);" required>
						<option></option>
						<option value="qualifie">	Audit Qualifié</option>
						<option value="non qualifie">	Audit non Qualifié</option>
						<option value="non realiser">	Audit non Réaliser</option>
					</select>
				</div>
			</tr>
			<tr>
				<div class="form-group col-sm-6" id="ifYes" style="display: none;">
					<label>Date de suivi</label>
					<input type="Date" name="dateSuivi" class="form-control" style="text-align: center;" value="<?php echo $date_suivi; ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>" required>
				</div>
				<div class="form-group col-sm-6" id="ifRetard" style="display: none;">
					<label>Date de replanification</label>
					<input type="Date" name="dateRep" class="form-control" style="text-align: center;" value="<?php echo $date_replanification; ?>" required>
				</div>
			</tr>
			<tr>
				<div class="form-group">
					<button type="submit" style="margin-left: -50%;margin-top: 4%;" class="btn btn-outline-primary col-sm-4">Changer les informations</button>
				</div>
			</tr>
		</form>
	</div>
	<div class="card-footer <?php echo $success; ?>">
		<?php echo $commentaire; ?>
	</div>	
</div>
<script type="text/javascript">
	function retardCheck(that) {
        if (that.value == "non qualifie") {
            alert("Merci de saisir la date de suivi !");
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
        if (that.value == "non realiser") {
            alert("Merci de saisir la date de replanification !");
            document.getElementById("ifRetard").style.display = "block";
            $('#ex1').prop( "disabled", true );
        } else {
            document.getElementById("ifRetard").style.display = "none";
            $('#ex1').prop( "disabled", false );
        }
    }
</script>