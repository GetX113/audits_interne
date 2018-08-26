<?php 

/**
* Gestion d'audit de processus
*/
class Audit_de_produit extends Controller
{
	public function index()
	{
		session_start();
        if (isset($_SESSION["username"])) {
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_poste/ajouter_action_poste.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function Planning_produit()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			header('Content-Type: text/html; charset=iso-8859-15');
			$utf = 'ok';
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			require APP . 'function/date.php';
			$allMonth = allMonthOfYear(date('Y'));
			$TotalRecord = $this->produitmodel->getTotalRecordProduit();
			$Produits = $this->produitmodel->getAllProduit();
			$auditeurs = $this->postemodel->getAuditeurs();
			$plannings = $this->produitmodel->getAllPlanning();
			$planning = [];
			$clrProduit = "#162e45";
			foreach ($plannings as $plan) {
				array_push($planning,$plan->reference."/".$plan->date_planifier."/".$plan->status."");
			}
			// load views
	        require APP . 'view/_templates/header_defilement.php';
	        require APP . 'view/audit_de_produit/planning_produit.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function planifier_audit_produit()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			$this->produitmodel->deletePlanningNoStatus();
			$TotalRecord = $this->produitmodel->getTotalRecordProduit();
			$Produits = $this->produitmodel->getAllProduit();
			require APP . 'function/date.php';
			$allMonth = allMonthOfYear(date('Y'));
			$m=12;$i=ceil($TotalRecord/$m);$j=0;
			foreach ($Produits as $produit) {
				$status = $this->produitmodel->getStatusPlanning($produit->nom_reference, $allMonth[$j]);
				if (count($status) != 1) {
					$this->produitmodel->setPlanning($produit->nom_reference, $allMonth[$j]);
				}
				
				$i--;
				if ($i==0) {
					$TotalRecord -= ceil($TotalRecord/$m);
					$m--;
					$i=ceil($TotalRecord/$m);
					$j++;
				}
			}
			header('location: ' . URL . 'audit_de_produit/planning_produit');
		}else header('location: ' . URL);
	}
	public function affecter_auditeur($reference, $date)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			if (isset($_POST["nomAuditeur"])) {
				$this->produitmodel->affecterAuditeur($reference, $date, $_POST["nomAuditeur"]);
				header('location: ' . URL . 'audit_de_produit/planning_produit');
			}
		}else header('location: ' . URL);

	}
	public function ajouter_action_produit()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			require APP . 'function/planning.php';
			$references = $this->adminmodel->getAllReference();
			$secteurs = $this->adminmodel->getAllSecteur();
			if (isset($_POST["datePlan"]) and isset($_POST["nom_auditeur"]) and isset($_POST["secteur"]) and isset($_POST["produit"]) and isset($_POST["designation"]) and isset($_POST["ecartConstate"]) and isset($_POST["protectionClient"]) and isset($_POST["pilote_audit"]) and isset($_POST["analyseCauses"]) and isset($_POST["actionCorrective"]) and isset($_POST["pilote_action"])) {
				$dt = explode('-', $_POST["datePlan"]);
				$date = $dt[0].'-'.intval($dt[1]);
				if (!isset($_POST["validation"])) {
					$validation = 0;
				}else $validation = $_POST["validation"];
				if (!isset($_POST["realiser"])) {
					$realiser = 0;
				}else $realiser = $_POST["realiser"];
				if (!isset($_POST["conforme"])) {
					$non_conforme = 0;
				}else $non_conforme = $_POST["conforme"];

				if ($_POST["dateAction"] != NULL) {
					$status = 1;
				}else{
					$status = 0;
				}

				$this->produitmodel->setProduitAction($_POST["datePlan"], $_POST["nom_auditeur"], $_POST["produit"], $_POST["secteur"], $_POST["designation"], $_POST["ecartConstate"], $_POST["protectionClient"], $_POST["pilote_audit"], $validation, $_POST["analyseCauses"], $_POST["actionCorrective"], $_POST["pilote_action"], $_POST["dateAction"], $non_conforme, $realiser, $status);


				$id = $this->produitmodel->getAuditByProduit($_POST["produit"], $_POST["nom_auditeur"]);
				if ($non_conforme == 1) {
					$this->produitmodel->updateStatusAudit($id[0], "Replanifier");
				}else $this->produitmodel->updateStatusAudit($id[0], "Soldé");
				

				header('location: ' . URL . 'audit_de_produit/planning_produit');
			}
		}else header('location: ' . URL);
	}
	public function Ajouter_action()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			$auditeurs = $this->postemodel->getAuditeurs();
			$references = $this->adminmodel->getAllReference();
			$secteurs = $this->adminmodel->getAllSecteur();
			if (isset($_POST["actionCorrective"])) {
	        	$success = "bg-success text-white";
	        }
	        if (isset($_POST["nomAudit"])) {
	        	$nomAuditeur = $_POST["nomAudit"];
	        	$nom_produit = $_POST["nomProduit"];
	        	// load views
		        require APP . 'view/_templates/header.php';
		        require APP . 'view/audit_de_produit/ajouter_action_produit.php';
		        require APP . 'view/_templates/footer.php';
	        }else header('location: ' . URL . 'audit_de_produit/planning_produit');
        }else header('location: ' . URL);		   
	}
	public function recherche_action()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			if (isset($_POST["recherche"])) {
				$actions = $this->produitmodel->rechercheAction($_POST["recherche"]);
				if($this->produitmodel->rechercheAction($_POST["recherche"])){
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
	public function Plan_action($id_page)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			if (isset($id_page)) { $page  = $id_page; } else { $page=1; };
			$results_per_page = 32;
	    	$start_from = ($page-1) * $results_per_page;
			$actions = $this->adminmodel->getDisplayPage("action_audit_produit", "date_audit", $start_from, $results_per_page);
			$total = $this->adminmodel->getTotalRecord("id_action", "action_audit_produit");
			$total_pages = ceil($total/$results_per_page);
			$commentaire = "";
			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_produit/plan_action.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function action_liee()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			if (isset($_POST["nomAudit"])) {
				$actions = $this->produitmodel->selectAction($_POST["nomProduit"], $_POST["nomAudit"]);
				if ($this->produitmodel->selectAction($_POST["nomProduit"], $_POST["nomAudit"])) {
					$success = "bg-success text-white";
					$commentaire = "La liste des actions disponible";

				}else{
					$success = "bg-danger text-white";
					$commentaire = "Action non trouvable!";
				}
			}
			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_produit/plan_action.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function supprimer_action($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			if (isset($id)) {
				$actions = $this->produitmodel->getActionById($id);
				foreach ($actions as $action) {
					$produit = $action->produit;
					$date = $action->date_audit;
					$auditeur = $action->auditeur;
				}
				$dt = explode('-', $date);
				$date = $dt[0].'-'.intval($dt[1]);
				$ide = $this->produitmodel->getAuditByProduit($produit, $auditeur);
				$this->produitmodel->updateStatusAudit($ide[0], "");

				$this->produitmodel->deleteAction($id);
				$success = "bg-success text-white";
				$commentaire = "L'Action a été supprimer";
				header('location: ' . URL . 'audit_de_produit/plan_action/1');
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			// header('location: ' . URL . 'administration/gestion_secteur');
			$actions = $this->produitmodel->getAllAction();
			// load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_poste/plan_action.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function modifier_action_produit($id)
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			$references = $this->adminmodel->getAllReference();
			$secteurs = $this->adminmodel->getAllSecteur();
			if (isset($id)) {
				$actions = $this->produitmodel->getActionById($id);
				foreach ($actions as $action) {
					$dateAudit = $action->date_audit;
					$nomAuditeur = $action->auditeur;
					$secteur = $action->secteur;
					$produit = $action->produit;
					$designation = $action->designation;
					$ecartConstate = $action->ecart_constate;
					$protectionClient = $action->protection_client;
					$piloteAudit = $action->pilote_audit;
					$analyseCauses = $action->analyse_causes;
					$actionCorrective = $action->action_corrective;
					$piloteAction = $action->pilote_action;
					$auditDate = $action->audit_date;
					$id_action = $action->id_action;
					$validation = $action->validation_protection;
					$non_conforme = $action->non_conforme;
					$realiser = $action->realiser;
				}
				$commentaire = "L'Action a été supprimer";
			}else {
	            header('location: ' . URL . 'audit_de_produit/plan_action/1');
	        }
			
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/audit_de_produit/modifier_action_produit.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function update_action_produit()
	{
		session_start();
        if (isset($_SESSION["username"])) {
			if (isset($_POST["datePlan"]) and isset($_POST["nom_auditeur"]) and isset($_POST["secteur"]) and isset($_POST["produit"]) and isset($_POST["designation"]) and isset($_POST["ecartConstate"]) and isset($_POST["protectionClient"]) and isset($_POST["pilote_audit"]) and isset($_POST["analyseCauses"]) and isset($_POST["actionCorrective"]) and isset($_POST["pilote_action"])) {
				$dt = explode('-', $_POST["datePlan"]);
				$date = $dt[0].'-'.intval($dt[1]).'-'.intval($dt[2]);
				if (!isset($_POST["validation"])) {
					$validation = 0;
				}else $validation = $_POST["validation"];
				if (!isset($_POST["realiser"])) {
					$realiser = 0;
				}else $realiser = $_POST["realiser"];
				if (!isset($_POST["conforme"])) {
					$non_conforme = 0;
				}else $non_conforme = $_POST["conforme"];

				if ($_POST["dateAction"] != NULL) {
					$status = 1;
				}else{
					$status = 0;
				}

				$this->produitmodel->updateActionProduit($_POST["id_action"], $_POST["datePlan"], $_POST["nom_auditeur"], $_POST["secteur"], $_POST["produit"], $_POST["designation"], $_POST["ecartConstate"], $_POST["protectionClient"], $_POST["pilote_audit"], $_POST["analyseCauses"], $_POST["actionCorrective"], $_POST["pilote_action"], $_POST["dateAction"], $validation, $non_conforme, $realiser, $status);
				header('location: ' . URL . 'audit_de_produit/plan_action/1');
			}
		}else header('location: ' . URL);
	}
	public function Statistique()
	{
		session_start();
        if (isset($_SESSION["username"])) {
        	$clrProduit = "#162e45";
			header('Content-Type: text/html; charset=iso-8859-15');
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			error_reporting(0);
			require_once(APP .'libs/jpgraph/src/jpgraph.php');
			require_once (APP .'libs/jpgraph/src/jpgraph_bar.php');
			require APP . 'function/planning.php';

			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");

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
				$replanifiers = array();
				$encourss = array();
		        $soldes = array();
				$total = array();

				$replanifier = array();
				$encours = array();
		        $solde = array();
		        for ($i=0; $i <= $diff; $i++) { 
		        	$solde[$i] = 0;
		        	$replanifier[$i] = 0;
		        	$encours[$i] = 0;
		        }

	       		$soldes = array_merge($soldes, $this->produitmodel->getAuditDataProduit("status", "Soldé"));
	       		$encourss = array_merge($encourss, $this->produitmodel->getAuditDataProduit("status", "encours"));
	       		$replanifiers = array_merge($replanifiers, $this->produitmodel->getAuditDataProduit("status", "Replanifier"));
		        
		        
		        for ($i=0; $i <= $diff; $i++) { 
		        	if ((intval($month1[1])+$i) <= 12) {
		        		$solde[$i] += getNbrOccurrenceMonth($soldes, $month1[0].'-'.(intval($month1[1])+$i));
				        $replanifier[$i] += getNbrOccurrenceMonth($replanifiers, $month1[0].'-'.(intval($month1[1])+$i));
				        $encours[$i] += getNbrOccurrenceMonth($encourss, $month1[0].'-'.(intval($month1[1])+$i));
				        $total[$i] = strftime("%B", strtotime($month1[0].'-'.sprintf("%02s", intval($month1[1])+$i)));
				        
		        	}else{
		        		$solde[$i] += getNbrOccurrenceMonth($soldes, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
				        $replanifier[$i] += getNbrOccurrenceMonth($replanifiers, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
				        $encours[$i] += getNbrOccurrenceMonth($encourss, (intval($month1[0])+1).'-'.(intval($month1[1])+$i-12));
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

			$graph->yaxis->SetTickPositions(array(0,2,4,8,10,12,14,16,18,20,22,24,26,28,30), array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29));
			$graph->SetBox(false);

			$graph->ygrid->SetFill(false);
			$graph->xaxis->SetTickLabels($total);
			$graph->yaxis->HideLine(false);
			$graph->yaxis->HideTicks(false,false);

			// Create the bar plots
			$b1plot = new BarPlot($solde);
			$b2plot = new BarPlot($replanifier);
			$b3plot = new BarPlot($encours);

			// Create the grouped bar plot
			$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));
			// ...and add it to the graPH
			$graph->Add($gbplot);


			$b1plot->SetColor("white");
			$b1plot->SetFillColor("#28a745");

			$b2plot->SetColor("white");
			$b2plot->SetFillColor("#dc3545");

			$b3plot->SetColor("white");
			$b3plot->SetFillColor("#306598");

			$b1plot->SetColor("#28a745");
			$b1plot->SetFillColor("#28a745");
			$b1plot->SetLegend("Soldé (".array_sum($solde).")");

			$b2plot->SetColor("#dc3545");
			$b2plot->SetFillColor("#dc3545");
			$b2plot->SetLegend("Replanifier (".array_sum($replanifier).")");


			$b3plot->SetColor("#306598");
			$b3plot->SetFillColor("#306598");
			$b3plot->SetLegend("Encours (".array_sum($encours).")");

			$graph->legend->SetFrameWeight(9);
			$graph->legend->SetColumns(16);
			$graph->legend->SetColor('#4E4E4E','#00A78A');
			$graph->SetMargin(40,20,46,130);


			$graph->title->Set("État d'avencement des audits Produit pour la periode de ".strftime("%B", strtotime($_POST["month1"]))." à ".strftime("%B", strtotime($_POST["month2"])));
			
			if(file_exists("img/status_audit_produit.png")) {
	            unlink("img/status_audit_produit.png");
	            }
	        // Display the graphs
	        $graph->Stroke("img/status_audit_produit.png");


			}
			// load views
			require APP . 'view/_templates/header.php';
		    require APP . 'view/audit_de_produit/statistique.php';
		    require APP . 'view/_templates/footer.php';
		    header("Cache-Control:no-cache");
	    }else header('location: ' . URL);
	}
}
?>