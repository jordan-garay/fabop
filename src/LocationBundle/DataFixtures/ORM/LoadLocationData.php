<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/01/17
 * Time: 15:56
 */

namespace LocationBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use LocationBundle\Entity\Location;

class LoadLocationData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
    public function load(ObjectManager $manager)
    {

        $location = $this->loadLocation($manager);

        $manager->flush();

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }

    protected function loadLocation($manager)
    {
        //location
        $location = new Location();

        $location
            ->setStreetNumber('1')
            ->setRoute('Rue de la république')
            ->setLocality('Orléans')
            ->setAdmAreaLevel1('Centre-Val de Loire')
            ->setAdmAreaLevel2('Loiret')
            ->setCountry('France')
            ->setPostalCode('45000')
            ->setLat(47.898258)
            ->setLng(1.9040383)
            ->setFormattedAddress('1 Rue Royale, Orléans, France')
        ;

        $manager->persist($location);

        $this->addReference('location_orleans', $location);

        //location
        $location = new Location();

        $location
            ->setStreetNumber('1')
            ->setRoute('Rue Royale')
            ->setLocality('Orléans')
            ->setAdmAreaLevel1('Centre-Val de Loire')
            ->setAdmAreaLevel2('Loiret')
            ->setCountry('France')
            ->setPostalCode('45000')
            ->setLat(47.898258)
            ->setLng(1.9040383)
            ->setFormattedAddress('1 Rue Royale, Orléans, France')
        ;

        $manager->persist($location);

        $this->addReference('location_orleans2', $location);

        //location
        $location = new Location();

        $location
            ->setStreetNumber('1')
            ->setRoute('Rue de bourgogne')
            ->setLocality('Orléans')
            ->setAdmAreaLevel1('Centre-Val de Loire')
            ->setAdmAreaLevel2('Loiret')
            ->setCountry('France')
            ->setPostalCode('45000')
            ->setLat(47.898258)
            ->setLng(1.9040383)
            ->setFormattedAddress('1 Rue Royale, Orléans, France')
        ;

        $manager->persist($location);

        $this->addReference('location_orleans3', $location);

        $location = new Location();

        $location
            ->setStreetNumber('10')
            ->setRoute('Rue de bourgogne')
            ->setLocality('Orléans')
            ->setAdmAreaLevel1('Centre-Val de Loire')
            ->setAdmAreaLevel2('Loiret')
            ->setCountry('France')
            ->setPostalCode('45000')
            ->setLat(47.898258)
            ->setLng(1.9040383)
            ->setFormattedAddress('1 Rue Royale, Orléans, France')
        ;

        $manager->persist($location);

        $this->addReference('location_orleans4', $location);

    }

}