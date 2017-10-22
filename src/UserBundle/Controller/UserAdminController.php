<?php

namespace UserBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Dompdf\Dompdf;

class UserAdminController extends CRUDController {

    /**
     * @param ProxyQueryInterface $selectedModelQuery
     * @param Request             $request
     *
     * @return RedirectResponse
     */
    public function batchActionMerge(ProxyQueryInterface $selectedModelQuery, Request $request) {
        $this->admin->checkAccess('edit');
        $this->admin->checkAccess('delete');
        $modelManager = $this->admin->getModelManager();

        $repository = $this->getDoctrine()->getManager()->getRepository('PAOBundle:Badge');

        $modelBadge = $repository->findOneByEnabled(true);

        $selectedModels = $selectedModelQuery->execute();

        $repositoryUser = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');

        try {
            
            $html = null;
            $separation = "<br>";
            $dompdf = new Dompdf();
            $dompdf->set_option('isHtml5ParserEnabled', true);
            
            foreach ($selectedModels as $selectedModel) {
                //$modelManager->delete($selectedModel);
                // instantiate and use the dompdf class
                

                $message = 'yop';

                        $html = $html . $this->renderView('UserBundle:Default:test.html.twig', array('modelBadge' => $modelBadge, 'user' => $selectedModel)) . $separation;
                //$dompdf->load_html($this->renderView('UserBundle:Default:test.html.twig', array('modelBadge' => $modelBadge, 'user' => $selectedModel)));
                /** Pour debbugage de template */
                //return $html = $this->render('UserBundle:Default:test.html.twig', array('modelBadge' => $modelBadge, 'user' => $selectedModel));
            }
            $dompdf->loadHtml($html);
            
            
            // (Optional) Setup the paper size and orientation
//            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream();
            
        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', 'Erreur pendant la génération des badges : ' . $e);
            dump($e);

            return new RedirectResponse(
                    $this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters()))
            );
        }


        $this->addFlash('sonata_flash_success', 'Badges générés avec succès.');

        return new RedirectResponse(
                $this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters()))
        );
    }

}
