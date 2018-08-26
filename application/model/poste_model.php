<?php

class posteModel
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
        $sql = "SELECT * FROM action_audit_poste ORDER BY date_prevue desc";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function setPlanning($poste, $date)
    {
        $sql = "INSERT INTO planning_audit_poste (poste, date_planifier) VALUES (:poste, :date_planifier)";
        $query = $this->db->prepare($sql);
        $parameters = array(':poste' => $poste, ':date_planifier' => $date);

        $query->execute($parameters);
    }
    public function deletePlanning()
    {
        $sql = "TRUNCATE TABLE planning_audit_poste";
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    public function deletePlanningNoStatus()
    {
        $sql = "DELETE FROM planning_audit_poste WHERE status = :status";
        $query = $this->db->prepare($sql);
        $parameters = array(':status' => "");

        $query->execute($parameters);
    }
    public function getPlanningById($id)
    {
        $sql = "SELECT * FROM planning_audit_poste WHERE id_plan='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getStatusPlanning($poste, $date)
    {
        $sql = "SELECT status FROM planning_audit_poste WHERE poste='".$poste."' AND date_planifier='".$date."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function getAuditeurs()
    {
        $sql = "SELECT nom_auditeur FROM auditeurs";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function affecterAuditeur($poste, $datee, $auditeur)
    {
        $sql = "UPDATE planning_audit_poste SET auditeur = :auditeur, status = :status WHERE poste = :poste AND date_planifier = :date_planifier";
        $query = $this->db->prepare($sql);
        $parameters = array(':auditeur' => $auditeur, ':poste' => $poste, ':date_planifier' => $datee, ':status' => "encours");

        $query->execute($parameters);
    }
    public function getAllPlanning()
    {
        $sql = "SELECT * FROM planning_audit_poste";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getPlanningAuditeur($poste, $datee)
    {
        $sql = "SELECT auditeur FROM planning_audit_poste WHERE poste='".$poste."' and date_planifier='".$datee."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function setPosteAction($date_prevue, $auditeur, $secteur_audite, $poste, $reference, $type_ecart, $ecart_constate, $analyse, $action_corrective, $nom_resp, $processus, $date_realisation, $status)
    {
        $sql = "INSERT INTO action_audit_poste (date_prevue, auditeur, secteur_audite, poste, reference, type_ecart, ecart_constate, analyse, action_corrective, nom_resp, processus, date_realisation, status) VALUES (:date_prevue, :auditeur, :secteur_audite, :poste, :reference, :type_ecart, :ecart_constate, :analyse, :action_corrective, :nom_resp, :processus, :date_realisation, :status)";
        $query = $this->db->prepare($sql);
        $parameters = array(':date_prevue' => $date_prevue, ':auditeur' => $auditeur, ':secteur_audite' => $secteur_audite, ':poste' => $poste, ':reference' => $reference, ':type_ecart' => $type_ecart, ':ecart_constate' => $ecart_constate, ':analyse' => $analyse, ':action_corrective' => $action_corrective, ':nom_resp' => $nom_resp, ':processus' => $processus, ':date_realisation' => $date_realisation, ':status' => $status);

        $query->execute($parameters);
    }
    public function updateStatus($poste, $datee, $status)
    {
        $sql = "UPDATE planning_audit_poste SET status = :status WHERE poste = :poste AND date_planifier = :date_planifier";
        $query = $this->db->prepare($sql);
        $parameters = array(':poste' => $poste, ':date_planifier' => $datee, ':status' => $status);

        $query->execute($parameters);
    }
    public function updateAuditeur($poste, $datee, $auditeur)
    {
        $sql = "UPDATE planning_audit_poste SET auditeur = :auditeur WHERE poste = :poste AND date_planifier = :date_planifier";
        $query = $this->db->prepare($sql);
        $parameters = array(':poste' => $poste, ':date_planifier' => $datee, ':auditeur' => $auditeur);

        $query->execute($parameters);
    }
    public function deleteAction($id_action)
    {
        $sql = "DELETE FROM action_audit_poste WHERE id_action = :id_action";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_action' => $id_action);

        $query->execute($parameters);
    }
    public function getActionById($id)
    {
        $sql = "SELECT * FROM action_audit_poste WHERE id_action='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function selectAction($poste, $auditeur, $date)
    {
        $sql = "SELECT * FROM action_audit_poste WHERE poste='".$poste."' AND auditeur='".$auditeur."' AND date_prevue='".$date."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function updateActionPoste($id, $reference, $type_ecart, $ecart_constate, $analyse, $action_corrective, $responsable, $processus, $date_realisation, $status)
    {
        $sql = "UPDATE action_audit_poste SET reference = :reference, type_ecart = :type_ecart, ecart_constate = :ecart_constate, analyse = :analyse, action_corrective = :action_corrective, nom_resp = :responsable, processus = :processus, date_realisation = :date_realisation, status = :status WHERE id_action = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':reference' => $reference, ':type_ecart' => $type_ecart, ':processus' => $processus, ':ecart_constate' => $ecart_constate, ':analyse' => $analyse, ':action_corrective' => $action_corrective, ':responsable' => $responsable, ':id' => $id, ':date_realisation' => $date_realisation, ':status' => $status);

        $query->execute($parameters);
    }
    public function rechercheAction($recherche)
    {
        $sql = "SELECT * FROM action_audit_poste WHERE auditeur='".$recherche."' OR secteur_audite='".$recherche."' OR poste='".$recherche."' OR type_ecart='".$recherche."' OR ecart_constate='".$recherche."' OR analyse='".$recherche."' OR action_corrective='".$recherche."' OR nom_resp='".$recherche."' OR date_realisation='".$recherche."' OR status='".$recherche."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getIdAction($poste, $date)
    {
        $sql = "SELECT * FROM action_audit_poste WHERE poste='".$poste."' and date_prevue='".$date."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getIdPlanning($poste, $date, $auditeur)
    {
        $sql = "SELECT * FROM planning_audit_poste WHERE poste='".$poste."' and date_planifier='".$date."' and auditeur='".$auditeur."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAllCriticitePoste()
    {
        $sql = "SELECT criticite_poste FROM poste";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
   public function getAllNomPoste()
    {
        $sql = "SELECT nom_poste FROM poste";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function getStatusAction($poste, $auditeur, $date)
    {
        $sql = "SELECT status FROM action_audit_poste WHERE poste='".$poste."' and date_prevue='".$date."' and auditeur='".$auditeur."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    public function getAuditData($champs, $condition)
    {
        $sql = "SELECT * FROM planning_audit_poste WHERE ".$champs."='".$condition."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAuditDataAction($champs, $condition)
    {
        $sql = "SELECT * FROM action_audit_poste WHERE ".$champs."='".$condition."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAuditDataPoste($champs, $condition, $condition1)
    {
        $sql = "SELECT * FROM planning_audit_poste WHERE ".$champs."='".$condition."' AND poste='".$condition1."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
?>