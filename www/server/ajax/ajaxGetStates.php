<?php

require_once '../inc/inc.all.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');


$states = StateManager::getAllStates();
if (count($states) > 0) {
    echo '{ "ReturnCode": 0, "States": ' . json_encode($states) . '}';
    exit();
}

echo '{ "ReturnCode": 2, "Message": "Erreur lors du chargement des états"}';
exit();
