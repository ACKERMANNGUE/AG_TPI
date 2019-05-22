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
        $sqlGetInfosAds = "SELECT ID, users_NICKNAME ,TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME FROM ads ORDER BY DATE_POSTING DESC";
        $stmt = Database::prepare($sqlGetInfosAds);
        $arrResult = [];
        try {

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
        return $arrResult;
    }
    /**
     * Fonction récupérant les informations d'une annnonce
     * @var int L'id de l'annonce
     * @return Ad Les informations de l'annonce
     */
    public static function getAdById($id)
    {
        $sqlGetInfosAd = "SELECT ID, TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME FROM ads WHERE ID = :i ORDER BY DATE_POSTING DESC";
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
        }return new Ad();
    }
    /**
     * Fonction récupérant les annonces postées par l'utilisateur connecté 
     * @var string Le pseudonyme de l'utilisateur
     * @return Ad[] Les informations de toutes les annonces de l'utilisateur
     */
    public static function getAdsFromUser($nickname)
    {
        $arrResult = [];
        $sqlGetInfosAd = "SELECT ID, TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME FROM ads WHERE users_NICKNAME = :n ORDER BY DATE_POSTING DESC";
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
        return $arrResult;
    }
    /**
     * Fonction récupérant le pseudonyme du propriétaire de l'annonce
     * @var int L'id de l'annonce
     * @return string Le pseudonyme du propriétaire de l'annonce, False si annonce inexistante
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
        }return false;
    }
    /**
     * Fonction récupérant les annonces selon le filtre appliqué
     * @var int Le prix minimum du produit
     * @var int Le prix maximum du produit
     * @var int La marque du produit
     * @var int Le modèle du produit
     * @var int La taille du produit
     * @var int Le type du produit
     * @var int L'état de l'annonce
     * @return string Le pseudonyme du propriétaire de l'annonce
     */
    public static function getAdsWithFilter($minPrice = null, $maxPrice = null, $brand = null, $model = null, $size = null, $type = null, $state = null)
    {
        $arrVariables = [];
        $sqlGetInfosAd = "SELECT ID, TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME FROM ads";
        if ($minPrice != null && $maxPrice != null) {
            if (count($arrVariables) == 0) {
                $sqlGetInfosAd .= " WHERE PRICE BETWEEN :pMin AND :pMax";
            } else {
                $sqlGetInfosAd .= " AND PRICE BETWEEN :pMin AND :pMax";
            }
            $arrVariables['pMin'] = $minPrice;
            $arrVariables['pMax'] = $maxPrice;
        } else {
            if ($minPrice != null) {
                if (count($arrVariables) == 0) {
                    $sqlGetInfosAd .= " WHERE PRICE >= :pMin";
                } else {
                    $sqlGetInfosAd .= " AND PRICE >= :pMin";
                }
                $arrVariables['pMin'] = $minPrice;
            }
            if ($maxPrice != null) {
                if (count($arrVariables) == 0) {
                    $sqlGetInfosAd .= " WHERE PRICE <= :pMax";
                } else {
                    $sqlGetInfosAd .= " AND PRICE <= :pMax";
                }
                $arrVariables['pMax'] = $maxPrice;
            }
        }
        if ($brand != null) {
            if (count($arrVariables) == 0) {
                $sqlGetInfosAd .= " WHERE BRANDS_CODE = :bc";
            } else {
                $sqlGetInfosAd .= " AND BRANDS_CODE = :bc";
            }
            $arrVariables['bc'] = $brand;
        }
        if ($model != null) {
            if (count($arrVariables) == 0) {
                $sqlGetInfosAd .= " WHERE MODELS_CODE = :mc";
            } else {
                $sqlGetInfosAd .= " AND MODELS_CODE = :mc";
            }
            $arrVariables['mc'] = $model;
        }
        if ($size != null) {
            if (count($arrVariables) == 0) {
                $sqlGetInfosAd .= " WHERE SIZES_CODE = :sc";
            } else {
                $sqlGetInfosAd .= " AND SIZES_CODE = :sc";
            }
            $arrVariables['sc'] = $size;
        }
        if ($state != null) {
            if (count($arrVariables) == 0) {
                $sqlGetInfosAd .= " WHERE STATES_CODE = :stc";
            } else {
                $sqlGetInfosAd .= " AND STATES_CODE = :stc";
            }
            $arrVariables['stc'] = $state;
        }
        if ($type != null) {
            if (count($arrVariables) == 0) {
                $sqlGetInfosAd .= " WHERE GENDERS_CODE = :gc";
            } else {
                $sqlGetInfosAd .= " AND GENDERS_CODE = :gc";
            }
            $arrVariables['gc'] = $type;
        }
        $sqlGetInfosAd .= " ORDER BY DATE_POSTING DESC";
        $arrResult = [];
        $stmt = Database::prepare($sqlGetInfosAd);
        try {
            if ($stmt->execute($arrVariables)) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $r) {
                        array_push($arrResult, new Ad(intval($r["ID"]),  $r["users_NICKNAME"], $r["TITLE"], $r["DESCRIPTION"], intval($r["GENDERS_CODE"]), intval($r["SIZES_CODE"]), intval($r["BRANDS_CODE"]), intval($r["MODELS_CODE"]), intval($r["STATES_CODE"]), floatval($r["PRICE"]), $r["DATE_POSTING"]));
                    }
                    return $arrResult;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction créant une annonce 
     * @var Ad Les informations de l'annonce
     * @var Tableau d'images encodées en Base 64
     * @return boolean True si OK, False si problème d'insertion
     */
    public static function createAd($Ad, $pictures)
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
                if (PictureManager::insertPicturesForAd(Database::lastInsertId(), $pictures)) {
                    return true;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction récupérant les annonces selon le filtre appliqué
     * @var int Le prix minimum du produit
     * @var int Le prix maximum du produit
     * @var int La marque du produit
     * @var int Le modèle du produit
     * @var int La taille du produit
     * @var int Le type du produit
     * @var int L'état de l'annonce
     * @var int Le pseudo du détenteur de l'annonce
     * @return Ad[] Le pseudonyme du propriétaire de l'annonce, False si aucun record
     */
    public static function getAdsFromUserWithFilter($minPrice = null, $maxPrice = null, $brand = null, $model = null, $size = null, $type = null, $state = null, $nickname)
    {
        $arrResult = [];
        $arrVariables = [];
        $sqlGetInfosAd = "SELECT ID, TITLE, DESCRIPTION, GENDERS_CODE, SIZES_CODE, BRANDS_CODE, MODELS_CODE, STATES_CODE, PRICE, DATE_POSTING, users_NICKNAME FROM ads WHERE users_NICKNAME = :n";
        $arrVariables["n"] = $nickname;
        if ($minPrice != null && $maxPrice != null) {
            $sqlGetInfosAd .= " AND PRICE BETWEEN :pMin AND :pMax";

            $arrVariables['pMin'] = $minPrice;
            $arrVariables['pMax'] = $maxPrice;
        } else {
            if ($minPrice != null) {
                $sqlGetInfosAd .= " AND PRICE >= :pMin";

                $arrVariables['pMin'] = $minPrice;
            }
            if ($maxPrice != null) {
                $sqlGetInfosAd .= " AND PRICE <= :pMax";

                $arrVariables['pMax'] = $maxPrice;
            }
        }
        if ($brand != null) {
            $sqlGetInfosAd .= " AND BRANDS_CODE = :bc";

            $arrVariables['bc'] = $brand;
        }
        if ($model != null) {
            $sqlGetInfosAd .= " AND MODELS_CODE = :mc";

            $arrVariables['mc'] = $model;
        }
        if ($size != null) {
            $sqlGetInfosAd .= " AND SIZES_CODE = :sc";

            $arrVariables['sc'] = $size;
        }
        if ($state != null) {
            $sqlGetInfosAd .= " AND STATES_CODE = :stc";

            $arrVariables['stc'] = $state;
        }
        if ($type != null) {
            $sqlGetInfosAd .= " AND GENDERS_CODE = :gc";

            $arrVariables['gc'] = $type;
        }
        $sqlGetInfosAd .= " ORDER BY DATE_POSTING DESC";

        $stmt = Database::prepare($sqlGetInfosAd);
        try {
            if ($stmt->execute($arrVariables)) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $r) {
                        array_push($arrResult, new Ad(intval($r["ID"]),  $r["users_NICKNAME"], $r["TITLE"], $r["DESCRIPTION"], intval($r["GENDERS_CODE"]), intval($r["SIZES_CODE"]), intval($r["BRANDS_CODE"]), intval($r["MODELS_CODE"]), intval($r["STATES_CODE"]), floatval($r["PRICE"]), $r["DATE_POSTING"]));
                    }
                    return $arrResult;
                } 
            }
        } catch (PDOException $e) {
            return false;
        }
        return false;
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
