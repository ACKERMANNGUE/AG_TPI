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
 * des pays
 * (La liste des pays est trouvable et téléchargeable à cette adresse : https://datahub.io/core/country-list#resource-country-list_zip)
 */
class Country
{
    /** @var string Le code ISO du pays */
    public $isocode;
    /** @var string Le libellé du pays */
    public $label;

    public function __construct($paramIsocode="", $paramLabel="")
    {
        $this->isocode = $paramIsocode;
        $this->label = $paramLabel;
    }
}
