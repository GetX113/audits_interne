<?php 
// require APP . 'model/poste_model.php';
// function updateStatus($poste, $auditeur, $date)
// {
// 	$status = $this->postemodel->getStatusAction($poste, $auditeur, $date);

// 	if (array_unique($status) === array('Soldé')) {
// 		$this->postemodel->updateStatus($poste, $date, "Soldé");

// 	}elseif (strtotime(date('Y-m-d')) > strtotime($date)) {
// 		$this->postemodel->updateStatus($poste, $date, "Retard");	
// 	}else $this->postemodel->updateStatus($poste, $date, "encours");
// }
	function getNbrOccurrenceMonth($data, $month)
	{
		$datas = 0;
		$month = explode('-', $month);

		foreach ($data as $dt) {
		 	$date = explode('-', $dt->date_planifier);
		    if (intval($date[1]).'-'.$date[0] == intval($month[1]).'-'.$month[0]) {
		    	$datas++;
		    }
		 }
			return $datas;
	}
	function getNbrOccurrenceMonthProcess($data, $month)
	{
		$datas = 0;
		$month = explode('-', $month);

		foreach ($data as $dt) {
		 	$date = explode('-', $dt->date_plan);
		    if (intval($date[1]).'-'.$date[0] == intval($month[1]).'-'.$month[0]) {
		    	$datas++;
		    }
		 }
			return $datas;
	}
	function getNbrOccurrenceActionMonth($data, $month)
	{
		$datas = 0;
		$month = explode('-', $month);

		foreach ($data as $dt) {
		 	$date = explode('-', $dt->date_prevue);
		    if (intval($date[1]).'-'.$date[0] == intval($month[1]).'-'.$month[0]) {
		    	$datas++;
		    }
		 }
			return $datas;
	}
	function getNbrOccurrenceActionMonthProcess($data, $month)
	{
		$datas = 0;
		$month = explode('-', $month);

		foreach ($data as $dt) {
		 	$date = explode('-', $dt->date_audit);
		    if (intval($date[1]).'-'.$date[0] == intval($month[1]).'-'.$month[0]) {
		    	$datas++;
		    }
		 }
			return $datas;
	}
 ?>