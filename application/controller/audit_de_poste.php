<?php 

/**
* Gestion d'audit de poste
*/
class Audit_de_poste extends Controller
{
	public function index()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_poste/planning_poste.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function delete_planning()
	{
		session_start();
        if (isset($_SESSION["username"])) {
			$this->postemodel->deletePlanning();
			$clrPoste = "#162e45";
			header('location: ' . URL . 'audit_de_poste/planning_poste');
		}else header('location: ' . URL);
	}

	
	public function Ajouter_action()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			$auditeurs = $this->postemodel->getAuditeurs();
			$references = $this->adminmodel->getAllReference();
			$postes = $this->adminmodel->getAllPoste();
			$responsables = $this->adminmodel->getAllResponsable();
			$processus = $this->adminmodel->getAllProcessus();
			$ecarts = $this->adminmodel->getAllEcart();
			if (isset($_POST["actionCorrective"])) {
	        	$success = "bg-success text-white";
	        }
	        if (isset($_POST["datePlanifier"])) {
	        	$nomAuditeur = $_POST["nomAudit"];
	        	$datePlanifiers = explode('-', $_POST["datePlanifier"]);
	        	$datePlanifier = $datePlanifiers[0].'-'.sprintf('%02s', $datePlanifiers[1]).'-'.sprintf('%02s', $datePlanifiers[2]);
	        	$nom_poste = $_POST["nomPoste"];
	        	$sect = $this->adminmodel->getSecteurByPoste($nom_poste);
	        	foreach ($sect as $secte) {
	        		$secteures = $secte;
	        	}
	        	// load views
		        require APP . 'view/_templates/header.php';
		        require APP . 'view/audit_de_poste/ajouter_action_poste.php';
		        require APP . 'view/_templates/footer.php';
	        }else header('location: ' . URL . 'audit_de_poste/planning_poste');
        }else header('location: ' . URL);
		
        
	}
	public function ajouter_action_poste()
	{
		session_start();
        if (isset($_SESSION["username"])) {
			require APP . 'function/planning.php';
			$references = $this->adminmodel->getAllReference();
			$secteurs = $this->adminmodel->getAllSecteur();
			if (isset($_POST["datePlan"]) and isset($_POST["nom_auditeur"]) and isset($_POST["secteur"]) and isset($_POST["references"]) and isset($_POST["typeEcart"]) and isset($_POST["ecartConstate"]) and isset($_POST["analyse"]) and isset($_POST["actionCorrective"]) and isset($_POST["poste"]) and isset($_POST["responsable"])) {
				$dt = explode('-', $_POST["datePlan"]);
				$date = $dt[0].'-'.intval($dt[1]).'-'.intval($dt[2]);

				if ($_POST["dateRealisation"] != NULL) {
					$status = "Soldé";
					$this->postemodel->setPosteAction($_POST["datePlan"], $_POST["nom_auditeur"], $_POST["secteur"], $_POST["poste"], $_POST["references"], $_POST["typeEcart"], $_POST["ecartConstate"], $_POST["analyse"], $_POST["actionCorrective"], $_POST["responsable"], $_POST["processus"], $_POST["dateRealisation"], $status);
					
				}elseif (strtotime(date('Y-m-d')) > strtotime($_POST["datePlan"])) {
					$status = "Retard";
					$this->postemodel->setPosteAction($_POST["datePlan"], $_POST["nom_auditeur"], $_POST["secteur"], $_POST["poste"], $_POST["references"], $_POST["typeEcart"], $_POST["ecartConstate"], $_POST["analyse"], $_POST["actionCorrective"], $_POST["responsable"], $_POST["processus"], '', $status);
					
				}else{
				 	$status = "encours";
				 	$this->postemodel->setPosteAction($_POST["datePlan"], $_POST["nom_auditeur"], $_POST["secteur"], $_POST["poste"], $_POST["references"], $_POST["typeEcart"], $_POST["ecartConstate"], $_POST["analyse"], $_POST["actionCorrective"], $_POST["responsable"], $_POST["processus"], '', $status);
				 	
				 }
				 $poste = $_POST["poste"];
				 $auditeur = $_POST["nom_auditeur"];

				 $statuss = $this->postemodel->getStatusAction($poste, $auditeur, $date);
					if (array_unique($statuss) === array('Soldé')) {
						$this->postemodel->updateStatus($poste, $date, "Soldé");
					}elseif(count($statuss) > 0) {
						$this->postemodel->updateStatus($poste, $date, "Réalisé");
					}elseif (strtotime(date('Y-m-d')) > strtotime($date)) {
						$this->postemodel->updateStatus($poste, $date, "Retard");	
					}else $this->postemodel->updateStatus($poste, $date, "encours");
				header('location: ' . URL . 'audit_de_poste/planning_poste');
			}else header('location: ' . URL);
			}
	}
	public function Plan_action($id_page)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			if (isset($id_page)) { $page  = $id_page; } else { $page=1; };
			$results_per_page = 32;
	    	$start_from = ($page-1) * $results_per_page;
			$actions = $this->adminmodel->getDisplayPage("action_audit_poste", "date_prevue", $start_from, $results_per_page);
			$total = $this->adminmodel->getTotalRecord("id_action", "action_audit_poste");
			$total_pages = ceil($total/$results_per_page);
			$commentaire = "";
			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_poste/plan_action.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function Planning_poste()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			header('Content-Type: text/html; charset=iso-8859-15');
			$utf = 'ok';
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			require APP . 'function/date.php';
			$works = [];
			for ($i=1; $i <= 12; $i++) { 
				$works = array_merge($works, getWorkDays($i));
			}
			$allDate = allDaysOfYear(date('Y'));
			$postes = $this->adminmodel->getAllPoste();
			$auditeurs = $this->postemodel->getAuditeurs();
			$plannings = $this->postemodel->getAllPlanning();
			$planning = [];
			foreach ($plannings as $plan) {
				array_push($plannings,$plan->poste."/".$plan->date_planifier."/".$plan->status."");
			}
			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_poste/planning_poste.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function planifier_audit_poste()
	{
		session_start();
        if (isset($_SESSION["username"])) {
			$this->postemodel->deletePlanningNoStatus();
			require APP . 'function/date.php';
			$works = [];
			for ($i=1; $i <= 12; $i++) { 
				$works = array_merge($works, getWorkDays($i));
			}
			$postes = $this->adminmodel->getAllPoste();

			foreach ($postes as $poste) {
				if ($poste->criticite_poste >= 27) {
					$pas = 21;
				}elseif ($poste->criticite_poste < 9) {
					$pas = 56;
				}else $pas = 42;
				$start = strtotime($poste->premiere_date);
				do {
					$dates = date('Y-m-d',$start);
					$date = explode('-', $dates);
					$status = $this->postemodel->getStatusPlanning($poste->nom_poste, $date[0].'-'.intval($date[1]).'-'.intval($date[2]));
					if (in_array($date[0].'-'.intval($date[1]).'-'.intval($date[2]), $works) ) {
						if (count($status) != 1) {
							$this->postemodel->setPlanning($poste->nom_poste, $date[0].'-'.intval($date[1]).'-'.intval($date[2]));
						}
						
					}else {
						$status = $this->postemodel->getStatusPlanning($poste->nom_poste, $date[0].'-'.intval($date[1]).'-'.(intval($date[2])+1));
						if (count($status) != 1) {
							$this->postemodel->setPlanning($poste->nom_poste, $date[0].'-'.intval($date[1]).'-'.(intval($date[2])+1));
						}
					}
					
					$start = strtotime("+ ".$pas." day",$start);
					
				} while ($date[0] == date('Y'));
				
			}
			$actions = $this->postemodel->getAllAction();
			foreach ($actions as $action) {
				$dt = explode('-', $action->date_prevue);
				$date = $dt[0].'-'.intval($dt[1]).'-'.intval($dt[2]);
				$statuss = $this->postemodel->getStatusAction($action->poste, $action->auditeur, $date);
					if (array_unique($statuss) === array('Soldé')) {
						if ($this->postemodel->getStatusPlanning($action->poste, $date)[0] != "Soldé") {
							$this->postemodel->updateStatus($action->poste, $date, "Soldé");
							$this->postemodel->updateAuditeur($action->poste, $date, $action->auditeur);
						}
						
					}elseif(count($statuss) > 0) {
						if ($this->postemodel->getStatusPlanning($action->poste, $date)[0] != "Réalisé") {
							$this->postemodel->updateStatus($action->poste, $date, "Réalisé");
							$this->postemodel->updateAuditeur($action->poste, $date, $action->auditeur);
						}
					}elseif (strtotime(date('Y-m-d')) > strtotime($date)) {
						if ($this->postemodel->getStatusPlanning($action->poste, $date)[0] != "Retard") {
							$this->postemodel->updateStatus($action->poste, $date, "Retard");	
							$this->postemodel->updateAuditeur($action->poste, $date, $action->auditeur);
						}
					}else{ $this->postemodel->updateStatus($action->poste, $date, "encours");
							$this->postemodel->updateAuditeur($action->poste, $date, $action->auditeur);}		
			}
			$plannings = $this->postemodel->getAllPlanning();
			foreach ($plannings as $plan) {
				if ($plan->status == "encours") {
					if (strtotime(date('Y-m-d')) > strtotime($plan->date_planifier)) {
						$this->postemodel->updateStatus($plan->poste, $plan->date_planifier, "Retard");
					}
				}
			}
			header('location: ' . URL . 'audit_de_poste/planning_poste');
		}else header('location: ' . URL);
	}
	public function affecter_auditeur($poste, $date)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			if (isset($_POST["nomAuditeur"])) {
				$this->postemodel->affecterAuditeur($poste, $date, $_POST["nomAuditeur"]);
				header('location: ' . URL . 'audit_de_poste/planning_poste');
			}		
		}else header('location: ' . URL);
			

	}
	public function supprimer_action($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			if (isset($id)) {
				$this->postemodel->deleteAction($id);
				$success = "bg-success text-white";
				$commentaire = "L'Action a été supprimer";
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			// header('location: ' . URL . 'administration/gestion_secteur');
			$actions = $this->postemodel->getAllAction();
			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_poste/plan_action.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function modifier_action_poste($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			$postes = $this->adminmodel->getAllPoste();
			$auditeurs = $this->postemodel->getAuditeurs();
			$responsables = $this->adminmodel->getAllResponsable();
			$referencess = $this->adminmodel->getAllReference();
			$processus = $this->adminmodel->getAllProcessus();
			$ecarts = $this->adminmodel->getAllEcart();
			if (isset($id)) {
				$actions = $this->postemodel->getActionById($id);
				foreach ($actions as $action) {
					$datePlanifier = $action->date_prevue;
					$nomAuditeur = $action->auditeur;
					$nom_poste = $action->poste;
					$references = $action->reference;
					$ecartConstate = $action->ecart_constate;
					$analyse = $action->analyse;
					$actionCorrective = $action->action_corrective;
					$secteures = $action->secteur_audite;
					$resp = $action->nom_resp;
					$id_action = $action->id_action;
					$typeEcart = $action->type_ecart;
					$nomProcessus = $action->processus;
				}
				$commentaire = "L'Action a été supprimer";
			}else {
	            header('location: ' . URL . 'audit_de_poste/plan_action/1');
	        }
			
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_poste/modifier_action_poste.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function recherche_action()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			if (isset($_POST["recherche"])) {
				$actions = $this->postemodel->rechercheAction($_POST["recherche"]);
				if($this->postemodel->rechercheAction($_POST["recherche"])){
					$success = "bg-success text-white";
					$commentaire = "La liste des actions disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_poste/plan_action.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Action non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_poste/plan_action.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}

	public function select_action($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			header("Cache-Control:no-cache");
			if (isset($id)) {
				$test = $this->postemodel->getActionById($id);
				foreach ($test as $t) {
					$auditeur = $t->auditeur;
					$date = $t->date_prevue;
					$poste = $t->poste;
				}
				$actions = $this->postemodel->selectAction($poste, $auditeur, $date);
				if($this->postemodel->selectAction($poste, $auditeur, $date)){
					$success = "bg-success text-white";
					$commentaire = "La liste des actions disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_poste/plan_action.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Action non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_poste/plan_action.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}

	public function update_action()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			if (isset($_POST["id_action"]) and isset($_POST["references"]) and isset($_POST["typeEcart"]) and isset($_POST["ecartConstate"]) and isset($_POST["analyse"]) and isset($_POST["actionCorrective"]) and isset($_POST["responsable"])) {
			$dt = explode('-', $_POST["datePlan"]);
			$date = $dt[0].'-'.intval($dt[1]).'-'.intval($dt[2]);

			if ($_POST["dateRealisation"] != NULL) {
				$status = "Soldé";
				$this->postemodel->updateActionPoste($_POST["id_action"], $_POST["references"], $_POST["typeEcart"], $_POST["ecartConstate"], $_POST["analyse"], $_POST["actionCorrective"], $_POST["responsable"], $_POST["processus"], $_POST["dateRealisation"], $status);
			}elseif (strtotime(date('Y-m-d')) > strtotime($_POST["datePlan"])) {
				$status = "Retard";
				$this->postemodel->updateActionPoste($_POST["id_action"], $_POST["references"], $_POST["typeEcart"], $_POST["ecartConstate"], $_POST["analyse"], $_POST["actionCorrective"], $_POST["responsable"], $_POST["processus"], '', $status);
			}else{
			 	$status = "encours";
			 	$this->postemodel->updateActionPoste($_POST["id_action"], $_POST["references"], $_POST["typeEcart"], $_POST["ecartConstate"], $_POST["analyse"], $_POST["actionCorrective"], $_POST["responsable"], $_POST["processus"], '', $status);
			 }
			 $poste = $_POST["poste"];
			 $auditeur = $_POST["nom_auditeur"];

			 $statuss = $this->postemodel->getStatusAction($poste, $auditeur, $date);
				if (array_unique($statuss) === array('Soldé')) {
					$this->postemodel->updateStatus($poste, $date, "Soldé");
				}elseif(count($statuss) > 0) {
					$this->postemodel->updateStatus($poste, $date, "Réalisé");
				}elseif (strtotime(date('Y-m-d')) > strtotime($date)) {
					$this->postemodel->updateStatus($poste, $date, "Retard");	
				}else $this->postemodel->updateStatus($poste, $date, "encours");
					
			 header('location: ' . URL . 'audit_de_poste/plan_action/1');
		}else
		header('location: ' . URL . 'audit_de_poste/plan_action/1');
	}else header('location: ' . URL);
	}
	public function Statistique()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrPoste = "#162e45";
			header('Content-Type: text/html; charset=iso-8859-15');
			$utf = 'ok';
			$secteurs = $this->adminmodel->getAllSecteur();
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			error_reporting(0);
			require_once(APP .'libs/jpgraph/src/jpgraph.php');
			require_once (APP .'libs/jpgraph/src/jpgraph_pie.php');
			require_once (APP .'libs/jpgraph/src/jpgraph_bar.php');
			require_once (APP .'libs/jpgraph/src/jpgraph_pie3d.php');
			require APP . 'function/planning.php';
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			if (isset($_POST["month1"]) and isset($_POST["month2"]) and isset($_POST["secteur1"])) {
					error_reporting(0);	
					$month1 = explode('-', $_POST["month1"]);
					$month2 = explode('-', $_POST["month2"]);
					
					if (intval($month2[1])-intval($month1[1]) > 0) {
						$diff = intval($month2[1])-intval($month1[1]);
					}else $diff = intval($month2[1])-intval($month1[1])+12;
			        // for ($i=0; $i < 7; $i++) { 
			        //     $abs[$i] = 0;
			        //     $total[$i] = 0;
			        // }
					$realises = array();
					$retards = array();
					$encourss = array();
			        $soldes = array();
			        $ecarts = array();
					$total = array();
					$postes = $this->adminmodel->getPosteBySecteur($_POST["secteur1"]);
					foreach ($postes as $poste) {
						$realises = array_merge($realises, $this->postemodel->getAuditDataPoste("status", "Réalisé", $poste));
			       		$soldes = array_merge($soldes, $this->postemodel->getAuditDataPoste("status", "Soldé", $poste));
			       		$encourss = array_merge($encourss, $this->postemodel->getAuditDataPoste("status", "encours", $poste));
			       		$retards = array_merge($retards, $this->postemodel->getAuditDataPoste("status", "Retard", $poste));
					}
			        
			        for ($i=0; $i <= $diff; $i++) { 
			        	if ((intval($month1[1])+$i) <= 12) {
			        		$solde += getNbrOccurrenceMonth($soldes, $month1[0].'-'.(intval($month1[1])+$i));
					        $retard += getNbrOccurrenceMonth($retards, $month1[0].'-'.(intval($month1[1])+$i));
					        $encours += getNbrOccurrenceMonth($encourss, $month1[0].'-'.(intval($month1[1])+$i));
					        $realise += getNbrOccurrenceMonth($realises, $month1[0].'-'.(intval($month1[1])+$i));
			        	}else{
			        		$solde += getNbrOccurrenceMonth($soldes, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
					        $retard += getNbrOccurrenceMonth($retards, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
					        $encours += getNbrOccurrenceMonth($encourss, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
					        $realise += getNbrOccurrenceMonth($realises, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
			        	}
			        	
			        }

			        array_push($total, $solde, $retard, $realise, $encours);
			        // $total[0] = $solde;
			        // $total[1] = $retard;
			        // $total[2] = $realise;
			        // $total[3] = $encours;

			        $graph = new PieGraph(450,350);

					$theme_class="DefaultTheme";
					//$graph->SetTheme(new $theme_class());
					setlocale(LC_TIME, "fr_FR");
					// Set A title for the plot
					$graph->title->Set("Status des audits de poste pour la periode de ".strftime("%B", strtotime($_POST["month1"]))." à ".strftime("%B", strtotime($_POST["month2"])));
					$graph->subtitle->Set('Secteur '.$_POST["secteur1"]);
					$graph->SetBox(true);

					// Creates
					$p1 = new PiePlot3D($total);
					$graph->Add($p1);
					$legends = array('Soldé ('.$total[0].')', 'Retard ('.$total[1].')', 'Réalisé ('.$total[2].')', 'En cours ('.$total[3].')');
					$p1->ShowBorder();
					$p1->SetColor('black');
					$p1->SetSliceColors(array('#28a745','#dc3545','#90ee90','#007bff'));
					$p1->SetLegends($legends);
					$graph->legend->Pos(0.1,0.9,0,1);

			        if(file_exists("img/status_audit.png")) {
			            unlink("img/status_audit.png");
			            }
			        // Display the graphs
			        $graph->Stroke("img/status_audit.png");
				}
				if (isset($_POST["month3"]) and isset($_POST["month4"]) and isset($_POST["secteur2"])) {
					error_reporting(0);	
					$month3 = explode('-', $_POST["month3"]);
					$month4 = explode('-', $_POST["month4"]);
					
					if (intval($month4[1])-intval($month3[1]) > 0) {
						$diff = intval($month4[1])-intval($month3[1]);
					}else $diff = intval($month4[1])-intval($month3[1])+12;
			        // for ($i=0; $i < 7; $i++) { 
			        //     $abs[$i] = 0;
			        //     $total[$i] = 0;
			        // }
			        $realises = array();
			        $soldes = array();
			        $ecarts = array();
					$total = array();
					$postes = $this->adminmodel->getPosteBySecteur($_POST["secteur2"]);
					foreach ($postes as $poste) {
						$realises = array_merge($realises, $this->postemodel->getAuditDataPoste("status", "Réalisé", $poste));
			       		$soldes = array_merge($soldes, $this->postemodel->getAuditDataPoste("status", "Soldé", $poste));
			       		$ecarts = array_merge($ecarts, $this->postemodel->getAuditDataAction("poste", $poste));
					}
			        // $plannings = $this->postemodel->getAllPlanning();
			        for ($i=0; $i <= $diff; $i++) { 
			        	if ((intval($month1[1])+$i) <= 12) {
			        		$ecart += getNbrOccurrenceActionMonth($ecarts, $month3[0].'-'.(intval($month3[1])+$i));
			        		$solde += getNbrOccurrenceMonth($soldes, $month3[0].'-'.(intval($month3[1])+$i));
			        		$realise += getNbrOccurrenceMonth($realises, $month3[0].'-'.(intval($month3[1])+$i));
					        // $planning += getNbrOccurrenceMonth($plannings, $month3[0].'-'.(intval($month3[1])+$i));
			        	}else{
			        		$ecart += getNbrOccurrenceActionMonth($ecarts, (intval($month3[0])+1).'-'.(intval($month3[1])+$i-12));
			        		$solde += getNbrOccurrenceMonth($soldes, (intval($month3[0])+1).'-'.(intval($month3[1])+$i-12));
							$realise += getNbrOccurrenceMonth($realises, (intval($month3[0])+1).'-'.(intval($month3[1])+$i-12));
					        // $planning += getNbrOccurrenceMonth($plannings, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
			        	}
			        	
			        }
			        
			        array_push($total, $ecart, $solde+$realise);
					// Setup the graph. 
					$graph = new Graph(500,450);    
					$graph->SetScale("textlin");
					$graph->img->SetMargin(30,15,25,25);
					$graph->yaxis->SetTickPositions(array(0,4,8,12,16,20,24,28,32,36,40,44,48,52,56,60,64,68,72,76,80,84,88,92,96,100), array(2,6,10,14,18,22,26,30,34,38,42,46,50,54,58,62,66,70,74,78,82,86,90,94,98));
					$graph->title->Set("Nombre des audits et des écarts pour la periode de ".strftime("%B", strtotime($_POST["month3"]))." à ".strftime("%B", strtotime($_POST["month4"])));
					$graph->subtitle->Set('Secteur '.$_POST["secteur2"]);
					$graph->title->SetColor('#0888e3');
					 $graph->subtitle->SetColor('#0888e3');
					// Setup font for axis
					$graph->xaxis->SetFont(FF_FONT1);
					$graph->yaxis->SetFont(FF_FONT1);
					$graph->xaxis->SetTickLabels(array("Ecart (".$total[0].")", "Audit (".$total[1].")"));
					// Create the bar pot
					$bplot = new BarPlot($total);
					$bplot->SetWidth(0.6);
					 
					// Setup color for gradient fill style 
					$bplot->SetFillGradient('navy','#0888e3',GRAD_RAISED_PANEL);
					// $bplot->SetSliceColors(array('#e3e308','#0888e3'));
					// Set color for the frame of each bar
					$bplot->SetColor("navy");

					$graph->Add($bplot);

					if(file_exists("img/audit_ecart.png")) {
			            unlink("img/audit_ecart.png");
			            }
			        // Display the graphs
			        $graph->Stroke("img/audit_ecart.png");
				}
				// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_poste/statistique.php';
			        require APP . 'view/_templates/footer.php';

			        header("Cache-Control:no-cache");
			}else header('location: ' . URL);
		}
}
?>