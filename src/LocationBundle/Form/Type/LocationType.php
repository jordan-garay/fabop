<?php

namespace LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
		$placeholder = '';

		if(isset($options['formatted_address_placeholder']))
		{
			$placeholder = $options['formatted_address_placeholder'];
		}

	    $builder
	    	->add('formattedAddress', TextType::class, array(
	    		'label' => false,
	    		'attr' => array(
	    			'class' 		=> 'formatted_address-field', 
	    			'data-location' => 'formattedAddress',
	    			'placeholder' 	=> $placeholder,
	    		    'style'			=> 'width:100%')
	    	))

		    ->add('streetNumber', HiddenType::class, array(
		    	'attr' => array('class' => 'street_number-field',  'data-location' => 'street_number')
		    ))
	    	->add('route', HiddenType::class, array(
	    		'attr' => array('class' => 'route-field',  'data-location' => 'route')
	    	))
	    	->add('locality', HiddenType::class, array(
	    		'attr' => array('class' => 'locality-field', 'data-location' => 'locality')
	    	))
	    	->add('admAreaLevel1', HiddenType::class, array(
	    		'attr' => array('class' => 'administrative_area_level_1-field', 'data-location' => 'administrative_area_level_1')
	    	))
	    	->add('admAreaLevel2', HiddenType::class,array(
	    		'attr' => array('class' => 'administrative_area_level_2-field', 'data-location' => 'administrative_area_level_2')
	    	))
	    	->add('admAreaLevel3', HiddenType::class,array(
	    		'attr' => array('class' => 'administrative_area_level_3-field', 'data-location' => 'administrative_area_level_3')
	    	))
	    	->add('admAreaLevel4', HiddenType::class,array(
	    		'attr' => array('class' => 'administrative_area_level_4-field', 'data-location' => 'administrative_area_level_4')
	    	))
	    	->add('admAreaLevel5', HiddenType::class,array(
	    		'attr' => array('class' => 'administrative_area_level_5-field', 'data-location' => 'administrative_area_level_5')
	    	))
	    	->add('country', HiddenType::class,array(
	    		'attr' => array('class' => 'country-field', 'data-location' => 'country')
	    	))
	    	->add('postalcode', HiddenType::class,array(
	    		'attr' => array('class' => 'postal_code-field', 'data-location' => 'postal_code')
	    	))
	    	->add('lat', HiddenType::class,array(
	    		'attr' => array('class' => 'lat-field', 'data-location' => 'lat')
	    	))
	    	->add('lng', HiddenType::class,array(
	    		'attr' => array('class' => 'lng-field', 'data-location' => 'lng')
	    	))
	    ;
	}


	public function getParent()
	{
	    return 'form';
	}

	public function configureOptions(OptionsResolver $resolver)
	{

	    $resolver->setDefaults(array(
	        'compound' => true,
	        'data_class' => 'LocationBundle\Entity\Location',
	        'formatted_address_placeholder' => 'Saisir une adresse ou une ville'
	    ));

	}
	
	/**
	 * {@inheritdoc}
	 */
	public function buildView(FormView $view, FormInterface $form, array $options)
	{
	}

	public function getBlockPrefix()
	{
	    return 'vrz_location';
	}

	public function getName()
	{
		return $this->getBlockPrefix();
	}

}
