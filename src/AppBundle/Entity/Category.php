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
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getVideos() {
        return $this->videos;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function setVideos(\Doctrine\Common\Collections\Collection $videos) {
        $this->videos = $videos;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}