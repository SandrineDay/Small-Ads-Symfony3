<?php

namespace Annonces\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="Annonces\MainBundle\Repository\pictureRepository")
 */
class picture
{
    /**
     * @ORM\ManyToOne(targetEntity="Annonces\MainBundle\Entity\ad",inversedBy="pictures")
     * @ORM\JoinColumn(name="id_ad", referencedColumnName="id", onDelete="CASCADE")
     */
    private $ad;

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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var bool
     *
     * @ORM\Column(name="main", type="boolean")
     */
    private $main;

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
     * Set path
     *
     * @param string $path
     *
     * @return picture
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set main
     *
     * @param boolean $main
     *
     * @return picture
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return bool
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set ad
     *
     * @param \Annonces\MainBundle\Entity\ad $ad
     *
     * @return picture
     */
    public function setAd(\Annonces\MainBundle\Entity\ad $ad = null)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return \Annonces\MainBundle\Entity\ad
     */
    public function getAd()
    {
        return $this->ad;
    }
}
