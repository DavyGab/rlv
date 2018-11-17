<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $slug;
    
     /**
     * @var \Doctrine\Common\Collections\Collection|Video[]
     *
     * @ORM\ManyToMany(targetEntity="Video", mappedBy="categories")
     */
    private $videos;
}