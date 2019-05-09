<?php
include_once '../inc/inc.all.php';

$r = ModelManager::getAllModels();
if (count($r) > 0) {
    foreach ($r as $b) {
        echo "Modèle : " . $b->label."</br>";
    }
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
