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

    public function initRuntime(Twig_Environment $twig) {
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
            // The "is_safe" parameter allows html, for rendering the links.
            new \Twig_SimpleFunction('link_to_user', array($this, 'link_to_user'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_species', array($this, 'link_to_species'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_contest', array($this, 'link_to_contest'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_contest_photos', array($this, 'link_to_contest_photos'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_spot', array($this, 'link_to_spot'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_location', array($this, 'link_to_location'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_country', array($this, 'link_to_country'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_photo', array($this, 'link_to_photo'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_taxon', array($this, 'link_to_taxon'), array('is_safe' => array('html'))),
            // URL helper functions.
            new \Twig_SimpleFunction('url_to_user', array($this, 'url_to_user')),
            new \Twig_SimpleFunction('url_to_species', array($this, 'url_to_species')),
            new \Twig_SimpleFunction('url_to_contest', array($this, 'url_to_contest')),
            new \Twig_SimpleFunction('url_to_contest_photos', array($this, 'url_to_contest_photos')),
            new \Twig_SimpleFunction('url_to_spot', array($this, 'url_to_spot')),
            new \Twig_SimpleFunction('url_to_location', array($this, 'url_to_location')),
            new \Twig_SimpleFunction('url_to_country', array($this, 'url_to_country')),
            new \Twig_SimpleFunction('url_to_photo', array($this, 'url_to_photo')),
            new \Twig_SimpleFunction('url_to_taxon', array($this, 'url_to_taxon')),
            new \Twig_SimpleFunction('url_to_photos', array($this, 'url_to_photos')),
            // Other helpers
            new \Twig_SimpleFunction('sk_build_query', array($this, 'sk_build_query')),
            new \Twig_SimpleFunction('slugify', array($this, 'slugify')),
            new \Twig_SimpleFunction('unslugify', array($this, 'unslugify')),
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
        return '<a href="' . $this->url_to_user($user) . '" title="' . $user->getUsername() . '">' . $user->getUsername() . '</a>';
    }

    public function link_to_species($species) {
        $names = $species->getScientificNames();
        return '<a href="' . $this->url_to_species($species) . '" title="' . $names[0]->getName() . '">' . $names[0]->getName() . ', ' . $names[0]->getAuthor() . '</a>';
    }

    public function link_to_contest($contest) {
        return '<a href="' . $this->url_to_contest($contest) . '" title="' . $contest->getName() . '">' . $contest->getName() . '</a>';
    }

    public function link_to_contest_photos($category) {
        return '<a href="' . $this->url_to_contest_photos($category) . '" title="' . $category->translate()->getName() . '">' . $category->translate()->getName() . '</a>';
    }

    public function link_to_spot($spot) {
        return '<a href="' . $this->url_to_spot($spot) . '" title="' . $spot->getName() . '">' . $spot->getName() . '</a>';
    }

    public function link_to_location($location) {
        return '<a href="' . $this->url_to_location($location) . '" title="' . $location->getName() . '">' . $location->getName() . '</a>';
    }

    public function link_to_country($country) {
        return '<a href="' . $this->url_to_country($country) . '" title="' . $country . '">' . $country . '</a>';
    }

    public function link_to_photo($photo) {
        return '<a href="' . $this->url_to_photo($photo) . '" title="' . $photo->getTitle() . '"><img src="/' . $photo->getWebPath() . '" alt="' . $photo->getTitle() . '"></a>';
    }

    public function link_to_taxon($taxon) {
        return '<a href="' . $this->url_to_taxon($taxon) . '" title="' . $taxon->getName() . '">' . $taxon->getName() . '</a>';
    }

    /*
     * URL helper functions.
     */

    public function url_to_user($user) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'user', array(
            'id' => $user->getId(),
            'username' => $user->getUsername(),
        ));
    }

    public function url_to_species($species) {
        $path_function = $this->getPathFunction();
        $names = $species->getScientificNames();
        $slug = Utils::slugify($names[0]->getName());

        return call_user_func($path_function, 'species', array(
            'slug' => $slug,
        ));
    }

    public function url_to_contest($contest) {
        $path_function = $this->getPathFunction();
        $slug = Utils::slugify($contest->getName());

        return call_user_func($path_function, 'contests_contest', array(
            'slug' => $slug,
        ));
    }

    public function url_to_contest_photos($category) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'contests_photos', array(
            'contest_slug' => Utils::slugify($category->getContest()->getName()),
            'category_slug' => Utils::slugify($category->translate()->getName()),
        ));
    }

    public function url_to_spot($spot) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'spot', array(
            'country' => Utils::slugify($spot->getLocation()->getRegion()->getCountry()),
            'location' => Utils::slugify($spot->getLocation()->getName()),
            'slug' => Utils::slugify($spot->getName())
        ));
    }

    public function url_to_location($location) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'location', array(
            'country' => Utils::slugify($location->getRegion()->getCountry()),
            'slug' => Utils::slugify($location->getName())
        ));
    }

    public function url_to_country($country) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'country', array(
            'slug' => Utils::slugify($country)
        ));
    }

    public function url_to_photo($photo) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'photo', array(
            'id' => $photo->getId(),
            'slug' => Utils::slugify($photo->getTitle())
        ));
    }

    public function url_to_taxon($taxon) {
        $path_function = $this->getPathFunction();
        $node = strtolower(str_replace('Sk', '', (new \ReflectionClass($taxon))->getShortName()));

        return call_user_func($path_function, 'taxon', array(
            'node' => $node,
            'slug' => Utils::slugify($taxon->getName()),
        ));
    }

    public function url_to_photos($params) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'photos', $params);
    }

    /*
     * Other helpers.
     */

    public function sk_build_query($array) {
        return html_build_query($array);
    }

    public function slugify($string) {
        return Utils::slugify($string);
    }

    public function unslugify($string) {
        return Utils::unslugify($string);
    }

}
