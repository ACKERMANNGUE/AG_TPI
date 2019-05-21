<?php
/**
 * @brief	Objet Role
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new ERole();
 *          $u->IdRole = 1;
 *          $u->Name = "Admin";
 * 
 *          Exemple d'utilisation 2
 *          $u = new ERole(1, "Admin");
 */
class SessionManager {

    /**
     * @brief Assigner un objet User dans la session
     * @param User user l'objet user
     */
    public static function SetUser($user)
    {
        $_SESSION['User'] = serialize($user);
    }

    public static function GetUser()
    {
        if (isset($_SESSION['User']))
        {
            return unserialize($_SESSION['User']);
        }
        return false;
    }

    /**
     * @brief Assigner le pseudonyme de l'utilisateur dans la session
     * @param string le pseudonyme de l'utilisateur
     */
    public static function SetNickname($nickname)
    {
        $_SESSION['NICKNAME'] = $nickname;
    }

    public static function GetNickname()
    {
        if (isset($_SESSION['NICKNAME']))
        {
            return $_SESSION['NICKNAME'];
        }
        return false;
    }

    /**
     * @brief Assigner un objet User dans la session
     * @param User user l'objet user
     */
    public static function SetRole($idRole)
    {
        $_SESSION['ROLE'] = $idRole;
    }

    public static function GetRole()
    {
        if (isset($_SESSION['ROLE']))
        {
            return intval($_SESSION['ROLE']);
        }
        return false;
    }
}
