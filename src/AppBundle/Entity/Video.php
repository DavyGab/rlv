<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Video
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
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */    
    private $title;
    
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */    
    private $videoUrl;
    
    /**
     * @ORM\Column(type="string", length=1000)
     *
     * @var string
     */    
    private $description;
        
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="videos")
     * @ORM\JoinColumn(name="speaker_id", referencedColumnName="id")
     */
    private $speaker;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */    
    private $website;
        
    /**
     * @var \Doctrine\Common\Collections\Collection|Category[]
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="videos")
     * @ORM\JoinTable(
     *  name="video_category",
     *  joinColumns={
     *      @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *  }
     * )
     */
    private $categories;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */    
    private $createdAt;
    
    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */    
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */    
    private $publishedAt;
  
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName", size="imageSize")
     * 
     * @var File
     */
    private $imageFile;   

    public function __construct() 
    {
        $this->createdAt = new \DateTime();        
        $this->updatedAt = new \DateTime();
        $this->publishedAt = new \DateTime();
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getSlug() 
    {
        return $this->slug;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function getVideoUrl() 
    {
        return $this->videoUrl;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function getSpeaker() 
    {
        return $this->speaker;
    }

    public function getWebsite() 
    {
        return $this->website;
    }

    public function getCategories() 
    {
        return $this->categories;
    }

    public function getCreatedAt() 
    {
        return $this->createdAt;
    }

    public function getUpdatedAt() 
    {
        return $this->updatedAt;
    }

    public function getPublishedAt() 
    {
        return $this->publishedAt;
    }

    public function getImageFile() {
        return $this->imageFile;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setVideoUrl($videoUrl) {
        $this->videoUrl = $videoUrl;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setSpeaker($speaker) {
        $this->speaker = $speaker;
    }

    public function setWebsite($website) {
        $this->website = $website;
    }

    public function setCategories(\Doctrine\Common\Collections\Collection $categories) {
        $this->categories = $categories;
    }

    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    public function setPublishedAt(\DateTime $publishedAt) {
        $this->publishedAt = $publishedAt;
    }

    public function setImageFile(File $imageFile) {
        $this->imageFile = $imageFile;
    }


    
    
}