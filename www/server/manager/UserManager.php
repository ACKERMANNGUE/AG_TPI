<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les fonctions
 * traitant ou récupérant des données concernant un utilisateur
 */

class UserManager
{
    /**
     * Fonction récupérant les informations de tous les utilisateurs
     * @return User[] Les informations des utilisateurs
     */
    public static function getUsers()
    {
        $sqlGetInfosUser = "SELECT EMAIL, NICKNAME, FIRSTNAME, LASTNAME, PSWD, PHONE, COUNTRIES_ISOCODE, ROLES_CODE FROM users";
        $stmt = Database::prepare($sqlGetInfosUser);
        try {
            $arrResult = [];
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $u) {
                        array_push($arrResult, new User($u["EMAIL"], $u["NICKNAME"], $u["FIRSTNAME"], $u["LASTNAME"], $u["PHONE"], $u["COUNTRIES_ISOCODE"], $u["ROLES_CODE"], $u["PSWD"]));
                    }
                    return $arrResult;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction récupérant les informations d'un utilisateur
     * @param string Le pseudonyme de l'utilisateur
     * @return User Les informations de l'utilisateur
     */
    public static function getUserByNickname($nickname)
    {
        $sqlGetInfosUser = "SELECT EMAIL, NICKNAME, FIRSTNAME, LASTNAME, PSWD, PHONE, COUNTRIES_ISOCODE, ROLES_CODE FROM users WHERE NICKNAME = :n";
        $stmt = Database::prepare($sqlGetInfosUser);
        try {
            if ($stmt->execute(array(
                "n" => $nickname
            ))) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    return new User($res["EMAIL"], $res["NICKNAME"], $res["FIRSTNAME"], $res["LASTNAME"], $res["PHONE"], $res["COUNTRIES_ISOCODE"], $res["ROLES_CODE"], $res["PSWD"]);
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction créant un utilisateur
     * @param User Les informations de l'utilisateur
     * @return boolean True si OK, False si problème d'insertion
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
                "p" => sha1($User->pswd),
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
     * Fonction vérifiant l'existence  d'un utilisateur
     * @param string L'email de l'utilisateur
     * @return Boolean True si OK, False si inexistant
     */
    public static function UserExist($email)
    {
        $sqlUserExist = "SELECT * FROM users WHERE EMAIL = :e";
        $stmt = Database::prepare($sqlUserExist);
        try {
            if ($stmt->execute(array(
                "e" => $email
            ))) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    return true;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Fonction connectant un utilisateur
     * @param string L'email de l'utilisateur
     * @param string Le mot de passe de l'utilisateur
     * @return Boolean True si OK, False si un champ est incorrect 
     */
    public static function Connection($email, $pwd)
    {
        if (UserManager::UserExist($email)) {
            $userInfo = UserManager::getUserByEmail($email);
            $pwdUser = $userInfo["PSWD"];
            $pwdHashed = sha1($pwd);
            if ($pwdUser === $pwdHashed) {
                return true;
            }
            return false;
        }
    }
}
