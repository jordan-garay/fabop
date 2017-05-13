<?php
namespace LocationBundle\Twig\Extension;


class LocationExtension extends \Twig_Extension
{


    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {           
        return array(
            new \Twig_SimpleFunction('location_display', array($this, 'locationDisplay'), array('is_safe' => array('html'))),
        );
    }
    
    public function locationDisplay($location, $lineBreak = false)
    {
        if($lineBreak)
        {
            return sprintf('%s %s, <br /> %s %s', $location->getStreetNumber(), $location->getRoute(), $location->getPostalCode(), $location->getLocality());
        }

        return $location->getFormattedAddress();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'fop_location';
    }
}