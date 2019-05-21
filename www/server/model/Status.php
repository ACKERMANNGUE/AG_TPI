<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les informations
 * des différents status d'un utilisateur
 * 
 * Liste des États :
 *            - Validé
 *            - Bloqué
 */

class Status
{
    /** @var int Le code du status */
    public $code;
    /** @var string Le libellé du status */
    public $label;

    public function __construct($paramCode=-1, $paramLabel="")
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
