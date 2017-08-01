<?php

namespace UserBundle\Twig;

use Twig\TwigFunction;

class SearchParentExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'searchparent' => new \Twig_Function_Method($this, 'searchParentFunction')
        );
    }

    public function searchParentFunction($arguments) {
        $parent = $arguments->getParent();
        while ($parent->getParent()) {
            $parent = $parent->getParent();
        }
        return $parent;
    }

    public function getName() {

        return 'searchparent';
    }

}
