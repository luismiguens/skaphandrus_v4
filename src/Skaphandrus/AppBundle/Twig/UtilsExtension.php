<?php
namespace Skaphandrus\AppBundle\Twig;

use Twig_Environment;

class UtilsExtension extends \Twig_Extension {

    protected $twig;
    protected $pathFunction;

    public function initRuntime(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getName() {
        return 'Skaphandrus App Utils';
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('link_to_user', array($this, 'link_to_user')),
        );
    }

    public function link_to_user($user) {

        if (empty($this->pathFunction)) {
            $this->pathFunction = $this->twig->getFunction('path')->getCallable();
        }

        return call_user_func($this->pathFunction, 'user', array(
            'slug' => $user->getId() .'-'. $user->getUsername(),
        ));
    }
}
