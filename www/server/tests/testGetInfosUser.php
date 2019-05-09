<?php
include_once '../inc/inc.all.php';
$email = "gawen.ackrm@eduge.ch";
$r = UserManager::getUserByEmail($email);
if (count($r) > 0) {
        echo "Email : " . $r->email . " Pseudo : " . $r->nickname."</br>";
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
