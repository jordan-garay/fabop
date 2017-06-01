<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DefaultController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {
        return $this->render('UserBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login")
     */
    public function loginAction(Request $request) {
        $user = new User();
        $formBuilder = $this->get('form.factory')->createBuilder('form', $user);
        $formBuilder
                ->add('username')
                ->add('lastname')
                ->add('firstname')
                ->add('phone')
                ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.new_password', 'attr' => array('class' => 'form-control input-sm chat-input')),
                    'second_options' => array('label' => 'form.new_password_confirmation', 'attr' => array('class' => 'form-control input-sm chat-input')),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
                ->add('email')
                ->add('newsletter', null, array('attr' => array('checked' => 'checked')))
                ->add('Envoyer', 'submit')
        ;
        $form = $formBuilder->getForm();

        $form->handleRequest($request);


        // On vérifie que les valeurs entrées sont correctes

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            
            $user->setRealRoles(array("ROLE_ADMIN"));
            
            $user->setEnabled(true);

            $em->persist($user);

            $em->flush();
            
            return $this->redirect('/admin');
        }
        return $this->render('login.html.twig', array('form' => $form->createView()));
    }

}
