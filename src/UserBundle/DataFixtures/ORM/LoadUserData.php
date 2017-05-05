<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        $Admin = new User();
        $Admin->setUsername('admin');
        $Admin->setEmail('admin@admin.fr');
        $Admin->setPhone('0669011762');
        $Admin->setNewsletter(true);     
        $roles = $Admin->getRoles();
        $roles[] = 'ROLE_SUPER_ADMIN';
        $Admin->setRoles($roles);

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($Admin);
        $Admin->setPassword($encoder->encodePassword('admin', $Admin->getSalt()));

        $Admin->setEnabled(1);

        $manager->persist($Admin);

        $userAdmin = new User();
        $userAdmin->setUsername('user');
        $userAdmin->setEmail('user@user.fr');
        $userAdmin->setPhone('0645286955');    
        $userAdmin->setNewsletter(true);
        $roles = $userAdmin->getRoles();
        $roles[] = 'ROLE_ADMIN';
        $userAdmin->setRoles($roles);

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($userAdmin);
        $userAdmin->setPassword($encoder->encodePassword('user', $userAdmin->getSalt()));

        $userAdmin->setEnabled(1);

        $manager->persist($userAdmin);


        $manager->flush();
    }
}
