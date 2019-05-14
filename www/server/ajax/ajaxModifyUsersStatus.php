<?php

require_once '../inc/inc.all.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

$nickname = "";
if (isset($_POST["nickname"])) {
    $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);
}
$idStatus = -1;
if (isset($_POST["idStatus"])) {
    $idStatus = filter_input(INPUT_POST, 'idStatus', FILTER_SANITIZE_STRING);
}
$response = false;
if ($idStatus > 0 && count($nickname) > 0) {
    $response = UserManager::modifyUsersStatus($nickname, $idStatus);
    if ($response) {
        echo '{ "ReturnCode": 0, "Message": "Le changement de status s\'est bel et bien déroulé"}';
        exit();
    } else {
        echo '{ "ReturnCode": 2, "Message": "Erreur lors du changement du status pour l\'utilisateur : ' . $nickname . '"}';
        exit();
    }
}

