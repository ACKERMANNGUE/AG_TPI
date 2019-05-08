<?php
/* Titre : Connexion à la base de données en utilisant un Singleton
 * Date : Mardi, 20.11.2017
 * Auteurs : M. Aigroz
 * Version : 1.0
 */
require_once __DIR__ . '/../config/config.inc.php';

class Database {

    private static $pdoInstance;

    /**
     * @brief   Class Constructor - Créer une nouvelle connextion à la database si la connexion n'existe pas
     *          On la met en privé pour que personne puisse créer une nouvelle instance via ' = new KDatabase();'
     */
    private function __construct() {
        
    }

    /**
     * @brief   Comme le constructeur, on rend __clone privé pour que personne ne puisse cloner l'instance
     */
    private function __clone() {
        
    }

    /**
     * @brief   Retourne l'instance de la Database ou créer une connexion initiale
     * @return $objInstance;
     */
    public static function getInstance() {
        if (!self::$pdoInstance) {
            try {

                $dsn = EDB_DBTYPE . ':host=' . EDB_HOST . ';port=' . EDB_PORT . ';dbname=' . EDB_DBNAME.";charset=utf8";
                self::$pdoInstance = new PDO($dsn, EDB_USER, EDB_PASS);
                self::$pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "EDatabase Error: " . $e->getMessage();
            }
        }
        return self::$pdoInstance;
    }

# end method
    /**
     * @brief   Passes on any static calls to this class onto the singleton PDO instance
     * @param   $chrMethod      The method to call
     * @param   $arrArguments   The method's parameters
     * @return  $mix            The method's return value
     */

    final public static function __callStatic($chrMethod, $arrArguments) {
        $pdo = self::getInstance();
        return call_user_func_array(array($pdo, $chrMethod), $arrArguments);
    }

# end method
}
