<?php

namespace UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use LocationBundle\Form\Type\LocationType;

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
                ->add('institutions')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
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
        ;
    }
    
    public function configureActionButtons($action, $object = null)
        {
            $list = parent::configureActionButtons($action, $object);

            if ( in_array($action, ['list'] )) {
                $list['save_filter'] = array(
                    'template' => 'ExportBundle:Button:save_filters_button.html.twig',
                );
            }

            return $list;
        }

}
