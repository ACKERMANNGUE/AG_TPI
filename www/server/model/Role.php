<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */

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
    /** @var int Le code du rôle */
    public $code;
    /** @var string Le libellé du rôle */
    public $label;

    public function __construct($paramCode=-1, $paramLabel="")
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
