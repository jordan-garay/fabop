<?php

namespace ExportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ExportBundle\Entity\Export;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('ExportBundle:Default:index.html.twig');
    }
    
    /**
    * @Route("/user/user/save_filter/{query}", name="save_filter")
    */
    public function saveFilterAction($query)
    {
        $em = $this->getDoctrine()->getManager();
        $model = new Export();
        $arg = rawurldecode ( $query );
        $model->setUri($arg);
        $dernierModel = $em->getRepository('ExportBundle:Export')->findBy(array(), array('id' => 'desc'),1,0);
        if($dernierModel == null){
            $numero = 1;
        }else{
            $idDernierModel = $dernierModel[0]->getId();
            $numero = $idDernierModel +1;
        }
        $model->setName('Modele'.$numero);
        $em->persist($model);
        $em->flush();

        return $this->redirectToRoute('sonata_admin_dashboard');
    }
    
}
