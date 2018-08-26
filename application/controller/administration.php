<?php 
/**
* Gestion d'dministration
*/
class Administration extends Controller
{
	
	public function index()
	{	
		$clrAdmin = "#162e45";
		// load views
		require APP . 'view/_templates/header.php';
        require APP . 'view/administration/ajouter_secteur.php';
        require APP . 'view/_templates/footer.php';
	}
	public function modifier_password()
	{
		session_start();
        if (isset($_SESSION["fonction"])) {
        	$clrAdmin = "#162e45";
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/modifier_password.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);    
	}
	public function update_password()
	{
		session_start();
        if (isset($_SESSION["fonction"])) {
        	$clrAdmin = "#162e45";
        	if (isset($_POST["newPassword"])) {
        		$this->adminmodel->updatePassword($_SESSION["id"], md5($_POST["newPassword"]));
        		$commentaire = "Le mot de passe est modifier";
				$success = "bg-success text-white";
				// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/modifier_password.php';
		        require APP . 'view/_templates/footer.php';
        	}else{
        		$success = "bg-danger text-white";
				$commentaire = "Une erreur est survenue lors de la modification!";
				// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/modifier_password.php';
		        require APP . 'view/_templates/footer.php';
        	}
			
			
	    }else header('location: ' . URL);   
	}
	public function gestion_compte($id_page)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable") {
        	$clrAdmin = "#162e45";
			if (isset($id_page)) { $page  = $id_page; } else { $page=1; };
			$results_per_page = 32;
	    	$start_from = ($page-1) * $results_per_page;
			$comptes = $this->adminmodel->getDisplayPage("utilisateurs", "fonctionnalite", $start_from, $results_per_page);
			$commentaire = "";
			$total = $this->adminmodel->getTotalRecord("id", "utilisateurs");
			$total_pages = ceil($total/$results_per_page);
			// $secteurs = $this->adminmodel->getAllSecteur();
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_compte.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function Ajouter_compte()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable") {
        	$clrAdmin = "#162e45";
			$commentaire = "Merci de remplir tous les champs";
			if (isset($_POST["username"]) and isset($_POST["password"]) and isset($_POST["fonction"])) {
				$this->adminmodel->addCompte($_POST["nom"], $_POST["prenom"], $_POST["username"], md5($_POST["password"]), $_POST["fonction"]);
				$success = "bg-success text-white";
			}
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_compte.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);    
	}

	public function supprimer_compte($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable") {
        	$clrAdmin = "#162e45";
			if (isset($id)) {
				$this->adminmodel->deleteCompte($id);
				$success = "bg-success text-white";
				$commentaire = "Le compte a été supprimer";
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			// header('location: ' . URL . 'administration/gestion_secteur');
			$secteurs = $this->adminmodel->getAllAffiche();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_affiche.php';
		        require APP . 'view/_templates/footer.php';
		}else header('location: ' . URL);      
	}
	public function recherche_compte()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["recherche"])) {
				$comptes = $this->adminmodel->rechercheCompte($_POST["recherche"]);
				if($this->adminmodel->rechercheCompte($_POST["recherche"])){
					$success = "bg-success text-white";
					$commentaire = "La liste des comptes d'utilisateurs disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_compte.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Secteur non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_compte.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);		
	}
	public function gestion_affiche($id_page)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id_page)) { $page  = $id_page; } else { $page=1; };
			$results_per_page = 32;
	    	$start_from = ($page-1) * $results_per_page;
			$affiches = $this->adminmodel->getDisplayPage("affichage_accueil", "date_pub", $start_from, $results_per_page);
			$commentaire = "";
			$total = $this->adminmodel->getTotalRecord("id_affiche", "affichage_accueil");
			$total_pages = ceil($total/$results_per_page);
			// $secteurs = $this->adminmodel->getAllSecteur();
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_affiche.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function Ajouter_affiche()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_affiche.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function upload_affiche()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {	
        	$clrAdmin = "#162e45";
			if (isset($_POST["titre"])) {
				$target_dir = "img/affiches/";
				$target_file = $target_dir . basename($_FILES["picture"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if file already exists
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				// Check file size
				if ($_FILES["picture"]["size"] > 5000000) {
				    echo "Sorry, your file is too large.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					$success = "bg-danger text-white";
					$commentaire = "Sorry, your file was not uploaded.";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/ajouter_affiche.php';
			        require APP . 'view/_templates/footer.php';
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
				        echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
				        $this->adminmodel->addAffiche($target_file, $_POST["titre"], $_POST["commentaire"], date('Y-m-d'));
				        $success = "bg-success text-white";
						$commentaire = "Article ajouté avec succès";
						// load views
						require APP . 'view/_templates/header.php';
				        require APP . 'view/administration/ajouter_affiche.php';
				        require APP . 'view/_templates/footer.php';
				    } else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
			}
		}else header('location: ' . URL);
	}
	public function view_affiche($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$affiches = $this->adminmodel->getAfficheById($id);
			foreach ($affiches as $affiche) {
				$target = $affiche->target;
				$titre = $affiche->titre;
				$commentaire = $affiche->commentaire;
				$date = $affiche->date_pub;
			}
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/view_affiche.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function modifier_affiche($id_affiche)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id_affiche)) {
				$affiches = $this->adminmodel->getAfficheById($id_affiche);
				foreach ($affiches as $affiche) {
					$target = $affiche->target;
					$titre = $affiche->titre;
					$commentaire = "";
					$commentairee = $affiche->commentaire;
					$id_affiche = $id_affiche;
				}
			}else {
	            header('location: ' . URL . 'administration/ajouter_affiche');
	        }
			
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/modifier_affiche.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function update_affiche()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["titre"]) and isset($_POST["commentaire"])) {
				$this->adminmodel->updateAffiche($_POST["titre"], $_POST["commentaire"], $_POST["id_affiche"]);
			
				$success = "bg-success text-white";
				$commentaire = "L'affiche' a été mise à jour";
				
			}else{
				$success = "bg-danger text-white";
				$commentaire = "Entrer des informations valide!";
			}
			$affiches = $this->adminmodel->getAllAffiche();
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_affiche.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	
	public function supprimer_affiche($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id)) {
				$this->adminmodel->deleteAffiche($id);
				$success = "bg-success text-white";
				$commentaire = "L'affiche a été supprimer";
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			// header('location: ' . URL . 'administration/gestion_secteur');
			$secteurs = $this->adminmodel->getAllAffiche();
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_affiche.php';
	        require APP . 'view/_templates/footer.php';
		}else header('location: ' . URL);
	}
	public function recherche_affiche()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["recherche"])) {
				$affiches = $this->adminmodel->rechercheAffiche($_POST["recherche"]);
				if($this->adminmodel->rechercheAffiche($_POST["recherche"])){
					$success = "bg-success text-white";
					$commentaire = "La liste des affiches disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_affiche.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Affiche non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_affiches.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}
	public function gestion_secteur($id_page)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id_page)) { $page  = $id_page; } else { $page=1; };
			$results_per_page = 32;
	    	$start_from = ($page-1) * $results_per_page;
			$secteurs = $this->adminmodel->getDisplayPage("secteur", "nom_secteur", $start_from, $results_per_page);
			$commentaire = "";
			$total = $this->adminmodel->getTotalRecord("id_secteur", "secteur");
			$total_pages = ceil($total/$results_per_page);
			// $secteurs = $this->adminmodel->getAllSecteur();
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_secteur.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function recherche_secteur()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["recherche"])) {
				$secteurs = $this->adminmodel->rechercheSecteur($_POST["recherche"]);
				if($this->adminmodel->rechercheSecteur($_POST["recherche"])){
					$success = "bg-success text-white";
					$commentaire = "La liste des secteurs disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_secteur.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Secteur non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_secteur.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}
	public function Ajouter_secteur()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			require APP . 'function/date.php';
			$works = [];
			for ($i=1; $i <= 12; $i++) { 
				$works = array_merge($works, getWorkDays($i));
			}
			
			
			if (isset($_POST["nomSecteur"]) and isset($_POST["nomResponsable"])) {
				$this->adminmodel->addSecteur($_POST["nomSecteur"], $_POST["nomResponsable"]);
				$success = "bg-success text-white";
			}
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_secteur.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function modifier_secteur($id_poste)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id_poste)) {
				$secteurs = $this->adminmodel->getSecteurById($id_poste);
				foreach ($secteurs as $secteur) {
					$nomSecteur = $secteur->nom_secteur;
					$nomResponsable = $secteur->nom_responsable;
					$idSecteur = $secteur->id_secteur;
				}
			}else {
	            header('location: ' . URL . 'administration/Ajouter_reference');
	        }
			
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/modifier_secteur.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);    
	}
	public function update_secteur()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["nomSecteur"]) and isset($_POST["nomResponsable"]) and isset($_POST["idSecteur"])) {
				$this->adminmodel->updateSecteur($_POST["nomSecteur"], $_POST["nomResponsable"], $_POST["idSecteur"]);
			
				$success = "bg-success text-white";
				$commentaire = "Le secteur a été mise à jour";
				
			}else{
				$success = "bg-danger text-white";
				$commentaire = "Entrer des informatios valide!";
			}
			$secteurs = $this->adminmodel->getAllSecteur();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_secteur.php';
		        require APP . 'view/_templates/footer.php';
		}else header('location: ' . URL);        
	}
	public function supprimer_secteur($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id)) {
				$this->adminmodel->deleteSecteur($id);
				$success = "bg-success text-white";
				$commentaire = "Le secteur a été supprimer";
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			// header('location: ' . URL . 'administration/gestion_secteur');
			$secteurs = $this->adminmodel->getAllSecteur();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_secteur.php';
		        require APP . 'view/_templates/footer.php';
		}else header('location: ' . URL);
	}

	public function gestion_poste($id_page)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id_page)) { $page  = $id_page; } else { $page=1; };
			$results_per_page = 32;
	    	$start_from = ($page-1) * $results_per_page;
			$postes = $this->adminmodel->getDisplayPage("poste", "secteur", $start_from, $results_per_page);
			$commentaire = "";
			$total = $this->adminmodel->getTotalRecord("id_poste", "poste");
			$total_pages = ceil($total/$results_per_page);
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_poste.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function Ajouter_poste()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$secteurs = $this->adminmodel->getAllSecteur();
			if (isset($_POST["nomPoste"]) and isset($_POST["secteur"]) and isset($_POST["dateAudit"])) {
				$this->adminmodel->addPoste($_POST["nomPoste"], $_POST["secteur"], $_POST["dateAudit"]);
				$success = "bg-success text-white";
			}
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_poste.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);    
	}
	public function modifier_poste($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$secteurs = $this->adminmodel->getAllSecteur();
			if (isset($id)) {
				$postes = $this->adminmodel->getPosteById($id);
				foreach ($postes as $poste) {
					$nomPoste = $poste->nom_poste;
					$secteure = $poste->secteur;
					$id = $poste->id_poste;
					$premiereDate = $poste->premiere_date;
				}
			}else {
	            header('location: ' . URL . 'administration/Ajouter_poste');
	        }
			
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_poste.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function update_poste()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["nomPoste"]) and isset($_POST["secteur"]) and isset($_POST["id"])) {
				$this->adminmodel->updatePoste($_POST["nomPoste"], $_POST["secteur"], $_POST["dateAudit"], $_POST["id"]);
			
				$success = "bg-success text-white";
				$commentaire = "Le poste a été mise à jour";
				
			}else{
				$success = "bg-danger text-white";
				$commentaire = "Entrer des informations valide!";
			}
			$postes = $this->adminmodel->getAllPoste();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_poste.php';
		        require APP . 'view/_templates/footer.php';
		}else header('location: ' . URL);
	}
	public function supprimer_poste($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id)) {
				$this->adminmodel->deletePoste($id);
				$success = "bg-success text-white";
				$commentaire = "Le poste a été supprimer";
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			// header('location: ' . URL . 'administration/gestion_secteur');
			$postes = $this->adminmodel->getAllPoste();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_poste.php';
		        require APP . 'view/_templates/footer.php';
		}else header('location: ' . URL);        
	}
	public function gestion_references($id_page)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id_page)) { $page  = $id_page; } else { $page=1; };
			$results_per_page = 32;
	    	$start_from = ($page-1) * $results_per_page;
			$references = $this->adminmodel->getDisplayPage("referencess", "poste", $start_from, $results_per_page);
			$commentaire = "";
			$total = $this->adminmodel->getTotalRecord("id_ref", "referencess");
			$total_pages = ceil($total/$results_per_page);
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_reference.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);    
	}	

	public function gestion_reference()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$references = $this->adminmodel->getAllReference();
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_reference.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);    
	}
	public function recherche_reference()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["recherche"])) {
				$references = $this->adminmodel->rechercheReference($_POST["recherche"]);
				if($this->adminmodel->rechercheReference($_POST["recherche"])){
					$success = "bg-success text-white";
					$commentaire = "La liste des références disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_reference.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Référence non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_reference.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}
	public function Ajouter_reference()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$commentaire = "Veuillez remplir tous les champs !";
			$postes = $this->adminmodel->getAllPoste();
			if (!isset($_POST["sr"])) {
					$sr = 1;
				}else $sr = $_POST["sr"];
			if (!isset($_POST["ppm"])) {
				$ppm = 1;
			}else $ppm = $_POST["ppm"];
			if (!isset($_POST["top50"])) {
				$top50 = 1;
			}else $top50 = $_POST["top50"];
			if (!isset($_POST["modifProc"])) {
				$modifProc = 1;
			}else $modifProc = $_POST["modifProc"];

			if (isset($_POST["nomReference"]) and isset($_POST["numMaquette"]) and isset($_POST["designation"])) {
				$references = $this->adminmodel->getReferences($_POST["nomReference"], $_POST["posteDemarrage"]);
				foreach ($references as $reference) {
					$nom_reference = $reference->nom_reference;
					$posteDemarrage = $reference->poste;
					$idReference = $reference->id_ref;
				}
				echo $idReference;
				if (!isset($idReference)) {

					// Adaptation des inputs avec les régles de criticité
					
					if ($_POST["nbrNC"] >= 2) {
						$ncProc = 9;
					}elseif ($_POST["nbrNC"] == 1) {
						$ncProc = 3;
					}else $ncProc = 1;
					
					$criticite_postee = $this->adminmodel->getCriticitePoste($_POST["posteDemarrage"]);
					foreach ($criticite_postee as $criticite_poste) {
						if ($criticite_poste->criticite_poste >= 24) {
							$criticite_equipement = 9;
						}elseif ($criticite_poste->criticite_poste < 12) {
							$criticite_equipement = 1;
						}elseif (12 <= $criticite_poste->criticite_poste and $criticite_poste->criticite_poste < 24) {
							 $criticite_equipement = 3;
						}
					}
					
					if ($_POST["dureeDemarrage"] == "projet") {
						$demarrage = 9;
					}elseif ($_POST["dureeDemarrage"] == "serie") {
						$demarrage = 3;
					}else $demarrage = 1;
					//Calcule de la criticite Processus
					$criticite_processus = $criticite_equipement*$sr*$ncProc*$demarrage*$ppm*$modifProc;

					if ($_POST["nbrNC"] > 0) {
						$nc = 3;
					}else $nc = 1;
					//Calcule de la criticite Produit.
					$criticite_produit = $nc*$top50*$sr;
					

					// Ajouter la reference au BDD
					$this->adminmodel->addReference($_POST["nomReference"], $_POST["posteDemarrage"], $_POST["nbrNC"], $sr, $modifProc, $_POST["dureeDemarrage"], $top50, $ppm, $_POST["designation"], $criticite_produit, $criticite_processus, $_POST["numMaquette"]);
					$success = "bg-success text-white";
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Référence existante !";
				}
			}

			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_reference.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);
	}
	public function modifier_reference($id_reference)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$commentaire = "Veuillez remplir tous les champs !";
			$postes = $this->adminmodel->getAllPoste();
			if (isset($id_reference)) {
				$references = $this->adminmodel->getReferenceById($id_reference);
				foreach ($references as $reference) {
					$nomReference = $reference->nom_reference;
					$posteDemarrage = $reference->poste;
					$nbrNC = $reference->nbr_nc;
					$sr = $reference->sr;
					$dureeDemarrage = $reference->duree_demarrage;
					$top50 = $reference->top50;
					$ppm = $reference->ppm;
					$designation = $reference->designation;
					$numMaquette = $reference->num_maq;
					$modifProc = $reference->modif_proc;
				}
			}else {
	            header('location: ' . URL . 'administration/gestion_reference/1');
	        }
			
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/modifier_reference.php';
	        require APP . 'view/_templates/footer.php';
	    }else header('location: ' . URL);    
	}
	public function supprimer_reference($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id)) {
				$this->adminmodel->deleteReference($id);
				$success = "bg-success text-white";
				$commentaire = "La référence a été supprimer";
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			// header('location: ' . URL . 'administration/gestion_secteur');
			$references = $this->adminmodel->getAllReference();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_reference.php';
		        require APP . 'view/_templates/footer.php';
		}else header('location: ' . URL);
	} 

	public function update_criticite_postes()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$postes = $this->adminmodel->getAllPoste();
			foreach ($postes as $poste) {
				$srC = 1;
				$ncC = 0;
				$dureeDemarrageC = 1;
				$modifProcC = 0;
				$references = $this->adminmodel->getReferenceByPoste($poste->nom_poste);
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
			header('location: ' . URL . 'administration/gestion_poste/1');
		}else header('location: ' . URL);
	}
	public function update_criticite_references()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$references = $this->adminmodel->getAllReference();
			foreach ($references as $reference) {
				$nom_reference = $reference->nom_reference;
				$posteDemarrage = $reference->poste;
				$ppm = $reference->ppm;
				$top50 = $reference->top50;
				$modifProc = $reference->modif_proc;
				$sr = $reference->sr;

				// Adaptation des inputs avec les régles de criticité
				if ($reference->nbr_nc >= 2) {
					$ncProc = 9;
				}elseif ($reference->nbr_nc == 1) {
					$ncProc = 3;
				}else $ncProc = 1;
				
				$criticite_postee = $this->adminmodel->getCriticitePoste($reference->poste);
				foreach ($criticite_postee as $criticite_poste) {
					if ($criticite_poste->criticite_poste >= 24) {
						$criticite_equipement = 9;
					}elseif ($criticite_poste->criticite_poste < 12) {
						$criticite_equipement = 1;
					}elseif (12 <= $criticite_poste->criticite_poste and $criticite_poste->criticite_poste < 24) {
						 $criticite_equipement = 3;
					}
				}
				
				if ($reference->duree_demarrage == "projet") {
					$demarrage = 9;
				}elseif ($reference->duree_demarrage == "serie") {
					$demarrage = 3;
				}else $demarrage = 1;
				//Calcule de la criticite Processus
				$criticite_processus = $criticite_equipement*$sr*$ncProc*$demarrage*$ppm*$modifProc;
				if ($reference->nbr_nc > 0) {
					$nc = 3;
				}else $nc = 1;
				//Calcule de la criticite Produit.
				$criticite_produit = $nc*$top50*$sr;
				

				// Ajouter la reference au BDD
				$this->adminmodel->updateCriticiteReference($reference->id_ref, $criticite_produit, $criticite_processus);
				$success = "bg-success text-white";
			}
			header('location: ' . URL . 'administration/gestion_references/1');
		}else header('location: ' . URL);
	}
	public function update_reference()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (!isset($_POST["sr"])) {
					$sr = 1;
				}else $sr = $_POST["sr"];
			if (!isset($_POST["ppm"])) {
				$ppm = 1;
			}else $ppm = $_POST["ppm"];
			if (!isset($_POST["top50"])) {
				$top50 = 1;
			}else $top50 = $_POST["top50"];
			if (!isset($_POST["modifProc"])) {
				$modifProc = 1;
			}else $modifProc = $_POST["modifProc"];

			if (isset($_POST["nom_Reference"]) and isset($_POST["numMaquette"]) and isset($_POST["designation"])) {
				$references = $this->adminmodel->getReferences($_POST["nomReference"], $_POST["posteDemarrage"]);
				foreach ($references as $reference) {
					$nom_reference = $reference->nom_reference;
					$posteDemarrage = $reference->poste;
					$idReference = $reference->id_ref;
				}
					// Adaptation des inputs avec les régles de criticité
					
					if ($_POST["nbrNC"] >= 2) {
						$ncProc = 9;
					}elseif ($_POST["nbrNC"] == 1) {
						$ncProc = 3;
					}else $ncProc = 1;
					
					$criticite_postee = $this->adminmodel->getCriticitePoste($_POST["posteDemarrage"]);
					foreach ($criticite_postee as $criticite_poste) {
						if ($criticite_poste->criticite_poste >= 24) {
							$criticite_equipement = 9;
						}elseif ($criticite_poste->criticite_poste < 12) {
							$criticite_equipement = 1;
						}elseif (12 <= $criticite_poste->criticite_poste and $criticite_poste->criticite_poste < 24) {
							 $criticite_equipement = 3;
						}
					}
					
					if ($_POST["dureeDemarrage"] == "projet") {
						$demarrage = 9;
					}elseif ($_POST["dureeDemarrage"] == "serie") {
						$demarrage = 3;
					}else $demarrage = 1;
					//Calcule de la criticite Processus
					$criticite_processus = $criticite_equipement*$sr*$ncProc*$demarrage*$ppm*$modifProc;

					if ($_POST["nbrNC"] > 0) {
						$nc = 3;
					}else $nc = 1;
					//Calcule de la criticite Produit.
					$criticite_produit = $nc*$top50*$sr;
					
					echo $_POST["nom_Reference"];
					// Ajouter la reference au BDD
					$this->adminmodel->updateReference($idReference, $_POST["nom_Reference"], $_POST["posteDemarrage"], $_POST["nbr_NC"], $sr, $modifProc, $_POST["dureeDemarrage"], $top50, $ppm, $_POST["designation"], $criticite_produit, $criticite_processus, $_POST["num_Maquette"]);
					$success = "bg-success text-white";
					// header('location: ' . URL . 'administration/gestion_reference/1');
	    		}
    		}else header('location: ' . URL);
	}
	public function Ajouter_processus()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$commentaire = "Veuillez remplir tous les champs !";
			if (isset($_POST["nomProcessus"])) {
				$this->adminmodel->addProcessus($_POST["nomProcessus"]);
				$success = "bg-success text-white";
				$commentaire = "Le processus a été ajouter";
			}
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_processus.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function gestion_processus()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$processus = $this->adminmodel->getAllProcessus();
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_processus.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function recherche_processus()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["recherche"])) {
				$processus = $this->adminmodel->rechercheProcessus($_POST["recherche"]);
				if($this->adminmodel->rechercheProcessus($_POST["recherche"])){
					$success = "bg-success text-white";
					$commentaire = "La liste des processus disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_processus.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Processus non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_processus.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}
	public function modifier_processus($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$commentaire = "Veuillez remplir tous les champs !";
			$nomProcessus = "";
			if (isset($id)) {
				$processus = $this->adminmodel->getProcessusById($id);
				foreach ($processus as $proc) {
					$nomProcessus = $proc->nom;
					$id = $proc->id;
				}
			}else {
	            header('location: ' . URL . 'administration/Ajouter_processus');
	        }
			
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_processus.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function supprimer_processus($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id)) {
				$this->adminmodel->deleteEcartProcessus($id);
				$success = "bg-success text-white";
				$commentaire = "Le processus a été supprimer";
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			$processus = $this->adminmodel->getAllProcessus();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_processus.php';
		        require APP . 'view/_templates/footer.php';
	        }else header('location: ' . URL);
	}
	public function update_processus()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["nomProcessus"]) and isset($_POST["id"])) {
				$this->adminmodel->updateProcessusEcart($_POST["nomProcessus"], $_POST["id"]);
			
				$success = "bg-success text-white";
				$commentaire = "Le processus a été mise à jour";
				
			}else{
				$success = "bg-danger text-white";
				$commentaire = "Entrer des informatios valide!";
			}
			$processus = $this->adminmodel->getAllProcessus();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_processus.php';
		        require APP . 'view/_templates/footer.php';
	        }else header('location: ' . URL);
	}
	public function Ajouter_ecart()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$commentaire = "Veuillez remplir tous les champs !";
			if (isset($_POST["nomEcart"])) {
				$this->adminmodel->addEcart($_POST["nomEcart"]);
				$success = "bg-success text-white";
				$commentaire = "Le type d'écart a été ajouter";
			}
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_ecart.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function gestion_ecart()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
			$ecarts = $this->adminmodel->getAllEcart();
			$commentaire = "";
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/gestion_ecart.php';
	        require APP . 'view/_templates/footer.php';
        }else header('location: ' . URL);
	}
	public function recherche_ecart()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["recherche"])) {
				$ecarts = $this->adminmodel->rechercheEcart($_POST["recherche"]);
				if($this->adminmodel->rechercheEcart($_POST["recherche"])){
					$success = "bg-success text-white";
					$commentaire = "La liste des types d'écart disponible";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_ecart.php';
			        require APP . 'view/_templates/footer.php';
				}else{
					$success = "bg-danger text-white";
					$commentaire = "Processus non trouvable!";
					// load views
					require APP . 'view/_templates/header.php';
			        require APP . 'view/administration/gestion_ecart.php';
			        require APP . 'view/_templates/footer.php';
				}
			}
		}else header('location: ' . URL);
	}
	public function modifier_ecart($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			$nomEcart = "";
			$commentaire = "Veuillez remplir tous les champs !";
			if (isset($id)) {
				$processus = $this->adminmodel->getProcessusById($id);
				foreach ($processus as $proc) {
					$nomEcart = $proc->nom;
					$id = $proc->id;
				}
			}else {
	            header('location: ' . URL . 'administration/Ajouter_ecart');
	        }
			
			// load views
			require APP . 'view/_templates/header.php';
	        require APP . 'view/administration/ajouter_ecart.php';
	        require APP . 'view/_templates/footer.php';
    	}else header('location: ' . URL);
	}
	public function supprimer_ecart($id)
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($id)) {
				$this->adminmodel->deleteEcartProcessus($id);
				$success = "bg-success text-white";
				$commentaire = "Le type d'écart a été supprimer";
			}else{
				$success = "bg-success text-white";
				$commentaire = "Une erreur est survenue lors de la suppression!";
			}
			$ecarts = $this->adminmodel->getAllEcart();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_ecart.php';
		        require APP . 'view/_templates/footer.php';
        	}else header('location: ' . URL);
	}
	public function update_Ecart()
	{
		session_start();
        if ($_SESSION["fonction"] == "responsable" OR $_SESSION["fonction"] == "chef equipe") {
        	$clrAdmin = "#162e45";
			if (isset($_POST["nomEcart"]) and isset($_POST["id"])) {
				$this->adminmodel->updateProcessusEcart($_POST["nomEcart"], $_POST["id"]);
			
				$success = "bg-success text-white";
				$commentaire = "Le type d'écart a été mise à jour";
				
			}else{
				$success = "bg-danger text-white";
				$commentaire = "Entrer des informatios valide!";
			}
			$ecarts = $this->adminmodel->getAllEcart();
			// load views
				require APP . 'view/_templates/header.php';
		        require APP . 'view/administration/gestion_ecart.php';
		        require APP . 'view/_templates/footer.php';

		}else header('location: ' . URL);
	}
}

?>