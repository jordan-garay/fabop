<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class LoadFabriqueOperaData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
    private $slugify;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
        $this->slugify = $this->container->get('sonata.core.slugify.cocur');
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $manager) {
        $tmpTab = array();
        $row = 0;

        if (($handle = fopen(__DIR__ . "/data_fabrique_opera_global.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 9000, ",", '"')) !== FALSE) {

                $row++;

                if ($row == 1) {
                    continue;
                }
                //pas les institutiotns
                // elseif((empty($data[])))
                if (!in_array($this->getUserName($data), $tmpTab)) {
                    $this->createUser($data, $manager);
                    array_push($tmpTab, $this->getUserName($data));
                }

//                if ($row == 20) {
//                    break;
//                }
            }

            $manager->flush();
        }
    }

    private function createUser($data, $manager) {
        $email = $this->getEmail($data);
        $usernama_canonical = $this->getUsernameCanonical($data);
        $name = $this->getUserName($data);


        if (empty($name) && empty($usernama_canonical)) {
            return;
        }

        $user = new User();

        $user->setUsername($name);
        $user->setUsernameCanonical($usernama_canonical);

        $user->setEmailCanonical($email);
        $user->setEmail($data[9]);

        $user->setFirstname($data[3]);
        $user->setLastname($data[2]);
        $user->setPhone($data[7]); //phon_bis
        $user->setNewsletter(true);
        $user->setEnabled(true);

        $roles = $user->getRoles();
        $roles[] = 'ROLE_USER';

        $user->setRoles($roles);

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);

        $user->setPassword($encoder->encodePassword($email, $user->getSalt()));

        $user->setEnabled(1);

        //$this->checkEmailIsValid($email, $user);

        // $this->addClassificationCategory($user,$data,$manager);

        $manager->persist($user);
    }

    private function getEmail($data) {
        if (empty(trim($data[9]))) {
            return uniqid();
        }

        return $data[9];
    }

//    private function checkEmailIsValid($email, $user) {
//        $emailConstraint = new Assert\Email();
//
//        $errorList = $this->container->get('validator')->validate(
//                $email, $emailConstraint
//        );
//
//        if (0 === count($errorList)) {
//            $user->setValidEmail(true);
//        } else {
//            $user->setValidEmail(false);
//        }
//    }

    private function getUserName($data) {
        return $this->slugify->slugify($data[2] . ' ' . $data[3], '_');
    }

    private function getUsernameCanonical($data) {
        //mail ?
        if (!empty(trim($data[9]))) {
            return $data[9];
        }
        //individu
        elseif (!empty(trim($data[2])) && !empty(trim($data[3]))) {

            $slug = $this->slugify->slugify($data[2] . ' ' . $data[3], '_');

            return $slug;
        }
        //institution (?)
        elseif (!empty(trim($data[3])) && !empty(trim($data[5]))) {

            //prénom et nom
            $slug = $this->slugify->slugify($data[3], '_');

            return $slug;
        }
        //institution (?)
        elseif (!empty(trim($data[5]))) {
            //nom institution
            $slug = $this->slugify->slugify($data[5], '_');

            return $slug;
        }
    }

    private function addClassificationCategory($user, $data, $manager) {
        for ($i = 13; $i < (count($data)); $i++) {
            $content = trim($data[$i]);
            if (!empty($content)) {
                $user->addCategory($this->getReference('category_' . $i));
            }
        }
    }

}
