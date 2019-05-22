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
 * des différentes modèles d'habits
 * 
 * Liste des Modèles disponibles :
 *            - T-Shirt
 *            - Pull-Over
 *            - Sweatshirt
 *            - Short
 *            - Chemise
 *            - Pantalon
 *            - Polo
 *            - Veste
 *            - K-Way
 *            - Manteau
 */
class Model
{
    /** @var int Le code du modèle */
    public $code;
    /** @var string Le libellé du modèle */
    public $label;

    public function __construct($paramCode=-1, $paramLabel="")
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
