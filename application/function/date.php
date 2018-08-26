<?php 
// fonction rendre la liste des jours de travail durant l'annee courant
function getWorkDays($mois) {

		$joursFeries = ['1-1', '11-1', '1-5', '30-7', '14-8', '20-8', '21-8', '6-11', '18-11'];

		$workdays = array();
		$work = [];
		$type = CAL_GREGORIAN;
		$month = date($mois); 
		$year = date('Y'); 
		$day_count = cal_days_in_month($type, $month, $year); 

		for ($i = 1; $i <= $day_count; $i++) {

	        $date = $year.'/'.$month.'/'.$i; //format date
	        $get_name = date('l', strtotime($date)); //le nom du jour
	        $day_name = substr($get_name, 0, 3); // filtrer les trois premier char of day

	        //if not a weekend ajouter a la liste des jours
	        if($day_name != 'Sun' && !in_array($i.'-'.$month, $joursFeries)){
	            $workdays[] = $i;
	            
	        }
		}
		for ($i=0; $i < count($workdays); $i++) { 
			array_push($work, $year.'-'.$month.'-'.$workdays[$i]);
		}
		
		return $work;
	}
function allDaysOfYear($year) {
 
	  $range = array();
	  $start = strtotime($year.'-01-01'); 
	  $end = strtotime($year.'-12-31');
	 
	  do {
	  	$date = date('Y-m-d',$start);
	  	$dates = explode('-', $date);
	   $range[] = $dates[0].'-'.intval($dates[1]).'-'.intval($dates[2]);
	   $start = strtotime("+ 1 day",$start);
	  } while ( $start <= $end );
	 
	 return $range;
	}
function allMonthOfYear($year) {
 
	  $range = array();
	  $start = strtotime($year.'-01'); 
	  $end = strtotime($year.'-12');
	 
	  do {
	  	$date = date('Y-m',$start);
	  	$dates = explode('-', $date);
	   $range[] = $dates[0].'-'.intval($dates[1]);
	   $start = strtotime("+ 1 month",$start);
	  } while ( $start <= $end );
	 
	 return $range;
	}

 ?>