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
 * récupérant les données concernant les tailles d'habits
 */
class SizeManager
{
    /**
     * Fonction récupérant le label de la taille en fonction de son ID
     * * @var int L'id de la marque
     * @return string Le libellé de la taille
     */
    public static function getSizesName($id)
    {
        $sqlGetSizesName = "SELECT LABEL FROM sizes WHERE CODE = :i";
        $stmt = Database::prepare($sqlGetSizesName);
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
     * Fonction récupérant toutes les informations concernant la taille
     * @return Size[] les informations concernant la taille
     */
    public static function getAllSizes()
    {
        $arrResult = [];
        $sqlGetAllSizes = "SELECT LABEL, CODE FROM sizes";
        $stmt = Database::prepare($sqlGetAllSizes);
        try {

            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $s) {
                        array_push($arrResult, new Size(intval($s["CODE"]), $s["LABEL"]));
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
