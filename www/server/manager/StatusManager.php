<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * récupérant les données concernant les différents status
 * possibles pour un utilisateur
 */

class StatusManager
{
    /**
     * Fonction récupérant le label du status en fonction de son ID
     * * @var int L'id du status
     * @return string Le libellé du status
     */
    public static function getStatusName($id)
    {
        $sqlGetStatusName = "SELECT LABEL FROM status WHERE CODE = :i";
        $stmt = Database::prepare($sqlGetStatusName);
        try {
            if ($stmt->execute(array("i" => intval($id)))) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    return $res["LABEL"];
                }
            }
        } catch (PDOException $e) {
            return false;
        }
        return "";
    }

    /**
     * Fonction récupérant toutes les informations concernant les status
     * @return Status[] les informations concernant les status
     */
    public static function getAllStatus()
    {
        $arrResult = [];
        $sqlGetAllStatus = "SELECT LABEL, CODE FROM status";
        $stmt = Database::prepare($sqlGetAllStatus);
        try {
            
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach($res as $s){
                        array_push($arrResult, new Status(intval($s["CODE"]), $s["LABEL"]));
                    }
                    return $arrResult;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
        return $arrResult;
    }

}
