<?php
namespace Skaphandrus\AppBundle\Twig;

use Twig_Environment;
use Symfony\Component\Intl\Intl;

class UtilsExtension extends \Twig_Extension {

    protected $twig;
    protected $pathFunction;

    protected function getPathFunction() {
        if (empty($this->pathFunction)) {
            $this->pathFunction = $this->twig->getFunction('path')->getCallable();
        }

        return $this->pathFunction;
    }

    public function initRuntime(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getName() {
        return 'Skaphandrus App Utils';
    }

    public function getFunctions() {
        return array(
            // Link helper functions.
            new \Twig_SimpleFunction('link_to_user', array($this, 'link_to_user')),
            new \Twig_SimpleFunction('link_to_species', array($this, 'link_to_species')),

            // Intl helper functions.
            new \Twig_SimpleFunction('intl_country_name', array($this, 'intl_country_name')),
            new \Twig_SimpleFunction('intl_locale_name', array($this, 'intl_locale_name')),
        );
    }

    /*
     * Link helper functions.
     */

    public function link_to_user($user) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'user', array(
            'id' => $user->getId(),
            'username' => $user->getUsername(),
        ));
    }

    public function link_to_species($species) {
        $path_function = $this->getPathFunction();
        $names = $species->getScientificNames();
        $slug = str_replace(' ', '-', $names[0]->getName());

        return call_user_func($path_function, 'species', array(
            'slug' => $slug,
        ));
    }

    /**
     * Intl helper functions.
     */
    
    public function intl_country_name($country_code) {
        return Intl::getRegionBundle()->getCountryName($country_code);
    }
    
    public function intl_locale_name($locale_code) {
        return Intl::getLocaleBundle()->getLocaleName($locale_code);
    }
}
