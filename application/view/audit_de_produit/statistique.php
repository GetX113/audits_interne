<?php setlocale(LC_TIME, "fr_FR"); ?>
<div class="card text-center" style="margin-top: 8%;margin-left: 15%;width: 72%;">
	<div class="card-header <?php echo $success; ?>">
		Avancement des audits Produits
	</div>
	<div class="card-body" style="">
		<form action="<?php echo URL; ?>audit_de_produit/Statistique" method="POST">
		<div class="row" style="margin-left: : 5%;">
		<div class="col-sm-1">
			<label style="margin-top: 60%;">De :</label>
		</div>
		<div class="form-group colorful-select dropdown-info col-sm-3" style="">
			<label>Mois</label>
			<input type="month" name="month1" class="form-control col-sm-12" required>
		</div>
		<div class="col-sm-1">
			<label style="margin-top: 60%;">&agrave :</label>
		</div>
		<div class="form-group colorful-select dropdown-info col-sm-3" style="">
			<label>Mois</label>
			<input type="month" name="month2" class="form-control col-sm-12" required>
		</div>
		<div class="form-group col-sm-2" style="">
			<button type="submit" style="margin-top: 20.5%;" class="btn btn-outline-primary col-sm-12">Afficher</button>
		</div>
		</div>
		</form>	
		<br>
		<img src="<?php echo URL; ?>img/status_audit_produit.png" >
	</div>
	<div class="card-footer <?php echo $success; ?>">
	</div>	
</div>