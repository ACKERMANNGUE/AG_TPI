<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once '../inc/inc.all.php';

$r = StateManager::getAllStates();
if (count($r) > 0) {
    foreach ($r as $b) {
        echo "LABEL : " . $b->label."</br>";
    }
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
