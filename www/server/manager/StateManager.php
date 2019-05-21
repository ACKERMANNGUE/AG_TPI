<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * récupérant les données concernant les différents états
 * possibles pour une annonce
 */

class StateManager
{
    /**
     * Fonction récupérant le label de l'état en fonction de son ID
     * * @var int L'id de la marque
     * @return string Le libellé de l'état
     */
    public static function getStatesName($id)
    {
        $sqlGetStatesName = "SELECT LABEL FROM states WHERE CODE = :i";
        $stmt = Database::prepare($sqlGetStatesName);
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
     * Fonction récupérant toutes les informations concernant les états
     * @return State[] les informations concernant les états
     */
    public static function getAllStates()
    {
        $arrResult = [];
        $sqlGetAllStates = "SELECT LABEL, CODE FROM states";
        $stmt = Database::prepare($sqlGetAllStates);
        try {
           
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach($res as $s){
                        array_push($arrResult, new State(intval($s["CODE"]), $s["LABEL"]));
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
