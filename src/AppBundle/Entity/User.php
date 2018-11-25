<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */    
    private $lastName;
    
    /**
     * @ORM\Column(type="datetime")
     */    
    private $birthdate;
    
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $gender;

    public function __construct()
    {
        parent::__construct();
        // your own logic
	//$this->roles = array('ROLE_ADMIN');
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }  
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
    public function getUserRoles() {
        return implode(", ", $this->getRoles());
    }
}
