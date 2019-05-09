<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les informations
 * des rôles
 * 
 * Liste des Rôles :
 *          - Utilisateur
 *          - Administrateur
 */

class Role
{
    /** @var string Le code du rôle */
    public $code;
    /** @var string Le libellé du rôle */
    public $label;

    public function __construct($paramCode, $paramLabel)
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
