<?php
include_once '../inc/inc.all.php';
//$tokenInBase = "16d2462cd51b5cb00bb8b8cce31467de";
$token = "";
if(isset($_GET["token"])){
    $token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_STRING);
}
$user = new User("khalil.mddb@eduge.ch", "Hinormarrant", "Khalil", "Meddeb", "8882274757", "CH", 1, "5f6955d227a320c7f1f6c7da2a6d96a851a8118f", 1);
$nickname = $user->nickname;
$tokenUser = ""; 
$dateExpiration = 0;

if (UserManager::getTokenAndDateExpiration($nickname, $dateExpiration, $tokenUser))
$dateExpiration = strtotime($dateExpiration);
if ($tokenUser === $token && $dateExpiration > strtotime("now")) {
    echo "Trop bien, ça fonctionne !";
    UserManager::modifyUsersStatus($user->nickname, STATUS_USER_VALIDATED);
} else {
    echo "Dommage, la date d'échéance est arrivée à terme";
}
