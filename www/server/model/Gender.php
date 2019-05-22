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

    public function __construct($paramCode=-1, $paramLabel="")
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
