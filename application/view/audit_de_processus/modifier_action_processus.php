<div class="card text-center" style="width: 60%; margin: 0 auto;margin-top: 8%">
	<div class="card-header <?php echo $success; ?>">
		Ajouter une action processus
	</div>
	<div class="card-body" style="margin-left: 24%;width: 100%;">
		<form class="needs-validation" method="POST" action="<?php echo URL; ?>audit_de_processus/modifier_action_processus">
			<table>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Mois d'audit</label>	
					    <input type="text" id="" class="form-control" style="text-align: center;" value="<?php echo $mois; ?>" disabled>
					    <input type="hidden" name="moisAudit" value="<?php echo $m; ?>">
					    <input type="hidden" name="id_action" value="<?php echo $idAction; ?>">
					</div>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Date d'audit</label>
						<input type="Date" name="datePlan" class="form-control" style="text-align: center;" value="<?php echo $datePlan; ?>" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Processus</label>
					    <input type="text" id="" class="form-control" style="text-align: center;" disabled value="<?php echo $nomProcessus; ?>">		
						<input type="hidden" name="nom_processus" value="<?php echo $nomProcessus; ?>">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Nom d'auditeur</label>
					    <input type="text" id="" class="form-control" style="text-align: center;" disabled value="<?php echo $nomAuditeur; ?>">		
						<input type="hidden" name="nom_auditeur" value="<?php echo $nomAuditeur; ?>">
					</div>
				</tr>
				<tr>
					<div style="display: -webkit-box;">
						<div class="form-group col-sm-4">
						    <label for="">Ajouter auditeurs</label>
						    <select id="audits" class="form-control text-center">
								<option></option>
								<?php
								foreach ($auditeurs as $auditeur) {
								 	echo '<option>'.$auditeur.'</option>';
								 } 
								 ?>
							</select>
						</div>	
						<div style="margin-top: 4%;">
							<button type="button" class="btn btn-secondary" onclick="addAuditeur()">Add</button>
							<button type="button" class="btn btn-secondary" onclick="subAuditeur()">Sub</button>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<input type="text" id="auditeurss" class="form-control" disabled value="<?php echo $nomAuditeur; ?>" class="text-center">	
						<input type="hidden" name="auditeurs" value="<?php echo $nomAuditeur; ?>" id="auditeurs">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Secteur</label>
						<select name="secteur" class="form-control text-center" required>
							<option></option>
							<?php
							
							foreach ($secteurs as $secteur) {
								if ($secteur->nom_secteur==$nomSecteur) {$s = "selected";}else{$s="";}
							 	echo '<option '.$s.'>'.$secteur->nom_secteur.'</option>';
							 } 
							 ?>
						</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Type 6m</label>
					    <textarea class="form-control" id="" rows="2" name="type6m"><?php echo $type6m; ?></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Question</label>
					    <input type="text" name="question" value="<?php echo $question; ?>" class="form-control">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Crit&eacutere</label>
					    <input type="text" name="critere" value="<?php echo $critere; ?>" class="form-control">
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label>Référence</label>	
					    <input type="text" id="" class="form-control" style="text-align: center;" value="<?php echo $nomProduit; ?>" disabled>
					    <input type="hidden" name="reference" value="<?php echo $nomProduit; ?>">
					</div>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">&Eacutecart constat&eacute</label>
					    <textarea class="form-control" id="" rows="2" name="ecartConstate" ><?php echo $ecartConstate; ?></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Cotation</label>
						<input type="text" class="form-control" style="text-align: center;" value="<?php echo $cotation; ?>" disabled>
						<input type="hidden" name="cotation" class="form-control" value="<?php echo $cotation; ?>" required>
					</div>
				</tr>	
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Action immediate</label>
					    <textarea class="form-control" id="" rows="2" name="actionImmediate"><?php echo $actionImmediate; ?></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Délai</label>
						<input type="text" name="delai" class="form-control" value="<?php echo $delai; ?>" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Analyse</label>
					    <textarea class="form-control" id="" rows="2" name="analyse"><?php echo $analyse; ?></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
					    <label for="">Action corrective</label>
					    <textarea class="form-control" id="" rows="2" name="actionCorrective" ><?php echo $actionCorrective; ?></textarea>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Pilote</label>
						<input type="text" name="pilote" class="form-control" value="<?php echo $pilote; ?>" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Process</label>
						<select name="process" class="form-control text-center" required>
								<option></option>
								<?php
								foreach ($procs as $proc) {
									if ($proc->nom==$process) {$s = "selected";}else{$s="";}
								 	echo '<option '.$s.'>'.$proc->nom.'</option>';
								 } 
								 ?>
						</select>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Délai action</label>
						<input type="week" name="delaiAction" class="form-control" value="<?php echo $delaiAction; ?>" required>
					</div>
				</tr>
				<tr>
					<div class="form-group col-sm-6">
						<label>Date de réalisation</label>
						<input type="Date" name="dateRealisation" class="form-control" value="<?php echo $dateRealisation; ?>" style="text-align: center;">
					</div>
				</tr>
				
				<tr>
					<div class="form-group">
						<button type="submit" style="margin-left: -50%;margin-top: 3.5%;" class="btn btn-outline-primary col-sm-4">Ajouter l'action</button>
					</div>
				</tr>
			</table>
		</form>		
	</div>
	<div class="card-footer <?php echo $success; ?>">Veuillez remplir tous les champs !</div>
</div>
