<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control input-sm chat-input')))
                ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control input-sm chat-input')))
                ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                    'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.new_password', 'attr' => array('class' => 'form-control input-sm chat-input')),
                    'second_options' => array('label' => 'form.new_password_confirmation', 'attr' => array('class' => 'form-control input-sm chat-input')),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
                ->add('nom', null, array('attr' => array('class' => 'form-control input-sm chat-input')))
                ->add('prenom', null, array('label' => 'Prénom', 'attr' => array('class' => 'form-control input-sm chat-input')))
                ->add('phone', null, array('label' => 'Téléphone', 'attr' => array('class' => 'form-control input-sm chat-input')))
                ->add('newsletter', null, array('attr' => array('checked' => 'checked')))
                ->add('valid_email', HiddenType::class, array('data' => 0))
                ->add('avatar', HiddenType::class, array('data' => 'default.png'))
                ->add('enabled', HiddenType::class, array('data' => 1))
        ;
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix() {
        return 'fabop_user_registration';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
