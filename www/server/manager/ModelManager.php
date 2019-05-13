<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * récupérant les données concernant les différents modèles d'habits
 */

class ModelManager
{
    /**
     * Fonction récupérant le label du modèle en fonction de son ID
     * * @var int L'id de la marque
     * @return string Le libellé du modèle
     */
    public static function getModelsName($id)
    {
        $sqlGetModelsName = "SELECT LABEL FROM models WHERE CODE = :i";
        $stmt = Database::prepare($sqlGetModelsName);
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
    }

    /**
     * Fonction récupérant toutes les informations concernant les modèles
     * @return Model[] les informations concernant les modèles
     */
    public static function getAllModels()
    {
        $sqlGetAllModels = "SELECT LABEL, CODE FROM models";
        $stmt = Database::prepare($sqlGetAllModels);
        try {
            $arrResult = [];
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach($res as $s){
                        array_push($arrResult, new Model($s["CODE"], $s["LABEL"]));
                    }
                    return $arrResult;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}