<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once '../inc/inc.all.php';
$id = 14;
$r = AdManager::getAdsUsersNickname($id);
if ($r != false) {
        echo "Annonce de : " . $r ."</br>";
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
