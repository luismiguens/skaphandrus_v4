<?php
namespace Skaphandrus\AppBundle\Twig;

use Twig_Environment;
use Symfony\Component\Intl\Intl;

use Skaphandrus\AppBundle\Utils\Utils;

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
            // Intl helper functions.
            new \Twig_SimpleFunction('intl_country_name', array($this, 'intl_country_name')),
            new \Twig_SimpleFunction('intl_locale_name', array($this, 'intl_locale_name')),
            
            // Link helper functions.
            new \Twig_SimpleFunction('link_to_user', array($this, 'link_to_user')),
            new \Twig_SimpleFunction('link_to_species', array($this, 'link_to_species')),
            new \Twig_SimpleFunction('link_to_contest', array($this, 'link_to_photo_contest')),
            new \Twig_SimpleFunction('link_to_contest_photos', array($this, 'link_to_contest_photos')),
            new \Twig_SimpleFunction('link_to_spot', array($this, 'link_to_spot')),
            new \Twig_SimpleFunction('link_to_photo', array($this, 'link_to_photo'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_taxon', array($this, 'link_to_taxon')),

            // URL helper functions.
            new \Twig_SimpleFunction('url_to_photo', array($this, 'url_to_photo')),

            // Other helpers
            new \Twig_SimpleFunction('sk_build_query', array($this, 'sk_build_query'))
        );
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
        $slug = Utils::slugify($names[0]->getName());

        return call_user_func($path_function, 'species', array(
            'slug' => $slug,
        ));
    }

    public function link_to_contest($contest) {
        $path_function = $this->getPathFunction();
        $slug = Utils::slugify($contest->getName());

        return call_user_func($path_function, 'contests_contest', array(
            'slug' => $slug,
        ));
    }

    public function link_to_contest_photos($category) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'contests_photos', array(
            'contest_slug' => Utils::slugify($category->getContest()->getName()),
            'category_slug' => Utils::slugify($category->translate()->getName()),
        ));
    }

    public function link_to_spot($spot) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'spot', array(
            'country' => Utils::slugify(Intl::getRegionBundle()->getCountryName($spot->getLocation()->getRegion()->getCountry()->getName())),
            'location' => Utils::slugify($spot->getLocation()->getName()),
            'slug' => Utils::slugify($spot->getName())
        ));
    }

    public function link_to_photo($photo) {
        $path_function = $this->getPathFunction();

        $url = call_user_func($path_function, 'photo', array(
            'id' => $photo->getId(),
            'slug' => Utils::slugify($photo->getTitle())
        ));

        $link = '<a href="'.$url.'"><img src="/'.$photo->getWebPath().'" alt="'.$photo->getTitle().'"></a>';

        return $link;
    }

    public function link_to_taxon($taxon) {
        $path_function = $this->getPathFunction();
        $node = strtolower(str_replace('Sk', '', (new \ReflectionClass($taxon))->getShortName()));

        return call_user_func($path_function, 'taxon', array(
            'node' => $node,
            'slug' => Utils::slugify($taxon->getName()),
        ));
    }

    /*
     * URL helper functions.
     */

    public function url_to_photo($photo) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'photo', array(
            'id' => $photo->getId(),
            'slug' => Utils::slugify($photo->getTitle())
        ));
    }

    /*
     * Other helpers.
     */

    public function sk_build_query($array) {
        return html_build_query($array);
    }
}
