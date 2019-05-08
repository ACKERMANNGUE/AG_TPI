<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * traitant ou récupérant des données concernant un utilisateur
 */

class UserManager
{
    /**
     * Fonction récupérant les informations tous les utilisateurs
     */
    public static function getUsers()
    { }
    /**
     * Fonction récupérant les informations d'un utilisateur
     * @param string L'email de l'utilisateur
     */
    public static function getUserByEmail($email)
    { }
    /**
     * Fonction récupérant les informations d'un utilisateur
     * @param User Les informations de l'utilisateur
     */
    public static function createUser($User)
    {
        $sqlCreateUser = "INSERT INTO users (EMAIL, NICKNAME, FIRSTNAME, LASTNAME,PSWD, PHONE, COUNTRIES_ISOCODE, ROLES_CODE) VALUES (:e,:ni, :fn, :ln, :p, :ph, :ci, :rc)";
        $stmt = Database::prepare($sqlCreateUser);
        try {
            if ($stmt->execute(array(
                "e" => $User->email,
                "ni" => $User->nickname,
                "fn" => $User->firstname,
                "ln" => $User->lastname,
                "p" => $User->pswd,
                "ph" => $User->phone,
                "ci" => $User->country,
                "rc" => $User->role
            ))) {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction connectant un utilisateur
     * @param string L'email de l'utilisateur
     * @param string Le mot de passe de l'utilisateur 
     */
    public static function Connection($email, $pwd)
    {

        if (UserManager::UserExist($email)) {
            $userInfo = UserManager::getUserByEmail($email);
            $pwdUser = $userInfo[0]["PSWD"];
            $pwdHashed = sha1($pwd);
            if ($pwdUser === $pwdHashed) {
                return true;
            }
            return false;
        }
    }
}
