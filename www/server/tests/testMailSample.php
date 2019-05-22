<!DOCTYPE html>
<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
/**
 * @remark Mettre le bon chemin d'accès à votre fichier contenant les constantes
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/config/mailparam.php';
// Inclure le fichier swift_required.php localisé dans le répertoire swiftmailer5
require_once $_SERVER['DOCUMENT_ROOT'].'/swiftmailer5/lib/swift_required.php';

?>
<html>
<!-- Cet exemple démontre comment envoyer un email avec SwiftMailer 5

     Le fichier contenant les paramètres d'envoi d'email doit être 
     mis à jour avec les données du serveur et du compte utilisé
     pour envoyer des emails.

     Il faut impérativement activer ssl dans le fichier php.ini
     Retrouver la ligne 
     ;extension=openssl
     et décommenter
     extension=openssl

     Redémarrer le serveur apache
-->     
<head>
<meta charset="utf-8">
<title>Mailing - Sample</title>
</head>
<body>
<?php

// On doit créer une instance de transport smtp avec les constantes
// définies dans le fichier mailparam.php
$transport = Swift_SmtpTransport::newInstance(EMAIL_SERVER, EMAIL_PORT, EMAIL_TRANS)
->setUsername(EMAIL_USERNAME)
->setPassword(EMAIL_PASSWORD);

try {
    // On crée un nouvelle instance de mail en utilisant le transport créé précédemment
    $mailer = Swift_Mailer::newInstance($transport);
    // On crée un nouveau message
    $message = Swift_Message::newInstance();
    // Le sujet du message
    $message->setSubject('Petit test de message');
    // Qui envoie le message 
    $message->setFrom(array('contact@kadeo.net' => 'Contact Kadeo'));
    // A qui on envoie le message
    $message->setTo(array('dominique.aigroz@edu.ge.ch'));

    // Un petit message html
    // On peut bien évidemment avoir un message texte
    $body = 
    '<html>' .
    ' <head></head>' .
    ' <body>'.
    '  <p>Un petit message envoyé avec Swift Mailer 5.</p>' .
    ' </body>' .
    '</html>';
    // On assigne le message et on dit de quel type. Dans notre exemple c'est du html
    $message->setBody($body,'text/html');
    // Maintenant il suffit d'envoyer le message
    $result = $mailer->send($message);

} catch (Swift_TransportException $e) {
	echo "Problème d'envoi de message: ".$e->getMessage();
	exit();
}

echo "Message envoyé à dominique.aigroz@edu.ge.ch";

?>
</body>
</html>