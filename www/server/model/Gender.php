<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les informations
 * des différents types
 * 
 * Liste des Types :
 *            - Femme
 *            - Homme
 *            - Unisexe
 */

class Gender
{
    /** @var string Le code du type */
    public $code;
    /** @var string Le libellé du type */
    public $label;

    public function __construct($paramCode, $paramLabel)
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
