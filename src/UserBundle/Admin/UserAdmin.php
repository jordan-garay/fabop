<?php

namespace UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use LocationBundle\Form\Type\LocationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserAdmin extends SonataUserAdmin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('firstname')
                ->add('lastname')
                ->add('username')
                ->add('email')
                ->add('phone')
                ->add('location')
                ->add('enabled')
                ->add('roles')
                ->add('dateOfBirth')
                ->add('gender')
                ->add('newsletter')
                ->add('participations')
                ->add('institutions')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('firstname')
                ->add('lastname')
                ->add('username')
                ->add('email')
                ->add('phone')
                ->add('location')
                ->add('enabled')
                ->add('roles')
                ->add('dateOfBirth')
                ->add('gender')
                ->add('newsletter')
                ->add('institutions')
                ->add('participations')
                ->add('_action', null, array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('firstname')
                ->add('lastname')
                ->add('username')
                ->add('email')
                ->add('phone')
                ->add('location', LocationType::class)
                ->add('enabled')
                ->add('roles')
                ->add('dateOfBirth')
                ->add('gender')
                ->add('newsletter')
                ->add('institutions', EntityType::class, array(
                    'class' => 'InstitutionBundle:Institution',
                    'multiple' => true,
                    'by_reference' => false
                ))
                ->add('participations', EntityType::class, array(
                    'class' => 'CategoryBundle:Participation',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => false
                ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->with('Général', array(
                    'class'       => 'col-md-6',
                ))
                    ->add('firstname')
                    ->add('lastname')
                    ->add('username')
                    ->add('email')
                    ->add('phone')
                    ->add('location')
                    ->add('enabled')
                    ->add('roles')
                    ->add('dateOfBirth')
                    ->add('gender')
                    ->add('newsletter')
                    ->add('institutions')
                ->end()
                ->with('Historique', array(
                    'class'       => 'col-md-6',
                    'box_class'   => 'box box-solid box-success',
                    'description' => 'Lorem ipsum',
                ))
                ->add('participations', 'participations.annee')
                ->end()
        ;
    }

    public function configureActionButtons($action, $object = null) {
        $list = parent::configureActionButtons($action, $object);

        if (in_array($action, ['list'])) {
            $list['save_filter'] = array(
                'template' => 'ExportBundle:Button:save_filters_button.html.twig',
            );
            $list['edit_document'] = array(
                'template' => 'AppBundle:Button:edit_document_button.html.twig',
            );
        }

        return $list;
    }

    public function configureBatchActions($actions) {
        if (
                $this->hasRoute('edit') && $this->hasAccess('edit') &&
                $this->hasRoute('delete') && $this->hasAccess('delete')
        ) {
            $actions['Merge'] = array(
                'ask_confirmation' => false,
                'label' => 'Merge'
            );
        }

        return $actions;
    }

}
