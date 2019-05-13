<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les informations
 * des différents état de l'annonce
 * 
 * Liste des États :
 *            - À vendre
 *            - Vendue
 *            - En cours de vente
 *            - Supprimée
 *            - Suspendue
 */

class State
{
    /** @var int Le code de l'état de l'annonce */
    public $code;
    /** @var string Le libellé de l'état */
    public $label;

    public function __construct($paramCode, $paramLabel)
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
