<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les informations
 * sur une Annonce
 */

class Ad
{
    /** @var string L'email de la personne détenant l'annonce */
    public $email;
    /** @var string Le titre de l'annonce */
    public $title;
    /** @var string La description du produit */
    public $description;
    /** @var Gender Le type du produit */
    public $gender;
    /** @var Size  La taille du produit */
    public $size;
    /** @var Model  Le modèle du produit */
    public $model;
    /** @var State  L'état du produit */
    public $state;
    /** @var float  Le prix du produit */
    public $price;
    /** @var Datetime  La date de mise en ligne de l'annonce */
    public $postingDate;
}
