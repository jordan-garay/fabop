<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->redirect('/admin');
    }
    
    /**
    * @Route("/user/user/edit_document/{parameters}", name="edit_document")
    */
    public function saveFilterAction(array $parameters)
    {
        var_dump($parameters);

        return $this->redirectToRoute('sonata_admin_dashboard');
    }
}
