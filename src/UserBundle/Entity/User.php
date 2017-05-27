<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="newsletter", type="boolean")
     */
    protected $newsletter;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="LocationBundle\Entity\Location", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $location;
    
    /**
     * @var Categories
     *
     * @ORM\ManyToMany(targetEntity="Application\Sonata\ClassificationBundle\Entity\Category", mappedBy="users")
     */
    private $categories;
    
    /**
     * @var Institution
     *
     * @ORM\ManyToMany(targetEntity="InstitutionBundle\Entity\Institution", mappedBy="utilisateurs")
     * @ORM\JoinTable(name="institutions_users",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="institutions_id", referencedColumnName="id",nullable=true)})
     */

    private $institutions;


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
     * Set newsletter
     *
     * @param boolean $newsletter
     * @return User
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean 
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set location
     *
     * @param \LocationBundle\Entity\Location $location
     *
     * @return User
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
     * Add category
     *
     * @param \ClassificationBundle\Entity\Category $category
     *
     * @return User
     */
    public function addCategory(\ClassificationBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \ClassificationBundle\Entity\Category $category
     */
    public function removeCategory(\ClassificationBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
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
     * Add institution
     *
     * @param \InstitutionBundle\Entity\Institution $institution
     *
     * @return User
     */
    public function addInstitution(\InstitutionBundle\Entity\Institution $institution)
    {
        $this->institutions[] = $institution;
        $institution->addUtilisateur($this);

        return $this;
    }

    /**
     * Remove institution
     *
     * @param \InstitutionBundle\Entity\Institution $institution
     */
    public function removeInstitution(\InstitutionBundle\Entity\Institution $institution)
    {
        $this->institutions->removeElement($institution);
        $institution->removeUtilisateur($this);
    }

    /**
     * Get institutions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstitutions()
    {
        return $this->institutions;
    }
}
