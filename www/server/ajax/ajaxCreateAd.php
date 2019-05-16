<?php

require_once '../inc/inc.all.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');


$idAd = -1;
if (isset($_POST["idAd"])) {
    $idAd = filter_input(INPUT_POST, 'idAd', FILTER_SANITIZE_NUMBER_INT);
}
$title = "";
if (isset($_POST["title"])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
}
$description = "";
if (isset($_POST["description"])) {
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
}
$brand = 0;
if (isset($_POST["brand"])) {
    $brand = intval(filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_NUMBER_INT));
}
$model = 0;
if (isset($_POST["model"])) {
    $model = intval(filter_input(INPUT_POST, 'model', FILTER_SANITIZE_NUMBER_INT));
}
$size = 0;
if (isset($_POST["size"])) {
    $size = intval(filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT));
}
$type = 0;
if (isset($_POST["gender"])) {
    $type = intval(filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_NUMBER_INT));
}
$state = 0;
if (isset($_POST["state"])) {
    $state = intval(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT));
}
$size = 0;
if (isset($_POST["size"])) {
    $size = intval(filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT));
}
$price = -1;
if (isset($_POST["price"])) {

    $price = floatval(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT));
}
$pictures = null;
if (isset($_POST["pictures"])) {
    $pictures = $_POST["pictures"];
}

$response = false;

if ($idAd != 0 && count($title) > 0 && count($description) > 0 && $brand != 0 
&& $model != 0 && $size != 0 && $type != 0 && $price != -1 && $pictures != null) {
    $Ad = new Ad(null, SessionManager::GetNickname(), $title, $description, $type, $size, $brand, $model, $state, $price, null);
    $response = AdManager::createAd($Ad, $pictures);
    if ($response) {
        echo '{ "ReturnCode": 0, "Message": "Le changement de l\'état s\'est bel et bien déroulé"}';
        exit();
    } else {
        echo '{ "ReturnCode": 2, "Message": "Erreur lors de la création de l\'annonce"}';
        exit();
    }
}
