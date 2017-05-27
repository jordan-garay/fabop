<?php

namespace InstitutionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Institution
 *
 * @ORM\Table(name="institution")
 * @ORM\Entity(repositoryClass="InstitutionBundle\Repository\InstitutionRepository")
 */
class Institution
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="LocationBundle\Entity\Location", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $location;
    
    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="institutions", cascade={"all"})
     */
    private $utilisateurs;
    
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
     * @return Institution
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
     * Set phone
     *
     * @param string $phone
     *
     * @return Institution
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set location
     *
     * @param \LocationBundle\Entity\Location $location
     *
     * @return Institution
     */
    public function setLocation(\LocationBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \LocationBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add utilisateur
     *
     * @param \UserBundle\Entity\User $utilisateur
     *
     * @return Institution
     */
    public function addUtilisateur(\UserBundle\Entity\User $utilisateur)
    {
        $this->utilisateurs[] = $utilisateur;
        $utilisateur->addInstitution($this);

        return $this;
    }

    /**
     * Remove utilisateur
     *
     * @param \UserBundle\Entity\User $utilisateur
     */
    public function removeUtilisateur(\UserBundle\Entity\User $utilisateur)
    {
        $this->utilisateurs->removeElement($utilisateur);
        $utilisateur->removeInstitution($this);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }
}
