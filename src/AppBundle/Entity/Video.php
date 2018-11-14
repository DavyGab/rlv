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
     * @ORM\Column(type="integer")
     *
     * @var integer
     */    
    private $speaker;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */    
    private $website;
        
    /**
     * One video has one category.
     * @OneToOne(targetEntity="Category")
     * @JoinColumn(name="category", referencedColumnName="id")
     */
    private $category;

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