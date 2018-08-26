<?php 

/**
* Gestion d'audit de processus
*/
class Audit_de_processus extends Controller
{
	public function index()
	{
		// load views
		require APP . 'view/_templates/header.php';
        require APP . 'view/audit_de_poste/ajouter_action_poste.php';
        require APP . 'view/_templates/footer.php';
	}
	public function Planning_processus()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	// error_reporting(E_ERROR | E_PARSE);
			header('Content-Type: text/html; charset=iso-8859-15');
			$clrProcessus = "#162e45";
			$utf = 'ok';
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			require APP . 'function/date.php';
			$produits = $this->processusmodel->getAllProduit();
			$processusss = $this->processusmodel->getAllProcess();
			$auditeurs = $this->postemodel->getAuditeurs();
			$plannings = $this->processusmodel->getAllPlanning();
			$planning = [];
			foreach ($plannings as $plan) {
				array_push($planning,$plan->processus."/".$plan->date_plan."/".$plan->status);
			}
			$allMonth = array();
			for ($i=0; $i < 3 ; $i++) { 
				$allMonth = array_merge($allMonth, allMonthOfYear(date('Y', strtotime('+'.$i.' year'))));
			}
			$TotalRecord = $this->produitmodel->getTotalRecordProduit();

			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_processus/planning_processus.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function planifier_audit_processus()
	{
		session_start();
        if (isset($_SESSION["username"])) {
			$this->processusmodel->deletePlanningNoStatus();
			$TotalRecord = $this->produitmodel->getTotalRecordProduit();
			$Produits = $this->processusmodel->getAllProduit();
			require APP . 'function/date.php';
			$allMonth = array();
			for ($i=0; $i < 3 ; $i++) { 
				$allMonth = array_merge($allMonth, allMonthOfYear(date('Y', strtotime('+'.$i.' year'))));
			}
			$i=0;
			foreach ($Produits as $produit) {
				$this->processusmodel->setPlanning($produit->nom_reference, $allMonth[$i], $produit->criticite_processus);
				$i=$i+2;
				if ($i==count($allMonth) OR $i==count($allMonth)) {
					$i=1;
				}
			}
			header('location: ' . URL . 'audit_de_processus/planning_processus');
		}else header('location: ' . URL);
	}
	public function affecter_processus($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
			if (isset($_POST["processus"])) {
				$id_proc = $id;
				$this->processusmodel->affecterProcessus($id_proc, $_POST["processus"]);
				header('location: ' . URL . 'audit_de_processus/planning_processus');
			}
		}else header('location: ' . URL);

	}
	public function affecter_auditeur($date)
	{
		session_start();
        if (isset($_SESSION["username"])) {
			if (isset($_POST["Auditeurr"])) {
				$this->processusmodel->affecterAuditeur($_POST["process"], $date, $_POST["Auditeurr"]);
				header('location: ' . URL . 'audit_de_processus/planning_processus');
			}
		}else header('location: ' . URL);

	}
	public function Ajouter_action()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProcessus = "#162e45";
        	$utf = 'ok';
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			$auditeurs = $this->postemodel->getAuditeurs();
			$references = $this->adminmodel->getAllReference();
			$secteurs = $this->adminmodel->getAllSecteur();
			$procs = $this->adminmodel->getAllProcessus();
			if (isset($_POST["actionCorrective"])) {
	        	$success = "bg-success text-white";
	        }
	        if (isset($_POST["nomAuditeur"])) {
	        	$x = explode('-', $_POST["moisAudit"]);
	        	$mois = strftime("%B", strtotime($_POST["moisAudit"])).' '.$x[0];
	        	$m = $_POST["moisAudit"];
	        	$nomAuditeur = $_POST["nomAuditeur"];
	        	$nomProduit = $_POST["nomProduit"];
	        	$nomProcessus = $_POST["nomProcessus"];
	        	$cotation = $_POST["cotation"];
	        	// load views
		        require APP . 'view/_templates/header.php';
		        require APP . 'view/audit_de_processus/ajouter_action_processus.php';
		        require APP . 'view/_templates/footer.php';
	        }else header('location: ' . URL . 'audit_de_processus/planning_processus');
        }else header('location: ' . URL);		   
	}
	public function modifier_action($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProcessus = "#162e45";
        	$utf = 'ok';
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			$auditeurs = $this->postemodel->getAuditeurs();
			$references = $this->adminmodel->getAllReference();
			$secteurs = $this->adminmodel->getAllSecteur();
			$procs = $this->adminmodel->getAllProcessus();
			$idAction = $id;
			$actions = $this->processusmodel->getActionById($id);
			foreach ($actions as $action) {
				$mois = $action["mois_audit"];
				$datePlan = $action["date_audit"];
				$nomProcessus = $action["processus"];
				$nomAuditeur = $action["auditeur"];
				$nomSecteur = $action["secteur"];
				$type6m = $action["type6m"];
				$question = $action["question"];
				$critere = $action["critere"];
				$nomProduit = $action["reference"];
				$ecartConstate = $action["ecart_constate"];
				$cotation = $action["cotation"];
				$actionImmediate = $action["action_immediate"];
				$delai = $action["delai"];
				$analyse = $action["analyse"];
				$actionCorrective = $action["action_corrective"];
				$pilote = $action["pilote"];
				$process = $action["process"];
				$delaiAction = $action["delai_action"];
				$dateRealisation = $action["date_realisation"];
			}
			if (isset($_POST["actionCorrective"])) {
	        	$success = "bg-success text-white";
	        }
	        
        	
        	// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_processus/modifier_action_processus.php';
	        require APP . 'view/_templates/footer.php';
	        
        }else header('location: ' . URL);		   
	}
	public function ajouter_action_processus()
	{
		session_start();
        if (isset($_SESSION["username"])) {
			require APP . 'function/planning.php';
			$references = $this->adminmodel->getAllReference();
			$secteurs = $this->adminmodel->getAllSecteur();
			if (isset($_POST["datePlan"]) and isset($_POST["nom_auditeur"]) and isset($_POST["secteur"]) and isset($_POST["nom_processus"]) and isset($_POST["type6m"]) and isset($_POST["question"]) and isset($_POST["critere"]) and isset($_POST["reference"]) and isset($_POST["ecartConstate"]) and isset($_POST["cotation"]) and isset($_POST["actionImmediate"]) and isset($_POST["delai"]) and isset($_POST["actionCorrective"]) and isset($_POST["pilote"]) and isset($_POST["delaiAction"])) {
				$dt = explode('-', $_POST["datePlan"]);
				$date = $dt[0].'-'.intval($dt[1]);
				$w = explode('-', $_POST["delaiAction"]);
				if ($_POST["dateRealisation"] == NULL) {
					if ($w[1] >= "W".date("W")) {
						$etat = "planifier";
					}else $etat = "retard";
				}else $etat = "solde";
				$this->processusmodel->setProcessusAction($_POST["moisAudit"], $_POST["datePlan"], $_POST["nom_processus"], $_POST["nom_auditeur"], $_POST["secteur"], $_POST["type6m"], $_POST["question"], $_POST["critere"], $_POST["reference"], $_POST["ecartConstate"], $_POST["cotation"], $_POST["actionImmediate"], $_POST["delai"], $_POST["analyse"], $_POST["actionCorrective"], $_POST["pilote"], $_POST["process"], $_POST["delaiAction"], $_POST["dateRealisation"], $etat);
				
				 header('location: ' . URL . 'audit_de_processus/planning_processus');
			}else header('location: ' . URL . 'audit_de_processus/planning_processus');
		}else header('location: ' . URL);
	}
	public function modifier_action_processus()
	{
		session_start();
        if (isset($_SESSION["username"])) {
			require APP . 'function/planning.php';
			$references = $this->adminmodel->getAllReference();
			$secteurs = $this->adminmodel->getAllSecteur();
			if (isset($_POST["datePlan"]) and isset($_POST["nom_auditeur"]) and isset($_POST["secteur"]) and isset($_POST["nom_processus"]) and isset($_POST["type6m"]) and isset($_POST["question"]) and isset($_POST["critere"]) and isset($_POST["reference"]) and isset($_POST["ecartConstate"]) and isset($_POST["cotation"]) and isset($_POST["actionImmediate"]) and isset($_POST["delai"]) and isset($_POST["actionCorrective"]) and isset($_POST["pilote"]) and isset($_POST["delaiAction"])) {
				$dt = explode('-', $_POST["datePlan"]);
				$date = $dt[0].'-'.intval($dt[1]);
				$w = explode('-', $_POST["delaiAction"]);
				if ($_POST["dateRealisation"] == NULL) {
					if ($w[1] >= "W".date("W")) {
						$etat = "planifier";
					}else $etat = "retard";
				}else $etat = "solde";
				$this->processusmodel->updateProcessusAction($_POST["id_action"], $_POST["moisAudit"], $_POST["datePlan"], $_POST["nom_processus"], $_POST["nom_auditeur"], $_POST["secteur"], $_POST["type6m"], $_POST["question"], $_POST["critere"], $_POST["reference"], $_POST["ecartConstate"], $_POST["cotation"], $_POST["actionImmediate"], $_POST["delai"], $_POST["analyse"], $_POST["actionCorrective"], $_POST["pilote"], $_POST["process"], $_POST["delaiAction"], $_POST["dateRealisation"], $etat);
				
				header('location: ' . URL . 'audit_de_processus/plan_action/1');
			}else header('location: ' . URL . 'audit_de_processus/planning_processus');

		}else header('location: ' . URL);
	}
	public function ajouter_information_audit($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProcessus = "#162e45";
        	$utf = 'ok';
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			$commentaire = "Merci de remplir tous les champs";
			$processuss = $this->processusmodel->getAuditProcessus($id);
			foreach ($processuss as $process) {
				$ic = $process["ic"];
				$status = $process["status"];
				$date_suivi = $process["date_suivi"];
				$date_plan = $process["date_plan"];
				$Auditeur = $process["auditeur"];
				$processus = $process["processus"];
				$cotation = $process["cotation"];
				$produit = $process["produit"];
				$date_replanification = $process["date_replanification"];
			}
			$dp = explode('-', $date_plan);
			$min = $dp[0].'-'.sprintf('%02s', $dp[1]+1).'-01';
			$max = $dp[0].'-'.sprintf('%02s', $dp[1]+1).'-'.sprintf('%02s', cal_days_in_month(CAL_GREGORIAN, $dp[1]+1, $dp[0]));
			$datePlan = $dp[0].'-'.($dp[1]+1);
	        	// load views
		        require APP . 'view/_templates/header.php';
		        require APP . 'view/audit_de_processus/ajouter_information_audit.php';
		        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);		   
	}
	public function update_information_audit($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
			if (isset($_POST["ic"])) {
				$id_proc = $id;
				if ($_POST["status"] == "non qualifie") {
					$this->processusmodel->setPlanningSuivi($_POST["produit"], $_POST["processus"], $_POST["datePlan"], $_POST["Auditeur"], $_POST["cotation"]);
					$this->processusmodel->updateInformationAuditRetard($id, $_POST["ic"], $_POST["dateSuivi"], $_POST["status"]);
				}elseif ($_POST["status"] == "non realiser") {
					$d = explode('-', $_POST["dateRep"]);
					$date = $d[0].'-'.intval($d[1]);
					echo "string1";
					$this->processusmodel->updateInformationAuditReplan($id, $_POST["ic"], $_POST["dateRep"], $_POST["status"]);
					$this->processusmodel->deletePlanning($_POST["processus"], $_POST["produit"], $_POST["datePlan"]);
					echo "string2";
					$this->processusmodel->setPlanningSuivi($_POST["produit"], $_POST["processus"], $date, $_POST["Auditeur"], $_POST["cotation"]);
					
					
				}else{$this->processusmodel->updateInformationAudit($id, $_POST["ic"], $_POST["status"]);} 

				
				header('location: ' . URL . 'audit_de_processus/planning_processus');
			}else header('location: ' . URL . 'audit_de_processus/planning_processus');
		}else header('location: ' . URL);

	}
	public function recherche_action()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProcessus = "#162e45";
			if (isset($_POST["recherche"])) {
				$actions = $this->processusmodel->rechercheAction($_POST["recherche"]);
				if($this->processusmodel->rechercheAction($_POST["recherche"])){
					$success = "bg-success text-white";
					$commentaire = "La liste des actions disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_processus/plan_action.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Action non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_processus/plan_action.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}
	public function Plan_action($id_page)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProcessus = "#162e45";
			if (isset($id_page)) { $page  = $id_page; } else { $page=1; };
			$results_per_page = 32;
	    	$start_from = ($page-1) * $results_per_page;
			$actions = $this->adminmodel->getDisplayPage("action_audit_processus", "date_audit", $start_from, $results_per_page);
			$total = $this->adminmodel->getTotalRecord("id_action", "action_audit_processus");
			$total_pages = ceil($total/$results_per_page);
			$commentaire = "";
			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_processus/plan_action.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function supprimer_action($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProcessus = "#162e45";
			if (isset($id)) {

				$this->processusmodel->deleteAction($id);
				$success = "bg-success text-white";
				$commentaire = "L'Action a été supprimer";
				header('location: ' . URL . 'audit_de_processus/plan_action/1');
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			// header('location: ' . URL . 'administration/gestion_secteur');
			$actions = $this->processusmodel->getAllAction();
			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_processus/plan_action.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function select_action($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProcessus = "#162e45";
			header("Cache-Control:no-cache");
			if (isset($id)) {
				$test = $this->processusmodel->getAuditById($id);
				foreach ($test as $t) {
					$date = $t->date_plan;
					$processus = $t->processus;
				}
				$actions = $this->processusmodel->selectAction($processus, $date);
				if($this->processusmodel->selectAction($processus, $date)){
					$success = "bg-success text-white";
					$commentaire = "La liste des actions disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_processus/plan_action.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Action non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/audit_de_processus/plan_action.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}
	public function Statistique()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProcessus = "#162e45";
			header('Content-Type: text/html; charset=iso-8859-15');
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			error_reporting(0);
			require_once(APP .'libs/jpgraph/src/jpgraph.php');
			require_once (APP .'libs/jpgraph/src/jpgraph_bar.php');
			require_once (APP .'libs/jpgraph/src/jpgraph_pie.php');
			require_once (APP .'libs/jpgraph/src/jpgraph_pie3d.php');
			require APP . 'function/planning.php';

			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");

			$processusss = $this->processusmodel->getAllProcessus();
			if (isset($_POST["month1"]) and isset($_POST["month2"])) {

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
				$nqualifies = array();
				$encourss = array();
		        $qualifies = array();
		        $nrealisers = array();
				$total = array();

				$nqualifie = array();
				$encours = array();
		        $qualifie = array();
		        $nrealiser = array();
		        for ($i=0; $i <= $diff; $i++) { 
		        	$qualifie[$i] = 0;
		        	$nqualifie[$i] = 0;
		        	$nrealiser[$i] = 0;
		        	$encours[$i] = 0;
		        }

	       		$qualifies = array_merge($qualifies, $this->processusmodel->getAuditDataProcessus("status", "qualifie"));
	       		$encourss = array_merge($encourss, $this->processusmodel->getAuditDataProcessus("status", "encours"));
	       		$nqualifies = array_merge($nqualifies, $this->processusmodel->getAuditDataProcessus("status", "non qualifie"));
	       		$nrealisers = array_merge($nrealisers, $this->processusmodel->getAuditDataProcessus("status", "non realiser"));
		        
		        
		        for ($i=0; $i <= $diff; $i++) { 
		        	if ((intval($month1[1])+$i) <= 12) {
		        		$nqualifie[$i] += getNbrOccurrenceMonthProcess($nqualifies, $month1[0].'-'.(intval($month1[1])+$i));
				        $qualifie[$i] += getNbrOccurrenceMonthProcess($qualifies, $month1[0].'-'.(intval($month1[1])+$i));
				        $nrealiser[$i] += getNbrOccurrenceMonthProcess($nrealisers, $month1[0].'-'.(intval($month1[1])+$i));
				        $encours[$i] += getNbrOccurrenceMonthProcess($encourss, $month1[0].'-'.(intval($month1[1])+$i));
				        $total[$i] = strftime("%B", strtotime($month1[0].'-'.sprintf("%02s", intval($month1[1])+$i)));
				        
		        	}else{
		        		$nqualifie[$i] += getNbrOccurrenceMonthProcess($nqualifies, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
				        $qualifie[$i] += getNbrOccurrenceMonthProcess($qualifies, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
				        $nrealiser[$i] += getNbrOccurrenceMonthProcess($nrealisers, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
				        $encours[$i] += getNbrOccurrenceMonthProcess($encourss, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
				        $total[$i] =strftime("%B", strtotime($month1[0].'-'.sprintf("%02s", intval($month1[1])+$i-12)));
				        
		        	}
		        	
		        }
		        // for ($i=0; $i <= $diff; $i++) { 
		        // 	if ((intval($month1[1])+$i) <= 12) {
		        // 		$total[$i] = strftime("%B", strtotime(sprintf("%02s", intval($month1[1])+$i)));
		        // 	}else{
		        // 		$total[$i] = strftime("%B", strtotime(sprintf("%02s", intval($month1[1])+$i-12)));
		        // 	}
		        // }

		        // array_push($total, $solde, $replanifier, $encours);

			// Create the graph. These two calls are always required
			$graph = new Graph(700,600,'auto');
			$graph->SetScale("textlin");

			$theme_class=new UniversalTheme;
			$graph->SetTheme($theme_class);

			$graph->yaxis->SetTickPositions(array(0,1), array(0.5));
			$graph->SetBox(false);

			$graph->ygrid->SetFill(false);
			$graph->xaxis->SetTickLabels($total);
			$graph->yaxis->HideLine(false);
			$graph->yaxis->HideTicks(false,false);

			// Create the bar plots
			$b1plot = new BarPlot($nqualifie);
			$b2plot = new BarPlot($qualifie);
			$b3plot = new BarPlot($nrealiser);
			$b4plot = new BarPlot($encours);

			// Create the grouped bar plot
			$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot,$b4plot));
			// ...and add it to the graPH
			$graph->Add($gbplot);

			$b1plot->SetColor("white");
			$b1plot->SetFillColor("#FF8800");

			$b2plot->SetColor("white");
			$b2plot->SetFillColor("#28a745");

			$b3plot->SetColor("white");
			$b3plot->SetFillColor("#dc3545");

			$b4plot->SetColor("white");
			$b4plot->SetFillColor("#306598");

			$b2plot->SetColor("#28a745");
			$b2plot->SetFillColor("#28a745");
			$b2plot->SetLegend("Soldé (".array_sum($qualifie).")");

			$b3plot->SetColor("#dc3545");
			$b3plot->SetFillColor("#dc3545");
			$b3plot->SetLegend("Non Realisé (".array_sum($nrealiser).")");


			$b4plot->SetColor("#306598");
			$b4plot->SetFillColor("#306598");
			$b4plot->SetLegend("Encours (".array_sum($encours).")");

			$b1plot->SetColor("#FF8800");
			$b1plot->SetFillColor("#FF8800");
			$b1plot->SetLegend("Non Qualifier (".array_sum($nqualifie).")");

			$graph->legend->SetFrameWeight(9);
			$graph->legend->SetColumns(16);
			$graph->legend->SetColor('#4E4E4E','#00A78A');
			$graph->SetMargin(40,20,46,130);


			$graph->title->Set("Taux de respect de planning Processus pour la periode de ".strftime("%B", strtotime($_POST["month1"]))." à ".strftime("%B", strtotime($_POST["month2"])));
			
			if(file_exists("img/status_audit_processus.png")) {
	            unlink("img/status_audit_processus.png");
	            }
	        // Display the graphs
	        $graph->Stroke("img/status_audit_processus.png");


			}
			if (isset($_POST["month3"]) and isset($_POST["month4"]) and isset($_POST["processus"])) {
					error_reporting(0);	
					$month1 = explode('-', $_POST["month3"]);
					$month2 = explode('-', $_POST["month4"]);
					
					if (intval($month2[1])-intval($month1[1]) > 0) {
						$diff = intval($month2[1])-intval($month1[1]);
					}else $diff = intval($month2[1])-intval($month1[1])+12;
			        // for ($i=0; $i < 7; $i++) { 
			        //     $abs[$i] = 0;
			        //     $total[$i] = 0;
			        // }
					$planifiers = array();
					$retards = array();
			        $soldes = array();
					$total = array();

					$solde = 0;
					$retard = 0;
			        $planifier = 0;
			        $process = $_POST["processus"];

						$planifiers = array_merge($planifiers, $this->processusmodel->getAuditDataAction("etat", "planifier", $process));
			       		$soldes = array_merge($soldes, $this->processusmodel->getAuditDataAction("etat", "solde", $process)) ;
			       		$retards = array_merge($retards, $this->processusmodel->getAuditDataAction("etat", "retard", $process));
			        
			        for ($i=0; $i <= $diff; $i++) { 
			        	if ((intval($month1[1])+$i) <= 12) {
			        		$solde += getNbrOccurrenceActionMonthProcess($soldes, $month1[0].'-'.(intval($month1[1])+$i));
					        $retard += getNbrOccurrenceActionMonthProcess($retards, $month1[0].'-'.(intval($month1[1])+$i));
					        $planifier += getNbrOccurrenceActionMonthProcess($planifiers, $month1[0].'-'.(intval($month1[1])+$i));
			        	}else{
			        		$solde += getNbrOccurrenceActionMonthProcess($soldes, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
					        $retard += getNbrOccurrenceActionMonthProcess($retards, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
					        $planifier += getNbrOccurrenceActionMonthProcess($planifiers, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
			        	}
			        	
			        }

			        array_push($total, $solde, $retard, $planifier);
			        // $total[0] = $solde;
			        // $total[1] = $retard;
			        // $total[2] = $realise;
			        // $total[3] = $encours;

			        $graph = new PieGraph(450,350);

					$theme_class="DefaultTheme";
					//$graph->SetTheme(new $theme_class());
					setlocale(LC_TIME, "fr_FR");
					// Set A title for the plot
					$graph->title->Set("Avancement du plan d'action pour la periode de ".strftime("%B", strtotime($_POST["month3"]))." à ".strftime("%B", strtotime($_POST["month4"])));
					$graph->subtitle->Set('Processus '.$_POST["processus"]);
					$graph->SetBox(true);
					echo "string";
					// Creates
					$p1 = new PiePlot3D($total);
					$graph->Add($p1);
					$legends = array('Soldé ('.$total[0].')', 'Retard ('.$total[1].')', 'Planifier ('.$total[2].')');
					$p1->ShowBorder();
					$p1->SetColor('black');
					$p1->SetSliceColors(array('#28a745','#dc3545','#ffc107'));
					$p1->SetLegends($legends);
					$graph->legend->Pos(0.19,0.9,0,1);

			        if(file_exists("img/status_action_processus.png")) {
			            unlink("img/status_action_processus.png");
			            }
			        // Display the graphs
			        $graph->Stroke("img/status_action_processus.png");
				}
			header("Cache-Control:no-cache");
			// load views
			require APP . 'view/_templates/header.php';
		    require APP . 'view/audit_de_processus/statistique.php';
		    require APP . 'view/_templates/footer.php';
		    
	    }else header('location: ' . URL);
	}
}
?>