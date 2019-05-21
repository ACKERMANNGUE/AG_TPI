<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * récupérant les données concernant les pays
 */

class CountryManager
{
    /**
     * Fonction récupérant le label du pays en fonction de son Code ISO
     * * @var int L'id de la marque
     * @return string Le libellé du pays
     */
    public static function getCountrysName($isocode)
    {
        $sqlGetCountrysName = "SELECT LABEL FROM countries WHERE ISOCODE = :i";
        $stmt = Database::prepare($sqlGetCountrysName);
        try {
            if ($stmt->execute(array("i" => $isocode))) {
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
     * Fonction récupérant toutes les informations concernant les pays
     * @return Country[] les informations concernant les pays
     */
    public static function getAllCountries()
    {
        $sqlGetAllCountries = "SELECT LABEL, ISOCODE FROM countries";
        $stmt = Database::prepare($sqlGetAllCountries);
        try {
            $arrResult = [];
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach($res as $s){
                        array_push($arrResult, new Country($s["ISOCODE"], $s["LABEL"]));
                    }
                    return $arrResult;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
