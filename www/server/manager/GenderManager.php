<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */

/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * récupérant les données concernant le type d'un habit
 */
class GenderManager
{
    /**
     * Fonction récupérant le label du type en fonction de son ID
     * * @var int L'id de la marque
     * @return string Le libellé du type 
     */
    public static function getGenderName($id)
    {
        $sqlGetGenderName = "SELECT LABEL FROM genders WHERE CODE = :i";
        $stmt = Database::prepare($sqlGetGenderName);
        try {
            if ($stmt->execute(array("i" => intval($id)))) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    return $res["LABEL"];
                }
            }
        } catch (PDOException $e) {
            return false;
        }return "";
    }

    /**
     * Fonction récupérant toutes les informations concernant les types
     * @return Gender[] les informations concernant les types
     */
    public static function getAllGenders()
    {
        $arrResult = [];
        $sqlGetAllGenders = "SELECT LABEL, CODE FROM genders";
        $stmt = Database::prepare($sqlGetAllGenders);
        try {

            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $s) {
                        array_push($arrResult, new Gender(intval($s["CODE"]), $s["LABEL"]));
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
