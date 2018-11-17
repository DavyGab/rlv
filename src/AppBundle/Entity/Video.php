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
    private $video_url;
    
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
}