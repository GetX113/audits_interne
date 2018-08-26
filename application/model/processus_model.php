<?php 

class processusModel
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
        $sql = "SELECT * FROM action_audit_processus ORDER BY date_prevue desc";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function deletePlanningNoStatus()
    {
        $sql = "DELETE FROM planning_audit_processus WHERE status = :status";
        $query = $this->db->prepare($sql);
        $parameters = array(':status' => "");

        $query->execute($parameters);
    }
    public function getActionById($id)
    {
        $sql = "SELECT * FROM action_audit_processus WHERE id_action='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllProduit()
    {
        $sql = "SELECT * FROM referencess ORDER BY criticite_processus DESC, sr DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }
    public function setPlanning($produit, $date, $cotation)
    {
        $sql = "INSERT INTO planning_audit_processus (produit, date_plan, cotation) VALUES (:produit, :date_plan, :cotation)";
        $query = $this->db->prepare($sql);
        $parameters = array(':produit' => $produit, ':date_plan' => $date, ':cotation' => $cotation);

        $query->execute($parameters);
    }
    public function setPlanningSuivi($produit, $processus, $date, $auditeur, $cotation)
    {
        $sql = "INSERT INTO planning_audit_processus (produit, date_plan, processus, auditeur, cotation, status) VALUES (:produit, :date_plan, :processus, :auditeur, :cotation, :status)";
        $query = $this->db->prepare($sql);
        $parameters = array(':produit' => $produit, ':date_plan' => $date, ':processus' => $processus, ':auditeur' => $auditeur, ':cotation' => $cotation, ':status' => "encours");

        $query->execute($parameters);
    }
    public function getAllProcessus()
    {
        $sql = "SELECT * FROM processus_fabrication";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }
    public function getAllProcess()
    {
        $sql = "SELECT * FROM processus_fabrication";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAuditProcessus($id)
    {
        $sql = "SELECT * FROM planning_audit_processus WHERE id='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllPlanning()
    {
        $sql = "SELECT * FROM planning_audit_processus";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function affecterProcessus($id, $processus)
    {
        $sql = "UPDATE planning_audit_processus SET processus = :processus WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':processus' => $processus, ':id' => $id);

        $query->execute($parameters);
    }
    public function affecterAuditeur($processus, $datee, $auditeur)
    {
        $sql = "UPDATE planning_audit_processus SET auditeur = :auditeur, status = :status WHERE processus = :processus AND date_plan = :date_plan";
        $query = $this->db->prepare($sql);
        $parameters = array(':auditeur' => $auditeur, ':processus' => $processus, ':date_plan' => $datee, ':status' => "encours");

        $query->execute($parameters);
    }
    public function getPlanningAuditeur($processus, $datee)
    {
        $sql = "SELECT * FROM planning_audit_processus WHERE processus='".$processus."' and date_plan='".$datee."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setProcessusAction($mois_audit, $date_audit, $processus, $auditeur, $secteur, $type6m, $question, $critere, $reference, $ecart_constate, $cotation, $action_immediate, $delai, $analyse, $action_corrective, $pilote, $process, $delai_action, $date_realisation, $etat)
    {
        $sql = "INSERT INTO action_audit_processus (mois_audit, date_audit, processus, auditeur, secteur, type6m, question, critere, reference, ecart_constate, cotation, action_immediate, delai, analyse, action_corrective, pilote, process, delai_action, date_realisation, etat) VALUES (:mois_audit, :date_audit, :processus, :auditeur, :secteur, :type6m, :question, :critere, :reference, :ecart_constate, :cotation, :action_immediate, :delai, :analyse, :action_corrective, :pilote, :process, :delai_action, :date_realisation, :etat)";
        $query = $this->db->prepare($sql);
        $parameters = array(':mois_audit' => $mois_audit, ':date_audit' => $date_audit, ':processus' => $processus, ':auditeur' => $auditeur, ':secteur' => $secteur, ':type6m' => $type6m, ':question' => $question, ':critere' => $critere, ':reference' => $reference, ':ecart_constate' => $ecart_constate, ':cotation' => $cotation, ':action_immediate' => $action_immediate, ':delai' => $delai, ':analyse' => $analyse, ':action_corrective' => $action_corrective, ':pilote' => $pilote, ':process' => $process, ':delai_action' => $delai_action, ':date_realisation' => $date_realisation, ':etat' => $etat);

        $query->execute($parameters);
    }
    public function updateProcessusAction($id, $mois_audit, $date_audit, $processus, $auditeur, $secteur, $type6m, $question, $critere, $reference, $ecart_constate, $cotation, $action_immediate, $delai, $analyse, $action_corrective, $pilote, $process, $delai_action, $date_realisation, $etat)
    {
        $sql = "UPDATE action_audit_processus SET mois_audit = :mois_audit, date_audit = :date_audit, processus = :processus, auditeur = :auditeur, secteur = :secteur, type6m = :type6m, question = :question, critere = :critere, reference = :reference, ecart_constate = :ecart_constate, cotation = :cotation, action_immediate = :action_immediate, delai = :delai, analyse = :analyse, action_corrective = :action_corrective, pilote = :pilote, process = :process, delai_action = :delai_action, date_realisation = :date_realisation, etat = :etat WHERE id_action = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':mois_audit' => $mois_audit, ':date_audit' => $date_audit, ':processus' => $processus, ':auditeur' => $auditeur, ':secteur' => $secteur, ':type6m' => $type6m, ':question' => $question, ':critere' => $critere, ':reference' => $reference, ':ecart_constate' => $ecart_constate, ':cotation' => $cotation, ':action_immediate' => $action_immediate, ':delai' => $delai, ':analyse' => $analyse, ':action_corrective' => $action_corrective, ':pilote' => $pilote, ':process' => $process, ':delai_action' => $delai_action, ':date_realisation' => $date_realisation, ':etat' => $etat, ':id' => $id);

        $query->execute($parameters);
    }
    public function updateInformationAudit($id, $ic, $status)
    {
        $sql = "UPDATE planning_audit_processus SET ic = :ic, status = :status WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':ic' => $ic, ':status' => $status);

        $query->execute($parameters);
    }
    public function updateInformationAuditRetard($id, $ic, $suivi, $status)
    {
        $sql = "UPDATE planning_audit_processus SET ic = :ic, status = :status, date_suivi = :date_suivi WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':ic' => $ic, ':status' => $status, ':date_suivi' => $suivi);

        $query->execute($parameters);
    }
    public function updateInformationAuditReplan($id, $ic, $date_replanification, $status)
    {
        $sql = "UPDATE planning_audit_processus SET ic = :ic, status = :status, date_replanification = :date_replanification WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':ic' => $ic, ':status' => $status, ':date_replanification' => $date_replanification);

        $query->execute($parameters);
    }
    public function rechercheAction($recherche)
    {
        $sql = "SELECT * FROM action_audit_produit WHERE date_audit='".$recherche."' OR processus='".$recherche."' OR auditeur='".$recherche."' OR secteur='".$recherche."' OR type6m='".$recherche."' OR question='".$recherche."' OR critere='".$recherche."' OR reference='".$recherche."' OR ecart_constate='".$recherche."' OR cotation='".$recherche."' OR action_immediate='".$recherche."' OR delai='".$recherche."' OR analyse='".$recherche."' OR action_corrective='".$recherche."' OR pilote='".$recherche."' OR process='".$recherche."' OR delai_action='".$recherche."' OR date_realisation='".$recherche."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function deleteAction($id_action)
    {
        $sql = "DELETE FROM action_audit_processus WHERE id_action = :id_action";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_action' => $id_action);

        $query->execute($parameters);
    }
    public function getAuditById($id)
    {
        $sql = "SELECT * FROM planning_audit_processus WHERE id='".$id."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function selectAction($processus, $date)
    {
        $sql = "SELECT * FROM action_audit_processus WHERE processus='".$processus."' AND mois_audit='".$date."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function deletePlanning($processus, $produit, $date_plan)
    {
        $sql = "DELETE FROM planning_audit_processus WHERE date_plan != :date_plan and processus = :processus and produit = :produit and status = :status";
        $query = $this->db->prepare($sql);
        $parameters = array(':processus' => $processus, ':date_plan' => $date_plan, ':status' => "encours", ':produit' => $produit);

        $query->execute($parameters);
    }
    public function getAuditDataProcessus($champs, $condition)
    {
        $sql = "SELECT * FROM planning_audit_processus WHERE ".$champs."='".$condition."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAuditDataAction($champs, $condition, $processus)
    {
        $sql = "SELECT * FROM action_audit_processus WHERE ".$champs."='".$condition."' AND processus='".$processus."'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

}

?>