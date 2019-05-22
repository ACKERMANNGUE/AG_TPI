<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once '../inc/inc.all.php';
$email = "gawen.ackrm@eduge.ch";
$r = UserManager::getUserByEmail($email);
if (count($r) > 0) {
        echo "Email : " . $r->email . " Pseudo : " . $r->nickname."</br>";
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
