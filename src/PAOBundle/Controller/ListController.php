<?php

namespace PAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ListController extends Controller {

    /**
     * @Route("/list", name="list")
     */
    public function listAction() {
        $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
        $listUser = $repository->findAll();
        return $this->render('PAOBundle:Default:standard_layout.html.twig', array('listUser' => $listUser));
    }

}
