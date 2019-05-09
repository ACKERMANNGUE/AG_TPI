<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * traitant ou récupérant des données concernant une annonce
 */

class AdManager
{
    /**
     * Fonction récupérant les informations de toutes les annnonces
     * @return Ad Les informations de l'annonce
     */
    public static function getAds()
    {
        $sqlGetInfosAds = "SELECT ID, users_NICKNAME ,TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING FROM ads";
        $stmt = Database::prepare($sqlGetInfosAds);
        try {
            $arrResult = [];
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $a) {
                        array_push($arrResult, new Ad($a["ID"], $a["users_NICKNAME"], $a["TITLE"], $a["DESCRIPTION"], $a["GENDERS_CODE"], $a["SIZES_CODE"], $a["BRANDS_CODE"], $a["MODELS_CODE"], $a["STATES_CODE"], $a["PRICE"], $a["DATE_POSTING"]));
                    }
                    return $arrResult;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction récupérant les informations d'une annnonce
     * @var int L'id de l'annonce
     * @return Ad Les informations de l'annonce
     */
    public static function getAdById($id)
    {
        $sqlGetInfosAd = "SELECT ID, TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING FROM ads WHERE ID = :i";
        $stmt = Database::prepare($sqlGetInfosAd);
        try {
            if ($stmt->execute(array("i" => $id))) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    return new Ad($res["ID"],  $res["users_NICKNAME"], $res["TITLE"], $res["DESCRIPTION"], $res["GENDERS_CODE"], $res["SIZES_CODE"], $res["BRANDS_CODE"], $res["MODELS_CODE"], $res["STATES_CODE"], $res["PRICE"], $res["DATE_POSTING"]);
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction récupérant les informations d'une annnonce
     * @var Ad Les informations de l'annonce
     * @return boolean True si OK, False si problème d'insertion
     */
    public static function createAd($Ad)
    {
        $sqlCreateUser = "INSERT INTO ads (TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME)
         VALUES (:t,:d, :gc, :sic, :bc, :mc, :stc, :p, NOW(), :un)";
        $stmt = Database::prepare($sqlCreateUser);
        try {
            if ($stmt->execute(array(
                "t" => $Ad->title,
                "d" => $Ad->description,
                "gc" => $Ad->gender,
                "sic" => $Ad->size,
                "bc" => $Ad->brand,
                "mc" => $Ad->model,
                "stc" => $Ad->state,
                "p" => $Ad->price,
                "un" => $Ad->nickname
            ))) {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
