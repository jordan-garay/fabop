<?php
// src/PAOBundle/EventListener/MenuBuilderListener.php

namespace PAOBundle\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

class MenuBuilderListener
{
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $child = $menu->addChild('list', [
            'label' => 'PAO',
            'route' => 'list',
        ])->setExtras([
            'icon' => '<i class="fa fa-bar-chart"></i>',
        ]);
    }
}