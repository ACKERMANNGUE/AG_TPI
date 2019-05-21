<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les informations
 * sur une Annonce
 */

class Ad
{
    /** @var int L'id de l'annonce */
    public $id;
    /** @var string Le pseudonynme de la personne détenant l'annonce */
    public $nickname;
    /** @var string Le titre de l'annonce */
    public $title;
    /** @var string La description du produit */
    public $description;
    /** @var int Le code du type du produit */
    public $gender;
    /** @var int  Le code de la taille du produit */
    public $size;
    /** @var int  Le code de la marque du produit */
    public $brand;
    /** @var int  Le code du modèle du produit */
    public $model;
    /** @var int  Le code de l'état du produit */
    public $state;
    /** @var float  Le prix du produit */
    public $price;
    /** @var Datetime  La date de mise en ligne de l'annonce */
    public $postingDate;

    public function __construct($paramId = -1, $paramNickname = "", $paramTitle= "", $paramDescription= "", $paramGender = -1, $paramSize= -1,$paramBrand= -1, $paramModel= -1, $paramState= -1, $paramPrice= -1, $paramPostingDate = null)
    {
        $this->id = $paramId;
        $this->nickname = $paramNickname;
        $this->title = $paramTitle;
        $this->description = $paramDescription;
        $this->gender = $paramGender;
        $this->size = $paramSize;
        $this->brand = $paramBrand;
        $this->model = $paramModel;
        $this->state = $paramState;
        $this->price = $paramPrice;
        $this->postingDate = $paramPostingDate;
    }
}
