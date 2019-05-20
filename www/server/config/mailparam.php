<?php
/**
 * @remark	Remplir correctement les constantes ci-dessous en fonction de votre compte pour l'envoi
 *          d'email. On utilise un compte google et le serveur smtp de google.
 * 
 *          Si vous utilisez un compte google, il faut aller dans les paramètres du compte google
 *          sous Security
 *          il faut turn on "Less secure app access"
 *          Sans quoi vous ne pourrez pas envoyer des emails, vous recevrez le message
 *          --------
 *          Expected response code 250 but got code "535", with message "535-5.7.8 Username and Password not accepted. 
 *          Learn more at 535 5.7.8 https://support.google.com/mail/?p=BadCredentials w16sm74990200wrt.84 - gsmtp "
 *          --------
 */

/*
 * @brief Email constants
 */
define('EMAIL_SERVER', "smtp.gmail.com");
define('EMAIL_PORT', 465);
define('EMAIL_TRANS', "ssl");
define('EMAIL_USERNAME', "botSecondHand@gmail.com");
define('EMAIL_PASSWORD', "SecondeMain2019TPI");
