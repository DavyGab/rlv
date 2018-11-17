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
	$this->roles = array('ROLE_ADMIN');
    }
}
