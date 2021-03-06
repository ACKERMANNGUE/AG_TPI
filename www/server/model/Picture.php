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
 * sur une Image
 */
class Picture
{
    /** @var int L'id de l'annonce à laquelle l'image est reliée */
    public $idAd;
    /** @var int L'ordre d'ajout de l'image */
    public $index;
    /** @var string L'image encodée en base64 */
    public $img;
    

    public function __construct($paramIdAd = -1, $paramIndex = -1, $paramImg ="")
    {
        $this->idAd = $paramIdAd;
        $this->index = $paramIndex;
        $this->img = $paramImg;
        
    }
}
