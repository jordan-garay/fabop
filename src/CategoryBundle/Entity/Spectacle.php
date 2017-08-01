<?php

namespace CategoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Spectacle
 *
 * @ORM\Table(name="spectacle")
 * @ORM\Entity(repositoryClass="CategoryBundle\Repository\SpectacleRepository")
 */
class Spectacle
{
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dateSpectacle", type="string", length=255)
     */
    private $dateSpectacle;

    /**
     * @var string
     *
     * @ORM\Column(name="annee", type="string", length=255)
     */
    private $annee;
    
    /**
     * One Spectacle has Many Participations.
     * @ORM\OneToMany(targetEntity="CategoryBundle\Entity\Participation", mappedBy="spectacle")
     */
    private $participations;
    // ...

    public function __construct() {
        $this->participations = new ArrayCollection();
    }
    
    public function __toString() {
        return (string) $this->getNom();
    }


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Spectacle
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set annee
     *
     * @param string $annee
     *
     * @return Spectacle
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Add participation
     *
     * @param \CategoryBundle\Entity\Participation $participation
     *
     * @return Spectacle
     */
    public function addParticipation(\CategoryBundle\Entity\Participation $participation)
    {
        $this->participations[] = $participation;

        return $this;
    }

    /**
     * Remove participation
     *
     * @param \CategoryBundle\Entity\Participation $participation
     */
    public function removeParticipation(\CategoryBundle\Entity\Participation $participation)
    {
        $this->participations->removeElement($participation);
    }

    /**
     * Get participations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipations()
    {
        return $this->participations;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Spectacle
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set dateSpectacle
     *
     * @param string $dateSpectacle
     *
     * @return Spectacle
     */
    public function setDateSpectacle($dateSpectacle)
    {
        $this->dateSpectacle = $dateSpectacle;

        return $this;
    }

    /**
     * Get dateSpectacle
     *
     * @return string
     */
    public function getDateSpectacle()
    {
        return $this->dateSpectacle;
    }
}
