<?php 

class produitModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    public function getAllAction()
    {
        $sql = "SELECT * FROM action_audit_produit ORDER BY date_prevue desc";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getTotalRecordProduit()
    {
        $sql = "SELECT COUNT(id_ref) AS total FROM referencess where criticite_produit > '1'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->total;
    }
    public function getAllProduit()
    {
        $sql = "SELECT * FROM referencess where criticite_produit > '1'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }
     public function setPlanning($reference, $date)
    {
        $sql = "INSERT INTO planning_audit_produit (reference, date_planifier) VALUES (:reference, :date_planifier)";
        $query = $this->db->prepare($sql);
        $parameters = array(':reference' => $reference, ':date_planifier' => $date);

        $query->execute($parameters);
    }
    public function getAllPlanning()
    {
        $sql = "SELECT * FROM planning_audit_produit ORDER BY date_planifier ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function affecterAuditeur($reference, $datee, $auditeur)
    {
        $sql = "UPDATE planning_audit_produit SET auditeur = :auditeur, status = :status WHERE reference = :reference AND date_planifier = :date_planifier";
        $query = $this->db->prepare($sql);
        $parameters = array(':auditeur' => $auditeur, ':reference' => $reference, ':date_planifier' => $datee, ':status' => "encours");

        $query->execute($parameters);
    }
    public function updateStatusAudit($id, $status)
    {
        $sql = "UPDATE planning_audit_produit SET status = :status WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':status' => $status);

        $query->execute($parameters);
    }
    public function getPlanningAuditeur($reference, $datee)
    {
        $sql = "SELECT auditeur FROM planning_audit_produit WHERE reference='".$reference."' and date_planifier='".$datee."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function deletePlanningNoStatus()
    {
        $sql = "DELETE FROM planning_audit_produit WHERE status = :status";
        $query = $this->db->prepare($sql);
        $parameters = array(':status' => "");

        $query->execute($parameters);
    }
    public function getStatusPlanning($reference, $date)
    {
        $sql = "SELECT status FROM planning_audit_produit WHERE reference='".$reference."' AND date_planifier='".$date."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function getAuditByProduit($reference, $auditeur)
    {
        $sql = "SELECT id FROM planning_audit_produit WHERE reference='".$reference."' AND auditeur='".$auditeur."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function setProduitAction($date_audit, $auditeur, $produit, $secteur, $designation, $ecart_constate, $protection_client, $pilote_audit, $validation_protection, $analyse_causes, $action_corrective, $pilote_action, $audit_date, $non_conforme, $realiser, $status)
    {
        $sql = "INSERT INTO action_audit_produit (date_audit, auditeur, produit, secteur, designation, ecart_constate, protection_client, pilote_audit, validation_protection, analyse_causes, action_corrective, pilote_action, audit_date, non_conforme, realiser, status) VALUES (:date_audit, :auditeur, :produit, :secteur, :designation, :ecart_constate, :protection_client, :pilote_audit, :validation_protection, :analyse_causes, :action_corrective, :pilote_action, :audit_date, :non_conforme, :realiser, :status)";
        $query = $this->db->prepare($sql);
        $parameters = array(':date_audit' => $date_audit, ':auditeur' => $auditeur, ':produit' => $produit, ':secteur' => $secteur, ':designation' => $designation, ':ecart_constate' => $ecart_constate, ':protection_client' => $protection_client, ':pilote_audit' => $pilote_audit, ':validation_protection' => $validation_protection, ':analyse_causes' => $analyse_causes, ':action_corrective' => $action_corrective, ':pilote_action' => $pilote_action, ':audit_date' => $audit_date, ':non_conforme' => $non_conforme, ':realiser' => $realiser, ':status' => $status);

        $query->execute($parameters);
    }
    public function rechercheAction($recherche)
    {
        $sql = "SELECT * FROM action_audit_produit WHERE auditeur='".$recherche."' OR secteur='".$recherche."' OR produit='".$recherche."' OR designation='".$recherche."' OR ecart_constate='".$recherche."' OR analyse_causes='".$recherche."' OR action_corrective='".$recherche."' OR pilote_audit='".$recherche."' OR audit_date='".$recherche."' OR protection_client='".$recherche."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getActionById($id)
    {
        $sql = "SELECT * FROM action_audit_produit WHERE id_action='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function updateActionProduit($id, $date_audit, $auditeur, $secteur, $produit, $designation, $ecart_constate, $protection_client, $pilote_audit, $analyse_causes, $action_corrective, $pilote_action, $audit_date, $validation_protection, $non_conforme, $realiser, $status)
    {
        $sql = "UPDATE action_audit_produit SET date_audit = :date_audit, auditeur = :auditeur, secteur = :secteur, produit = :produit, designation = :designation, ecart_constate = :ecart_constate, protection_client = :protection_client, pilote_audit = :pilote_audit, analyse_causes = :analyse_causes, action_corrective = :action_corrective, pilote_action = :pilote_action, audit_date = :audit_date, validation_protection = :validation_protection, non_conforme = :non_conforme, realiser = :realiser, status = :status WHERE id_action = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':date_audit' => $date_audit, ':auditeur' => $auditeur, ':secteur' => $secteur, ':produit' => $produit, ':designation' => $designation, ':ecart_constate' => $ecart_constate, ':protection_client' => $protection_client, ':id' => $id, ':pilote_audit' => $pilote_audit, ':analyse_causes' => $analyse_causes, ':action_corrective' => $action_corrective, ':pilote_action' => $pilote_action, ':audit_date' => $audit_date, ':validation_protection' => $validation_protection, ':non_conforme' => $non_conforme, ':realiser' => $realiser, ':status' => $status);

        $query->execute($parameters);
    }
    public function selectAction($produit, $auditeur)
    {
        $sql = "SELECT * FROM action_audit_produit WHERE produit='".$produit."' AND auditeur='".$auditeur."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function deleteAction($id_action)
    {
        $sql = "DELETE FROM action_audit_produit WHERE id_action = :id_action";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_action' => $id_action);

        $query->execute($parameters);
    }
    public function getAuditDataProduit($champs, $condition)
    {
        $sql = "SELECT * FROM planning_audit_produit WHERE ".$champs."='".$condition."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}

?>