<?php

namespace Jeanphilippe\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="Jeanphilippe\BlogBundle\Entity\ArticleRepository")
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
	/**
     * @var boolean
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication;

	/**
     * @ORM\OneToOne(targetEntity="Jeanphilippe\BlogBundle\Entity\Image", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(nullable=true)
	 */
    private $image;

	/**
     * @ORM\ManyToMany(targetEntity="Jeanphilippe\BlogBundle\Entity\Categorie")
	 */
    private $categories;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $titre;

	/**
     * @ORM\OneToMany(targetEntity="Jeanphilippe\BlogBundle\Entity\Commentaire", mappedBy="article", cascade={"persist", "remove"})
 	 */
    private $commentaires;	
	
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank()
      */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=125, nullable=true)
     * @Assert\NotBlank()
	 * @Assert\Length(min=3, max=10, minMessage="auteur > 3 ", maxMessage="auteur < 11 ")
     */
    private $auteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreation", type="datetime")
     * @Assert\DateTime()
     */
    private $datecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=125)
      */
    private $slug;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Article
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return Article
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime 
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }
	
	public function __construct()
	{
		$this->datecreation = new \DateTime();
		$this->publication  = true;
		$this->categories 	= new \Doctrine\Common\Collections\ArrayCollection();
		$this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
	}

    /**
     * Set publication
     *
     * @param boolean $publication
     * @return Article
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean 
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set image
     *
     * @param \JeanphilippeBlogBlundle\Entity\Image $image
     * @return Article
     */
    public function setImage( \Jeanphilippe\BlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \JeanphilippeBlogBlundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add categories
     *
     * @param \Jeanphilippe\BlogBundle\Entity\Categorie $categories
     * @return Article
     */
    public function addCategory(\Jeanphilippe\BlogBundle\Entity\Categorie $categorie)
    {
        $this->categories[] = $categorie;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Jeanphilippe\BlogBundle\Entity\Categorie $categories
     */
    public function removeCategory(\Jeanphilippe\BlogBundle\Entity\Categorie $categorie)
    {
        $this->categories->removeElement($categorie);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

  

    /**
     * Add commentaires
     *
     * @param \Jeanphilippe\BlogBundle\Entity\Commentaire $commentaires
     * @return Article
     */
    public function addCommentaire(\Jeanphilippe\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;

        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \Jeanphilippe\BlogBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\Jeanphilippe\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
