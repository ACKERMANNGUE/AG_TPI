<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * récupérant / Ajoutant les données concernant les images d'une annonce
 */

class PictureManager
{
    /**
     * Fonction insérant dans l'ordre d'ajout de l'utilisateur 
     * les images choisies pour une annonce
     * @var int L'ID de l'annonce
     * @return boolean True si OK, False si problème d'insertion
     */
    public static function insertPicturesForAd($id, $imgBase64)
    {

        $sqlClearPictures = "DELETE FROM pictures WHERE ADS_ID = :ai";
        $stmt = Database::prepare($sqlClearPictures);
        try {
            $stmt->execute(array(
                "ai" => intval($id)
            ));
        } catch (PDOException $e) {
            return false;
        }

        $cptINDEX = 1;
        for ($i = 0; $i < count($imgBase64); $i++) {
            $sqlInsertPictures = "INSERT INTO pictures (ADS_ID, INDEX_IMG, IMAGE) VALUES (:ai,:ix, :img)";
            $stmt = Database::prepare($sqlInsertPictures);
            $src = $imgBase64[$i];
            try {
                if ($stmt->execute(array(
                    "ai" => intval($id),
                    "ix" => $cptINDEX,
                    "img" => $src
                ))) {
                    /* Rajout d'un car l'index est utilisé pour parcourir le tableau */ 
                    if (count($imgBase64) === $i + 1) {
                        return true;
                    }
                }
            } catch (PDOException $e) {
                return false;
            }
            $cptINDEX++;
        }
    }

    /**
     * Fonction récupérant les images d'une annonce
     * @var int L'id de l'annonce
     * @return Picture[] L(es) image(s) de l'annonce
     */
    public static function getPicturesForAnAd($id)
    {
        $arrResult = [];
        $sqlGetInfosAd = "SELECT ADS_ID, INDEX_IMG, IMAGE FROM pictures WHERE ADS_ID = :i";
        $stmt = Database::prepare($sqlGetInfosAd);
        try {
            if ($stmt->execute(array("i" => intval($id)))) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $r) {
                        array_push($arrResult, new Picture($r["ADS_ID"],  $r["INDEX_IMG"], $r["IMAGE"]));
                    }
                }
                return $arrResult;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
