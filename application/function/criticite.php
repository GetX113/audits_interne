<?php 
require APP . 'model/admin_model.php';
function calCriticitePoste($poste)
{
	$srC = 1;
	$ncC = 0;
	$dureeDemarrageC = 1;
	$modifProcC = 0;
	$model = new adminModel();
	$references = $model->getReferenceByPoste($poste->nom_postes);
	foreach ($references as $reference) {
		if ($reference->sr == 3) {
			$srC = 3;
		}
		if ($reference->duree_demarrage == "projet") {
			$dureeDemarrageC = 3;
		}
		if ($reference->modif_proc == 3) {
			$modifProcC++;
		}
		$ncC += $reference->nbr_nc;
		
	}
	if ($ncC >= 2) {
		$ncC = 9;
	}elseif ($ncC == 1) {
		$ncC = 3;
	}else $ncC = 1;
	if ($modifProcC >=2) {
		$modifProcC = 3;
	}elseif ($modifProcC == 1) {
		$modifProcC = 2;
	}else $modifProcC = 1;

	$criticite_poste = $srC * $ncC * $dureeDemarrageC * $modifProcC;

	$this->adminmodel->updateCriticitePoste($poste->id_poste, $criticite_poste);
}



 ?>