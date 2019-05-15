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
     * @return Ad[] Les informations de l'annonce
     */
    public static function getAds()
    {
        $sqlGetInfosAds = "SELECT ID, users_NICKNAME ,TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME FROM ads";
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
        $sqlGetInfosAd = "SELECT ID, TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME FROM ads WHERE ID = :i";
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
     * Fonction récupérant les annonces postées par l'utilisateur connecté 
     * @var string Le pseudonyme de l'utilisateur
     * @return Ad[] Les informations de toutes les annonces de l'utilisateur
     */
    public static function getAdsFromUser($nickname)
    {
        $arrResult = [];
        $sqlGetInfosAd = "SELECT ID, TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME FROM ads WHERE users_NICKNAME = :n";
        $stmt = Database::prepare($sqlGetInfosAd);
        try {
            if ($stmt->execute(array("n" => $nickname))) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $r) {
                        array_push($arrResult, new Ad($r["ID"],  $r["users_NICKNAME"], $r["TITLE"], $r["DESCRIPTION"], $r["GENDERS_CODE"], $r["SIZES_CODE"], $r["BRANDS_CODE"], $r["MODELS_CODE"], $r["STATES_CODE"], $r["PRICE"], $r["DATE_POSTING"]));
                    }
                    return $arrResult;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction récupérant le pseudonyme du propriétaire de l'annonce
     * @var int L'id de l'annonce
     * @return string Le pseudonyme du propriétaire de l'annonce
     */
    public static function getAdsUsersNickname($idAd)
    {
        $sqlGetInfosAd = "SELECT users_NICKNAME FROM ads WHERE ID = :i";
        $stmt = Database::prepare($sqlGetInfosAd);
        try {
            if ($stmt->execute(array("i" => $idAd))) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    return $res["users_NICKNAME"];
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction créant une annonce 
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
                if (PictureManager::insertPicturesForAd(Database::lastInsertId(), null)) {
                    return true;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction modifiant une annonce 
     * @var Ad Les informations de l'annonce
     * @return boolean True si OK, False si problème de modification
     */
    public static function modifyAd($Ad, $pictures = null)
    {
        $sqlModifyAd = "UPDATE ads SET TITLE = :t, DESCRIPTION = :d, GENDERS_CODE = :gc, SIZES_CODE = :sic, 
        BRANDS_CODE = :bc, MODELS_CODE = :mc , STATES_CODE = :stc, PRICE = :p, DATE_POSTING = NOW(), users_NICKNAME = :un WHERE ID = :ia";
        $stmt = Database::prepare($sqlModifyAd);
        // On démarre la transaction au cas où une des tables ne pourra être mise à jour
        Database::beginTransaction();
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
                "un" => $Ad->nickname,
                "ia" => $Ad->id
            ))) {
                if ($pictures != null) {
                    if (PictureManager::insertPicturesForAd($Ad->id, $pictures) == false) {
                            // Un problème, on roll back les changements
                            Database::rollBack();
                            return false;
                        }
                }
                // C'est tout bon, on 
                Database::commit();
                return true;
            }
        } catch (PDOException $e) {
            // Un problème, on roll back les changements
            Database::rollBack();
        }
        // Si on arrive ici, on a rencontré un problème
        return false;
    }
    /**
     * Fonction modifiant l'état d'une annonce 
     * @var Ad Les informations de l'annonce
     * @return boolean True si OK, False si problème de modification
     */
    public static function modifyAdsState($Ad)
    {
        $sqlModifyAdsState = "UPDATE ads SET STATES_CODE = :stc WHERE ID = :ia";
        $stmt = Database::prepare($sqlModifyAdsState);
        try {
            if ($stmt->execute(array(
                "stc" => intval($Ad->state),
                "ia" => intval($Ad->id)
            ))) {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
