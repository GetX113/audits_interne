<?php 

class adminModel
{
	function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    public function login($username, $password)
    {
        $sql = "SELECT * FROM utilisateurs WHERE username='".$username."' AND password='".$password."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function addCompte($nom, $prenom, $username, $password, $fonction)
    {
        $sql = "INSERT INTO utilisateurs (nom, prenom, username, password, fonctionnalite) VALUES (:nom, :prenom, :username, :password, :fonction)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom, ':prenom' => $prenom, ':username' => $username, ':password' => $password, ':fonction' => $fonction);

        $query->execute($parameters);
    }
    public function deleteCompte($id)
    {
        $sql = "DELETE FROM utilisateurs WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
    }
    public function rechercheCompte($nom)
    {
        $sql = "SELECT * FROM secteur WHERE nom='".$nom."' OR prenom='".$nom."' OR fonctionnalite='".$nom."' OR username='".$nom."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function updatePassword($id, $password)
    {
        $sql = "UPDATE utilisateurs SET password = :password WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':password' => $password, ':id' => $id);

        $query->execute($parameters);
    }
    public function addAffiche($target, $titre, $commentaire, $date_pub)
    {
        $sql = "INSERT INTO affichage_accueil (target, titre, commentaire, date_pub) VALUES (:target, :titre, :commentaire, :date_pub)";
        $query = $this->db->prepare($sql);
        $parameters = array(':target' => $target, ':titre' => $titre, ':commentaire' => $commentaire, ':date_pub' => $date_pub);

        $query->execute($parameters);
    }
    public function getAllAffiche()
    {
        $sql = "SELECT * FROM affichage_accueil order by date_pub DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAfficheById($id)
    {
        $sql = "SELECT * FROM affichage_accueil WHERE id_affiche='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function updateAffiche($titre, $commentaire, $id_affiche)
    {
        $sql = "UPDATE affichage_accueil SET titre = :titre, commentaire = :commentaire WHERE id_affiche = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':titre' => $titre, ':commentaire' => $commentaire, ':id' => $id_affiche);

        $query->execute($parameters);
    }
    public function deleteAffiche($id_affiche)
    {
        $sql = "DELETE FROM affichage_accueil WHERE id_affiche = :id_affiche";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_affiche' => $id_affiche);

        $query->execute($parameters);
    }
    public function rechercheAffiche($nom)
    {
        $sql = "SELECT * FROM affichage_accueil WHERE titre='".$nom."' OR commentaire='".$nom."' OR date_pub='".$nom."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAllResponsable()
    {
        $sql = "SELECT * FROM responsables";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function addSecteur($nom, $responsable)
    {
    	$sql = "INSERT INTO secteur (nom_secteur, nom_responsable) VALUES (:nom, :responsable)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom, ':responsable' => $responsable);

        $query->execute($parameters);
    }
    public function getAllSecteur()
    {
    	$sql = "SELECT * FROM secteur";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getSecteur($nom)
    {
        $sql = "SELECT * FROM secteur WHERE nom_secteur='".$nom."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function rechercheSecteur($nom)
    {
        $sql = "SELECT * FROM secteur WHERE nom_secteur='".$nom."' OR nom_responsable='".$nom."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getSecteurById($id)
    {
        $sql = "SELECT * FROM secteur WHERE id_secteur='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getPosteById($id)
    {
        $sql = "SELECT * FROM poste WHERE id_poste='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getSecteurByPoste($poste)
    {
        $sql = "SELECT secteur FROM poste WHERE nom_poste='".$poste."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function updateSecteur($nom, $responsable, $id_secteur)
    {
        $sql = "UPDATE secteur SET nom_secteur = :nom, nom_responsable = :responsable WHERE id_secteur = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom, ':responsable' => $responsable, ':id' => $id_secteur);

        $query->execute($parameters);
    }
    public function updatePoste($nom, $secteur, $date, $id)
    {
        $sql = "UPDATE poste SET nom_poste = :nom, secteur = :secteur, premiere_date = :datee WHERE id_poste = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom, ':secteur' => $secteur, ':id' => $id, ':datee' => $date);

        $query->execute($parameters);
    }
    public function deleteSecteur($id_secteur)
    {
        $sql = "DELETE FROM secteur WHERE id_secteur = :id_secteur";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_secteur' => $id_secteur);

        $query->execute($parameters);
    }
    public function deletePoste($id)
    {
        $sql = "DELETE FROM poste WHERE id_poste = :id_poste";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_poste' => $id_poste);

        $query->execute($parameters);
    }
    public function addPoste($nom, $secteur, $dateAudit)
    {
    	$sql = "INSERT INTO poste (nom_poste, secteur, premiere_date) VALUES (:nom, :secteur, :dateAudit)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom, ':secteur' => $secteur, ':dateAudit' => $dateAudit);

        $query->execute($parameters);
    }
    public function getAllPoste()
    {
        $sql = "SELECT * FROM poste";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getCriticitePoste($nomPoste)
    {
        $sql = "SELECT criticite_poste FROM poste WHERE nom_poste='".$nomPoste."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public function addReference($nomReference, $poste, $nbrNC, $sr, $modifProc, $dureeDemarrage, $top50, $ppm, $designation, $criticite_produit, $criticite_processus, $numMaq)
    {
        $sql = "INSERT INTO referencess (nom_reference, poste, nbr_nc, sr, modif_proc, duree_demarrage, top50, ppm, designation, criticite_produit, criticite_processus, num_maq) VALUES (:nomReference, :poste, :nbrNC, :sr, :modifProc, :dureeDemarrage, :top50, :ppm, :designation, :criticite_produit, :criticite_processus, :num_maq)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nomReference' => $nomReference, ':poste' => $poste, ':nbrNC' => $nbrNC, ':sr' => $sr, ':modifProc' => $modifProc, ':dureeDemarrage' => $dureeDemarrage, ':top50' => $top50, ':ppm' => $ppm, ':designation' => $designation, ':criticite_produit' => $criticite_produit, ':criticite_processus' => $criticite_processus, ':num_maq' => $numMaq);

        $query->execute($parameters);
    }
    public function getAllReference()
    {
        $sql = "SELECT * FROM referencess";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getDisplayPage($table, $order, $start, $nbr)
    {
        $sql = "SELECT * FROM ".$table." ORDER BY ".$order." DESC limit ".$start.",".$nbr;
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getTotalRecord($champs, $table)
    {
        $sql = "SELECT COUNT(".$champs.") AS total FROM ".$table;
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->total;
    }
    public function getReference($nom)
    {
        $sql = "SELECT * FROM referencess WHERE nom_reference='".$nom."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function rechercheReference($nom)
    {
        $sql = "SELECT * FROM referencess WHERE nom_reference='".$nom."' OR poste='".$nom."' OR num_maq='".$nom."' OR duree_demarrage='".$nom."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getReferences($nom, $poste)
    {
        $sql = "SELECT * FROM referencess WHERE nom_reference='".$nom."' AND poste='".$poste."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function deleteReference($id_reference)
    {
        $sql = "DELETE FROM referencess WHERE id_ref = :id_reference";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_reference' => $id_reference);

        $query->execute($parameters);
    }
    public function updateCriticitePoste($idPoste, $criticite_poste)
    {
        $sql = "UPDATE poste SET criticite_poste = :criticite_poste WHERE id_poste = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':criticite_poste' => $criticite_poste, ':id' => $idPoste);

        $query->execute($parameters);
    }
    public function getReferenceById($id)
    {
        $sql = "SELECT * FROM referencess WHERE id_ref='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getReferenceByPoste($nomPoste)
    {
        $sql = "SELECT * FROM referencess WHERE poste='".$nomPoste."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function updateReference($idReference, $nomReference, $poste, $nbrNC, $sr, $modifProc, $dureeDemarrage, $top50, $ppm, $designation, $criticite_produit, $criticite_processus, $numMaq)
    {
        $sql = "UPDATE referencess SET poste = :poste, nom_reference = :nomReference, nbr_nc = :nbrNC, sr = :sr, modif_proc = :modifProc, duree_demarrage = :dureeDemarrage, top50 = :top50, ppm = :ppm, designation = :designation, criticite_produit = :criticite_produit, criticite_processus = :criticite_processus, num_maq = :num_maq WHERE id_ref = :idReference";
        $query = $this->db->prepare($sql);
        $parameters = array(':idReference' => $idReference, ':nomReference' => $nomReference, ':poste' => $poste, ':nbrNC' => $nbrNC, ':sr' => $sr, ':modifProc' => $modifProc, ':dureeDemarrage' => $dureeDemarrage, ':top50' => $top50, ':ppm' => $ppm, ':designation' => $designation, ':criticite_produit' => $criticite_produit, ':criticite_processus' => $criticite_processus, ':num_maq' => $numMaq);

        $query->execute($parameters);
    }
    public function updateCriticiteReference($idReference, $criticite_produit, $criticite_processus)
    {
        $sql = "UPDATE referencess SET criticite_produit = :criticite_produit, criticite_processus = :criticite_processus WHERE id_ref = :idReference";
        $query = $this->db->prepare($sql);
        $parameters = array(':idReference' => $idReference, ':criticite_produit' => $criticite_produit, ':criticite_processus' => $criticite_processus);

        $query->execute($parameters);
    }
    public function addProcessus($nom)
    {
        $sql = "INSERT INTO processus_ecart (nom, type) VALUES (:nom, :type)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom, ':type' => "processus");

        $query->execute($parameters);
    }
    public function getAllProcessus()
    {
        $sql = "SELECT * FROM processus_ecart WHERE type='processus'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function rechercheProcessus($nom)
    {
        $sql = "SELECT * FROM processus_ecart WHERE nom='".$nom."' AND type='processus'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getProcessusById($id)
    {
        $sql = "SELECT * FROM processus_ecart WHERE id='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function updateProcessusEcart($nom, $id)
    {
        $sql = "UPDATE processus_ecart SET nom = :nom WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom, ':id' => $id);

        $query->execute($parameters);
    }
     public function addEcart($nom)
    {
        $sql = "INSERT INTO processus_ecart (nom, type) VALUES (:nom, :type)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom, ':type' => "ecart");

        $query->execute($parameters);
    }
    public function getAllEcart()
    {
        $sql = "SELECT * FROM processus_ecart WHERE type='ecart'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function rechercheEcart($nom)
    {
        $sql = "SELECT * FROM processus_ecart WHERE nom='".$nom."' AND type='ecart'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function deleteEcartProcessus($id)
    {
        $sql = "DELETE FROM processus_ecart WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
    }
    public function getPosteBySecteur($secteur)
    {
        $sql = "SELECT nom_poste FROM poste WHERE secteur='".$secteur."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function getSectByPoste($poste)
    {
        $sql = "SELECT secteur FROM poste WHERE nom_poste='".$poste."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }
}


 ?>