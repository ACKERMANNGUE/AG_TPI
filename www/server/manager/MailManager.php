<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * envoyant les emails
 * 
 */

class MailManager
{
    /**
     * Fonction créant une instance SMTP
     * @return Swift_SmtpTransport SMTP 
     */
    public static function initMailer()
    {
        // On doit créer une instance de transport smtp avec les constantes
        // définies dans le fichier mailparam.php
        return Swift_SmtpTransport::newInstance(EMAIL_SERVER, EMAIL_PORT, EMAIL_TRANS)
            ->setUsername(EMAIL_USERNAME)
            ->setPassword(EMAIL_PASSWORD);
    }
    /**
     * Fonction envoyant un mail lors de la création de compte
     * @var string Le token de validation
     * @var string L'email de l'utilisateur
     * @return boolean True si ok, False si problème d'envois
     */
    public static function sendMailForTokenValidation($token, $emailUser)
    {
        $transport = MailManager::initMailer();
        try {
            // On crée un nouvelle instance de mail en utilisant le transport créé précédemment
            $mailer = Swift_Mailer::newInstance($transport);
            // On crée un nouveau message
            $message = Swift_Message::newInstance();
            // Le sujet du message
            $message->setSubject("Confirmation de votre compte");
            // Qui envoie le message 
            $message->setFrom(array(EMAIL_BOT_MAILER => "Seconde Main"));
            // A qui on envoie le message
            $message->setTo(array($emailUser));
            $mailInfos = "Vous vous êtes inscrit sur Seconde Main. Voici votre code de validation : <b>" . $token . "</b>";
            // Un petit message html
            // On peut bien évidemment avoir un message texte
            $body =
                '<html>' .
                ' <head></head>' .
                ' <body>' .
                '  <p>' . $mailInfos . '</p></br>' .
                ' <a href="http://127.0.0.1/validation.php?token=' . $token . '&email=' . $emailUser . '"><b>Clique ici pour valider ton compte</b></a>' .
                ' </body>' .
                '</html>';
            // On assigne le message et on dit de quel type.
            $message->setBody($body, 'text/html');
            //envoie du mail
            if ($mailer->send($message)) {
                return true;
            }
        } catch (Swift_TransportException $e) {
            echo "Problème d'envoi de message: " . $e->getMessage();
            return false;
        }
    }
    /**
     * Fonction envoyant un mail lors d'une demande d'achat
     * @var string Email de l'utilisateur qui achète le produit
     * @var string N° de téléphone de l'utilisateur qui achète le produit
     * @var string Email de l'utilisateur qui vend le produit
     * @var string Titre de l'annonce
     * @return boolean True si ok, False si problème d'envois
     */
    public static function sendMailForAPurchase($userWhoPurchase, $userPhone, $userWhoSell, $adTitle)
    {
        $transport = MailManager::initMailer();
        try {
            // On crée un nouvelle instance de mail en utilisant le transport créé précédemment
            $mailer = Swift_Mailer::newInstance($transport);
            // On crée un nouveau message
            $message = Swift_Message::newInstance();
            // Le sujet du message
            $message->setSubject("Demande d'achat");
            // Qui envoie le message 
            $message->setFrom(array(EMAIL_BOT_MAILER => "Seconde Main"));
            // A qui on envoie le message
            $message->setTo(array($userWhoSell));
            if ($userPhone != "") {
                $mailInfos = "Vous avez reçu une demande d'achat pour le produit ayant pour titre : <i>" . $adTitle . "</i> de la part de <b>" . $userWhoPurchase . "</b>. N° de Téléphone : " . $userPhone . " Pour continuer l'achat, veuillez vous adresser directement à cette personne dès à présent.";
            } else {
                $mailInfos = "Vous avez reçu une demande d'achat pour le produit ayant pour titre : <i>" . $adTitle . "</i> de la part de <b>" . $userWhoPurchase . "</b> Pour continuer l'achat, veuillez vous adresser directement à cette personne dès à présent.";
            }
            // Un petit message html
            // On peut bien évidemment avoir un message texte
            $body =
                '<html>' .
                ' <head></head>' .
                ' <body>' .
                '  <p>' . $mailInfos . '</p></br>' .
                ' </body>' .
                '</html>';
            // On assigne le message et on dit de quel type.
            $message->setBody($body, 'text/html');
            //envoie du mail
            if ($mailer->send($message)) {
                return true;
            }
        } catch (Swift_TransportException $e) {
            echo "Problème d'envoi de message: " . $e->getMessage();
            return false;
        }
    }
    /**
     * Fonction envoyant un mail lors du changement de status d'un utilisateur
     * @var string L'email de l'utilisateur
     * @var int L'id de status
     * @return boolean True si ok, False si problème d'envois
     */
    public static function sendMailWhenUsersStatusChange($emailUsersStatusModified, $status)
    {
        $transport = MailManager::initMailer();
        try {
            // On crée un nouvelle instance de mail en utilisant le transport créé précédemment
            $mailer = Swift_Mailer::newInstance($transport);
            // On crée un nouveau message
            $message = Swift_Message::newInstance();
            // Le sujet du message
            $message->setSubject("Changement de status pour votre compte");
            // Qui envoie le message 
            $message->setFrom(array(EMAIL_BOT_MAILER => "Seconde Main"));
            // A qui on envoie le message
            $message->setTo(array($emailUsersStatusModified));
            $mailInfos = "Votre compte à changer de status. Vous êtes actuellement considéré comme un utilisateur : <b>" . StatusManager::getStatusName($status) . "</b>";
            // Un petit message html
            // On peut bien évidemment avoir un message texte
            $body =
                '<html>' .
                ' <head></head>' .
                ' <body>' .
                '  <p>' . $mailInfos . '</p></br>' .
                ' </body>' .
                '</html>';
            // On assigne le message et on dit de quel type.
            $message->setBody($body, 'text/html');
            //envoie du mail
            if ($mailer->send($message)) {
                return true;
            }
        } catch (Swift_TransportException $e) {
            echo "Problème d'envoi de message: " . $e->getMessage();
            return false;
        }
    }/**
     * Fonction envoyant un mail lors du changement de l'état d'une annonce
     * @var string L'email de l'utilisateur
     * @var int L'id de l'état
     * @return boolean True si ok, False si problème d'envois
     */
    public static function sendMailWhenUsersAdsStateChange($emailOwnersAd, $state, $adTitle)
    {
        $transport = MailManager::initMailer();
        try {
            // On crée un nouvelle instance de mail en utilisant le transport créé précédemment
            $mailer = Swift_Mailer::newInstance($transport);
            // On crée un nouveau message
            $message = Swift_Message::newInstance();
            // Le sujet du message
            $message->setSubject("Changement d'état pour une de vos annonces postée");
            // Qui envoie le message 
            $message->setFrom(array(EMAIL_BOT_MAILER => "Seconde Main"));
            // A qui on envoie le message
            $message->setTo(array($emailOwnersAd));
            $mailInfos = "Votre annonce prénommé : <b>" . $adTitle . "</b> a changé d'état en une annonce <b>" . StateManager::getStatesName(intval($state)) . "</b>";
            // Un petit message html
            // On peut bien évidemment avoir un message texte
            $body =
                '<html>' .
                ' <head></head>' .
                ' <body>' .
                '  <p>' . $mailInfos . '</p></br>' .
                ' </body>' .
                '</html>';
            // On assigne le message et on dit de quel type.
            $message->setBody($body, 'text/html');
            //envoie du mail
            if ($mailer->send($message)) {
                return true;
            }
        } catch (Swift_TransportException $e) {
            echo "Problème d'envoi de message: " . $e->getMessage();
            return false;
        }
    }
}
