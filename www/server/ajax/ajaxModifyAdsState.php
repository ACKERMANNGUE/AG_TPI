<?php

require_once '../inc/inc.all.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

$idAd = -1;
if (isset($_POST["idAd"])) {
    $idAd = filter_input(INPUT_POST, 'idAd', FILTER_SANITIZE_NUMBER_INT);
}
$idState = -1;
if (isset($_POST["idState"])) {
    $idState = filter_input(INPUT_POST, 'idState', FILTER_SANITIZE_NUMBER_INT);
}
$response = false;
$ad = new Ad($idAd, null, null, null, null, null, null, null, $idState, null, null);
if ($idAd > 0 && $idState > 0) {
    $response = AdManager::modifyAdsState($ad);
    if ($response) {
        echo '{ "ReturnCode": 0, "Message": "Le changement de l\'état s\'est bel et bien déroulé"}';
        exit();
    } else {
        echo '{ "ReturnCode": 2, "Message": "Erreur lors du changement de l\'état pour l\'annonce ayant pour titre : ' . AdManager::getAdById($idAd)->title . '"}';
        exit();
    }
}