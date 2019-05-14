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
    public static function insertPicturesForAd($id)
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
        for ($i = 0; $i < count($_FILES['filesToUpload']['name']); $i++) {
            if (!isset($_FILES['filesToUpload']['name'][$i]) || !is_uploaded_file($_FILES['filesToUpload']['tmp_name'][$i])) {
                echo ('Problème de transfert');
                exit;
            }
            /* Code créant à partir des infos du fichier une image en base64 : Code fournis par M. Aigroz */
            // Récupérer le contenu du fichier tmp
            $data = file_get_contents($_FILES['filesToUpload']['tmp_name'][$i]);
            // Récupérer le type MIME du fichier à l’aide de la classe finfo
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES['filesToUpload']['tmp_name'][$i]);
            // On créé la chaîne de caractères qui permettra de l’afficher directement dans l’attribut src d’un tag <img>
            // On utilise la fonction base64_encode pour transformer le contenu $data en base64
            $src = 'data:' . $mime . ';base64,' . base64_encode($data);



            $sqlInsertPictures = "INSERT INTO pictures (ADS_ID, INDEX_IMG, IMAGE) VALUES (:ai,:ix, :img)";
            $stmt = Database::prepare($sqlInsertPictures);

            try {
                if ($stmt->execute(array(
                    "ai" => intval($id),
                    "ix" => $cptINDEX,
                    "img" => $src
                ))) {
                    if (count($_FILES['filesToUpload']['name']) == $i) {
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
