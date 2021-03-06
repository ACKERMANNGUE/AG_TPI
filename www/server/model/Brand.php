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
 * des différentes marques
 * 
 * Liste des Marques :
 *            - Nike
 *            - Puma
 *            - Adidas
 *            - Obey
 *            - H&M
 *            - Balmain
 *            - Pépé Jeans
 *            - Champion
 *            - Reebok
 *            - Ralph Lauren
 *            - Levis
 *            - Fila
 *            - Champion
 *            - Tommy Hilfiger
 *            - K-Way
 */
class Brand
{
    /** @var int Le code de la marque */
    public $code;
    /** @var string Le libellé de la marque */
    public $label;


    public function __construct($paramCode="", $paramLabel="")
    {
        $this->code = $paramCode;
        $this->label = $paramLabel;
    }
}
