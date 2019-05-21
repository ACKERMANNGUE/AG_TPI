<?php

require_once '../inc/inc.all.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');


$idAd = -1;
if (isset($_POST["idAd"])) {
    $idAd = intval(filter_input(INPUT_POST, 'idAd', FILTER_SANITIZE_NUMBER_INT));
}
$emailPurchaser = "";
if (isset($_POST["emailPurchaser"])) {
    $emailPurchaser = filter_input(INPUT_POST, 'emailPurchaser', FILTER_SANITIZE_EMAIL);
}
$phone = "";
if (isset($_POST["phone"])) {
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
}


$response = false;

if ($idAd != 0 && count($emailPurchaser) > 0) {
    $userWhoSell = UserManager::getUserByNickname(AdManager::getAdsUsersNickname($idAd));
    $ad = AdManager::getAdById($idAd);
    $ad->state = STATE_PENDING_SOLD;
    if (AdManager::modifyAdsState($ad)) {
        if (MailManager::sendMailForAPurchase($emailPurchaser, $phone, $userWhoSell->email, $ad->title)) {
            echo '{ "ReturnCode": 0, "Message": "La demande d\'achat à bien été envoyé !"}';
            exit();
        }
    }
    echo '{ "ReturnCode": 2, "Message": "Erreur lors de l\'achat de l\'annonce ayant pour titre : ' . $ad->title . '"}';
    exit();
}
