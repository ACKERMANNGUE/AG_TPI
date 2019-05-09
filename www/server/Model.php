<?php
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
    /** @var string Le code du modèle */
    public $code;
    /** @var string Le libellé du modèle */
    public $label;

    public function __construct($paramCode, $paramLabel)
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
