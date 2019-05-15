<?php

require_once '../inc/inc.all.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');
$idAd = -1;
if (isset($_POST["idAd"])) {
    $idAd = filter_input(INPUT_POST, 'idAd', FILTER_SANITIZE_NUMBER_INT);
}

$response = false;

if ($idAd > 0) {
    $response = PictureManager::getPicturesForAnAd($idAd);
    if ($response) {
        echo '{ "ReturnCode": 0, "ImageInBase64": ' . json_encode($response) . '}';
        exit();
    } else {
        echo '{ "ReturnCode": 2, "Message": "Erreur lors du chargement des images pour l\'annonce n° : ' . $idAd . '"}';
        exit();
    }
}
