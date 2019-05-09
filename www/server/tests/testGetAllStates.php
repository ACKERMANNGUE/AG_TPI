<?php
include_once '../inc/inc.all.php';

$r = StateManager::getAllStates();
if (count($r) > 0) {
    foreach ($r as $b) {
        echo "LABEL : " . $b->label."</br>";
    }
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
