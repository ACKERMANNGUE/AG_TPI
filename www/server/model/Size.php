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
 * des différentes tailles d'habits
 * 
 * Liste des États :
 *            - XS
 *            - S
 *            - M
 *            - L
 *            - XL
 *            - XXL
 */
class Size
{
    /** @var int Le code de la taille */
    public $code;
    /** @var string Le libellé de la taille */
    public $label;

    public function __construct($paramCode=-1, $paramLabel="")
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
