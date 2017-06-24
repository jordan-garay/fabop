<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use SendinBlue\SendinBlueApiBundle\Wrapper\Mailin;
new \Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser {

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
     * @var Institution
     *
     * @ORM\ManyToMany(targetEntity="InstitutionBundle\Entity\Institution", mappedBy="utilisateurs", cascade={"all"})
     * @ORM\JoinTable(name="institutions_users",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="institutions_id", referencedColumnName="id",nullable=true)})
     */
    private $institutions;
    
     /**
     * Many Users have Many Participation.
     * @ORM\ManyToMany(targetEntity="CategoryBundle\Entity\Participation", mappedBy="users")
     */
    private $participations;

    public function __construct() {
        $this->participations = new ArrayCollection();
        $this->institutions = new ArrayCollection();
    }
    
    public function __toString() {
        parent::__toString();
        return (string) $this->getUsername();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     * @return User
     */
    public function setNewsletter($newsletter) {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean 
     */
    public function getNewsletter() {
        return $this->newsletter;
    }

    /**
     * Set location
     *
     * @param \LocationBundle\Entity\Location $location
     *
     * @return User
     */
    public function setLocation(\LocationBundle\Entity\Location $location = null) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \LocationBundle\Entity\Location
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Add institution
     *
     * @param \InstitutionBundle\Entity\Institution $institution
     *
     * @return User
     */
    public function addInstitution(\InstitutionBundle\Entity\Institution $institution) {
        $this->institutions->add($institution);
        $institution->addUtilisateur($this);

        return $this;
    }

    /**
     * Remove institution
     *
     * @param \InstitutionBundle\Entity\Institution $institution
     */
    public function removeInstitution(\InstitutionBundle\Entity\Institution $institution) {
        $this->institutions->removeElement($institution);
        $institution->removeUtilisateur($this);
    }

    /**
     * Get institutions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstitutions() {
        return $this->institutions;
    }

    /**
     * @ORM\PrePersist()
     */
    public function addUserList() {
        var_dump('prePersist');
        if ($this->getNewsletter() == true) {
            $cle = ['api_key' => '9ROQwEhyfb35MInx', 'timeout' => 5000];
            $mailin = new Mailin($cle);

            $data = array(
                "id" => 17,
                "users" => array($this->getEmail())
                );

            $mailin->add_users_list($data);
        }
    }
    
    /**
     * @ORM\PreUpdate()
     */
    public function updateUserList() {
        var_dump('preUpdate');
        if ($this->getNewsletter() == true) {
            $cle = ['api_key' => '9ROQwEhyfb35MInx', 'timeout' => 5000];
            $mailin = new Mailin($cle);
            $email = $this->getEmail();
            $data = array(
                "id" => 17,
                "users" => array($email)
                );
            $mailin->add_users_list($data);
            
        }elseif($this->getNewsletter() == false){
            $cle = ['api_key' => '9ROQwEhyfb35MInx', 'timeout' => 5000];
            $mailin = new Mailin($cle);
            $email = $this->getEmail();
            $data = array(
                "id" => 17,
                "users" => array($email)
                );
                $mailin->delete_users_list($data);
        }
    }


    /**
     * Add participation
     *
     * @param \CategoryBundle\Entity\Participation $participation
     *
     * @return User
     */
    public function addParticipation(\CategoryBundle\Entity\Participation $participation)
    {
        $this->participations->add($participation);
        $participation->addUser($this);

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
        $participation->removeUser($this);
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
}
