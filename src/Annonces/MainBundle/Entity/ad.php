<?php

namespace Annonces\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Annonces\UserBundle\Entity\User;

/**
 * ad
 *
 * @ORM\Table(name="ad")
 * @ORM\Entity(repositoryClass="Annonces\MainBundle\Repository\adRepository")
 *
 */
class ad
{
    /**
     * @ORM\OneToMany(targetEntity="Annonces\MainBundle\Entity\answer",mappedBy="ad")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity="Annonces\MainBundle\Entity\picture",mappedBy="ad")
     */
    private $pictures;

    /**
     * @ORM\ManyToMany(targetEntity="Annonces\MainBundle\Entity\category",cascade={"persist"})
     */
    private $category;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="closed", type="boolean")
     */
    private $closed;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * Plusieurs Annonces (Many) pour (To) Un(One) User
     * @ORM\ManyToOne(targetEntity="Annonces\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id",onDelete="CASCADE")
     */
    private $author;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ad
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ad
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ad
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ad
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return ad
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return bool
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return ad
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Add category
     *
     * @param \Annonces\MainBundle\Entity\category $category
     *
     * @return ad
     */
    public function addCategory(\Annonces\MainBundle\Entity\category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Annonces\MainBundle\Entity\category $category
     */
    public function removeCategory(\Annonces\MainBundle\Entity\category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }



    /**
     * Add picture
     *
     * @param \Annonces\MainBundle\Entity\picture $picture
     *
     * @return ad
     */
    public function addPicture(\Annonces\MainBundle\Entity\picture $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \Annonces\MainBundle\Entity\picture $picture
     */
    public function removePicture(\Annonces\MainBundle\Entity\picture $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }
    /**
     * Constructor
     */
    public function __construct(User $author)
    {
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->setClosed(false);
        $this->setAuthor($author);
    }


    /**
     * Add answer
     *
     * @param \Annonces\MainBundle\Entity\answer $answer
     *
     * @return ad
     */
    public function addAnswer(\Annonces\MainBundle\Entity\answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \Annonces\MainBundle\Entity\answer $answer
     */
    public function removeAnswer(\Annonces\MainBundle\Entity\answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set author
     *
     * @param \Annonces\UserBundle\Entity\User $author
     *
     * @return ad
     */
    public function setAuthor(\Annonces\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Annonces\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
