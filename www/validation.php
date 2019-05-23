<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';
$email = "";
$token = "";
if (isset($_GET["token"]) && isset($_GET["email"])) {
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_STRING);
}
$nickname = UserManager::getUserByEmail($email)->nickname;
if (UserManager::getTokenAndDateExpiration($nickname, $dateExpiration, $tokenUser))
    $dateExpiration = strtotime($dateExpiration);
if ($tokenUser === $token && $dateExpiration > strtotime("now")) {
    if (UserManager::modifyUsersStatus($nickname, STATUS_USER_VALIDATED)) {
        header("Location: accueil.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Validation du compte</title>
    <?php include_once "server/inc/head.inc.php"; ?>
</head>

<body>

</body>

</html>