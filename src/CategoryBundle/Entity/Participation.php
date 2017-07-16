<?php

namespace CategoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="CategoryBundle\Repository\ParticipationRepository")
 */
class Participation
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
     * Many Participations have One Spectacle.
     * @ORM\ManyToOne(targetEntity="CategoryBundle\Entity\Spectacle", inversedBy="participations", cascade={"all"})
     * @ORM\JoinColumn(name="spectacle_id", referencedColumnName="id")
     */
    private $spectacle;
    
    /**
     * Many Participations have Many Category.
     * @ORM\ManyToMany(targetEntity="CategoryBundle\Entity\Category", inversedBy="participations")
     * @ORM\JoinTable(name="participations_categories")
     */
    private $category;
    
    /**
     * Many Participations have Many Users.
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="participations", cascade={"all"})
     * @ORM\JoinTable(name="participations_users")
     */
    private $users;
    
    

    public function __construct() {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString() {
        $categories = $this->getCategory();
        $stringCat = " ";
        for($i = 0; $i < count($categories); ++$i){
            $stringCat = $stringCat." ".$categories[$i]->getNom();
        }
        return (string) $this->getSpectacle().$stringCat;
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
     * Set spectacle
     *
     * @param \CategoryBundle\Entity\Spectacle $spectacle
     *
     * @return Participation
     */
    public function setSpectacle(\CategoryBundle\Entity\Spectacle $spectacle = null)
    {
        $this->spectacle = $spectacle;

        return $this;
    }

    /**
     * Get spectacle
     *
     * @return \CategoryBundle\Entity\Spectacle
     */
    public function getSpectacle()
    {
        return $this->spectacle;
    }

    /**
     * Add category
     *
     * @param \CategoryBundle\Entity\Category $category
     *
     * @return Participation
     */
    public function addCategory(\CategoryBundle\Entity\Category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \CategoryBundle\Entity\Category $category
     */
    public function removeCategory(\CategoryBundle\Entity\Category $category)
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
     * Add user
     *
     * @param \UserBundle\Entity\user $user
     *
     * @return Participation
     */
    public function addUser(\UserBundle\Entity\user $user)
    {
        $this->users->add($user);

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\user $user
     */
    public function removeUser(\UserBundle\Entity\user $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    
}
