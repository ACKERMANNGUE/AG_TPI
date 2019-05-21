<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * récupérant les données concernant une marque
 */

class BrandManager
{
    /**
     * Fonction récupérant le label de la marque en fonction de son ID
     * @var int L'id de la marque
     * @return string Le libellé de la marque
     */
    public static function getBrandsName($id)
    {
        $sqlGetBrandsName = "SELECT LABEL FROM brands WHERE CODE = :i";
        $stmt = Database::prepare($sqlGetBrandsName);
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
     * Fonction récupérant toutes les informations concernant les marques
     * @return Brand[] les informations concernant les marques
     */
    public static function getAllBrands()
    {
        $sqlGetBrandsName = "SELECT LABEL, CODE FROM brands";
        $stmt = Database::prepare($sqlGetBrandsName);
        try {
            $arrResult = [];
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach($res as $b){
                        array_push($arrResult, new Brand(intval($b["CODE"]), $b["LABEL"]));
                    }
                    return $arrResult;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
