<?php 
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once '../inc/inc.all.php';

$user = new User("romain.prtt@eduge.ch", "ROROBocop", "Romain", "Peretti", "0788888888", "CH", 1, "lala");

if(UserManager::createUser($user)){
    echo "Trop bien, ça fonctionne !";
}else{
    echo "Dommage, c'est pas fonctionnel...";
}