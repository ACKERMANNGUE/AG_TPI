<?php
/**
 * @author Ackermann Gawen
 * Cette classe contient les informations
 * sur une personne (utilisateur) inscrite sur Seconde Main
 */

class User
{
    /** @var string L'email de la personne */
    public $email;
    /** @var string Le pseudo de la personne */
    public $nickname;
    /** @var string Le prénom de la personne */
    public $firstname;
    /** @var string Le nom de famille de la personne */
    public $lastname;
    /** @var string Le N° de téléphone de la personne */
    public $phone;
    /** @var string Le code du pays de résidence de la personne */
    public $country;
    /** 
     * @var integer Le code du rôle de la personne :
     *          - Utilisateur
     *          - Administrateur
     */
    public $role;

    /** @var string Le mot de passe de la personne */
    public $pswd;

      /** @var string Le status de la personne */
      public $status;


    public function __construct($paramEmail, $paramNickname, $paramFirstname, $paramLastname, $paramPhone, $paramCountry, $paramRole, $paramPswd, $paramStatus){
        $this->email = $paramEmail;
        $this->nickname = $paramNickname;
        $this->firstname = $paramFirstname;
        $this->lastname = $paramLastname;
        $this->phone = $paramPhone;
        $this->country = $paramCountry;
        $this->role = $paramRole;
        $this->pswd = $paramPswd;
        $this->status = $paramStatus;
    }
}
