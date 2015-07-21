<?php

namespace Skaphandrus\AppBundle\Twig;

use Twig_Environment;
use Symfony\Component\Intl\Intl;
use Skaphandrus\AppBundle\Utils\Utils;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

class UtilsExtension extends \Twig_Extension {

    protected $twig;
    protected $pathFunction;
    private $container;
    private $translator;

    public function __construct($container, Translator $translator) {
        $this->container = $container;
        $this->translator = $translator;
    }

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
            
            //species
            new \Twig_SimpleFunction('link_to_species', array($this, 'link_to_species'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_taxon', array($this, 'link_to_taxon'), array('is_safe' => array('html'))),
            
            //contests
            new \Twig_SimpleFunction('link_to_contests', array($this, 'link_to_contests'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_contest', array($this, 'link_to_contest'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_contest_photos', array($this, 'link_to_contest_photos'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_contest_photographers', array($this, 'link_to_contest_photographers'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_contest_sponsors', array($this, 'link_to_contest_sponsors'), array('is_safe' => array('html'))),
            
            //spots
            new \Twig_SimpleFunction('link_to_spot', array($this, 'link_to_spot'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_location', array($this, 'link_to_location'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_country', array($this, 'link_to_country'), array('is_safe' => array('html'))),
            
            //photo
            new \Twig_SimpleFunction('link_to_photo', array($this, 'link_to_photo'), array('is_safe' => array('html'))),
            
            //identification
            new \Twig_SimpleFunction('link_to_identification', array($this, 'link_to_identification'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('link_to_module', array($this, 'link_to_module'), array('is_safe' => array('html'))),
            
            new \Twig_SimpleFunction('link_to_message', array($this, 'link_to_message'), array('is_safe' => array('html'))),
            



// URL helper functions.
            new \Twig_SimpleFunction('url_to_user', array($this, 'url_to_user')),
            
            new \Twig_SimpleFunction('url_to_species', array($this, 'url_to_species')),
            new \Twig_SimpleFunction('url_to_taxon', array($this, 'url_to_taxon')),
            
            new \Twig_SimpleFunction('url_to_contests', array($this, 'url_to_contests')),
            new \Twig_SimpleFunction('url_to_contest', array($this, 'url_to_contest')),
            new \Twig_SimpleFunction('url_to_contest_photos', array($this, 'url_to_contest_photos')),
            new \Twig_SimpleFunction('url_to_contest_photographers', array($this, 'url_to_contest_photographers')),
            new \Twig_SimpleFunction('url_to_contest_sponsors', array($this, 'url_to_contest_sponsors')),
            
            
            new \Twig_SimpleFunction('url_to_spot', array($this, 'url_to_spot')),
            new \Twig_SimpleFunction('url_to_location', array($this, 'url_to_location')),
            new \Twig_SimpleFunction('url_to_country', array($this, 'url_to_country')),
            
            
            new \Twig_SimpleFunction('url_to_photo', array($this, 'url_to_photo')),
            new \Twig_SimpleFunction('url_to_photos', array($this, 'url_to_photos')),
            
            new \Twig_SimpleFunction('url_to_identification', array($this, 'url_to_identification')),
            new \Twig_SimpleFunction('url_to_module', array($this, 'url_to_module')),
            
            new \Twig_SimpleFunction('url_to_message', array($this, 'url_to_message')),
            new \Twig_SimpleFunction('url_to_dashboard', array($this, 'url_to_dashboard')),
            new \Twig_SimpleFunction('url_to_homepage', array($this, 'url_to_homepage')),
            
            
            // Other helpers
            new \Twig_SimpleFunction('sk_build_query', array($this, 'sk_build_query')),
            new \Twig_SimpleFunction('slugify', array($this, 'slugify')),
            new \Twig_SimpleFunction('unslugify', array($this, 'unslugify')),
            
            //message helpers
            new \Twig_SimpleFunction('activity_message', array($this, 'activity_message')),
            new \Twig_SimpleFunction('notification_message', array($this, 'notification_message')),
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
     * Notification helper messages
     */

    /**
     * get notify message
     * @param  sfSocialNotify $notify
     * @return string
     */
    function notification_message(\Skaphandrus\AppBundle\Entity\SkSocialNotify $notify, $locale) {


// message_aaa x comentou a tua fotografia y	
// message_aab x tambem comentou fotografia y	
// message_aac x comentou a fotografia y	
// message_aad x comentou a fotografia y	
// message_aba x sugeriu especie y na fotografia z	
// message_abb x sugeriu especie y na fotografia z	
// message_abc x sugeriu especie y na tua fotografia z 	
// message_aca x enviou-te uma nova mensagem	
// message_ada x associou especie y na fotografia z	
// ??????????? x associou spot y na fotografia z	
// message_aea x adicionou-te como amigo.	
// message_baa x tambem adicionou fotografia y a categoria z	
// message_bba x votou na tua fotografia y	
// message_caa x validou especie y na fotografia z	
// message_cab x validou especie y na fotografia z	
// message_cac x validou especie y na tua fotografia z 	

        $container = $this->container;


$this->translator->setLocale($locale);

        switch ($notify->getMessageName()) {

            // message_aaa x comentou a tua fotografia y	
            case 'message_aaa':
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% comentou a tua fotografia %2%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_photo($photo)));

            // message_aab x tambem comentou fotografia y	
            case 'message_aab':
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% tambem comentou a fotografia %2%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_photo($photo)));

            // message_aac x comentou a fotografia y
            case 'message_aac':
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% comentou a fotografia %2%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_photo($photo)));

            // message_aad x comentou a fotografia y
            case 'message_aad':
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% comentou a fotografia %2%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_photo($photo)));

            // message_aba x sugeriu especie y na fotografia z
            case 'message_aba':
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($notify->getSpeciesId());
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% sugeriu especie %2% na fotografia %3%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));

            // message_abb x sugeriu especie y na fotografia z
            case 'message_abb':
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($notify->getSpeciesId());
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% sugeriu especie %2% na fotografia %3%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));

            // message_abc x sugeriu especie y na tua fotografia z 
            case 'message_abc':
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($notify->getSpeciesId());
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% sugeriu especie %2% na tua fotografia %3%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));

            // message_aca x enviou-te uma nova mensagem	
            case 'message_aca':
                $photo = $notify->getPhoto();
                $message = $notify->getMessage();
                return $this->translator->trans(
                                '%1% enviou-te uma nova %2%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_message($message)));

            // message_ada x associou especie y na fotografia z
            case 'message_ada':
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($notify->getSpeciesId());
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% associou especie %2% na fotografia %3%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));

            // message_aea x adicionou-te como amigo.
            case 'message_aea':
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% adicionou-te como amigo.', array('%1%' => $this->link_to_user($notify->getUserFrom())));

                  
                
            // message_baa x tambem adicionou fotografia y a categoria z
            case 'message_baa':
                $photo = $notify->getPhoto();
                $category = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->findOneById($notify->getParamSecond());
                return $this->translator->trans(
                                '%1% tambem adicionou fotografia %2% à categoria %3%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_photo($photo),
                            '%3%' => $this->link_to_contest_photos($category)));

            // message_bba x votou na tua fotografia y	
            case 'message_bba':
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% votou na tua fotografia %2%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_photo($photo)));

            // message_caa x validou especie y na fotografia z
            case 'message_caa':
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($notify->getSpeciesId());
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% validou especie %2% na fotografia %3%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));

            // message_cab x validou especie y na fotografia z
            case 'message_cab':
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($notify->getSpeciesId());
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% validou especie %2% na fotografia %3%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));

            // message_cac x validou especie y na tua fotografia z 
            case 'message_cac':
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($notify->getSpeciesId());
                $photo = $notify->getPhoto();
                return $this->translator->trans(
                                '%1% validou especie %2% na tua fotografia %3%.', array('%1%' => $this->link_to_user($notify->getUserFrom()),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));
        }
    }

    /**
     * get notify message
     * @param  sfSocialNotify $notify
     * @return string
     */
    function activity_message(\Skaphandrus\AppBundle\Entity\SkActivity $activity, $locale) {


### activity_001 x associou especie y na fotografia z	
### activity_002 x associou spot y na fotografia z	
### ???????????? x adicionou fotografia y	
### activity_011 x sugeriu especie y na fotografia z	
### activity_012 x validou especie y na fotografia z	
### activity_021 x comentou fotografia y	
### activity_031 x adicionou spot y	
### activity_041 x adicionou y como amigo.	
### ???????????? x editou spot	
### ???????????? x editou local	
### ???????????? x editou pais	
### ???????????? x gostou da fotografia y	
### activity_051 x registou-se	
### ???????????? x passou a ser expert	
### activity_061 x associou fotografia x a categoria y	
### activity_062 x votou na fotografia y da categoria z	
### activity_071 x trocou x pontos pelo modulo y

        $container = $this->container;
        $this->translator->setLocale($locale);
        

        switch ($activity->getMessageName()) {
            ### activity_001 x associou especie y na fotografia z
            case 'activity_001':
                $user_from = $activity->getUserFrom();
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($activity->getSpeciesId());
                $photo = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($activity->getPhotoId());

                return $this->translator->trans(
                                '%1% associou especie %2% na fotografia %3%.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));


            ### activity_002 x associou spot y a fotografia z
            case 'activity_002':
                $user_from = $activity->getUserFrom();
                $spot = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpot')->findOneById($activity->getSpotId());
                $photo = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($activity->getPhotoId());

                return $this->translator->trans(
                                '%1% associou spot %2% na fotografia %3%.', array('%1%' => $this->link_to_user($activity->getUserFrom()),
                            '%2%' => $this->link_to_spot($spot),
                            '%3%' => $this->link_to_photo($photo)));


            ### activity_011 x sugeriu especie y na fotografia z	
            case 'activity_011':
                $user_from = $activity->getUserFrom();
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($activity->getSpeciesId());
                $photo = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($activity->getPhotoId());

                return $this->translator->trans(
                                '%1% sugeriu especie %2% na fotografia %3%.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));


            ### activity_012 x validou especie y na fotografia z	
            case 'activity_012':
                $user_from = $activity->getUserFrom();
                $species = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpecies')->findOneById($activity->getSpeciesId());
                $photo = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($activity->getPhotoId());

                return $this->translator->trans(
                                '%1% validou especie %2% na fotografia %3%.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $this->link_to_species($species),
                            '%3%' => $this->link_to_photo($photo)));


            ### activity_021 x comentou fotografia y
            case 'activity_021':
                $user_from = $activity->getUserFrom();
                $photo = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($activity->getPhotoId());

                return $this->translator->trans(
                                '%1% comentou fotografia %2%.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $this->link_to_photo($photo)));


            ### activity_031 x adicionou spot y	
            case 'activity_031':
                $user_from = $activity->getUserFrom();
                $spot = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkSpot')->findOneById($activity->getSpotId());

                return $this->translator->trans(
                                '%1% adicionou spot %2%.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $this->link_to_spot($spot)));


            ### activity_041 x adicionou y como amigo.
            case 'activity_041':
                $user_from = $activity->getUserFrom();
                $user_to = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:FosUser')->findOneById($activity->getUserId());

                return $this->translator->trans(
                                '%1% adicionou %2% como amigo.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $this->link_to_user($user_to)));


            ### activity_051 x registou-se
            case 'activity_051':
                $user_from = $activity->getUserFrom();

                return $this->translator->trans(
                                '%1% registou-se.', array('%1%' => $this->link_to_user($user_from)));


            ### activity_061 x associou fotografia x a categoria y	
            case 'activity_061':
                $user_from = $activity->getUserFrom();
                $photo = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($activity->getPhotoId());
                $category = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->findOneById($activity->getCategoryId());

                return $this->translator->trans(
                                '%1% associou fotografia %2% a categoria %3%.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $this->link_to_photo($photo),
                            '%3%' => $this->link_to_contest_photos($category)));


            ### activity_062 x votou na fotografia y da categoria z	
            case 'activity_062':
                $user_from = $activity->getUserFrom();
                $photo = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($activity->getPhotoId());
                $category = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->findOneById($activity->getCategoryId());

                return $this->translator->trans(
                                '%1% votou na fotografia %2% da categoria %3%.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $this->link_to_photo($photo),
                            '%3%' => $this->link_to_contest_photos($category)));


            ### activity_071 x trocou x pontos pelo modulo y
            case 'activity_071':
                $user_from = $activity->getUserFrom();
                //$module = new \Skaphandrus\AppBundle\Entity\SkIdentificationModule();
                $module = $container->get("doctrine")->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->findOneById($activity->getModuleId());

                return $this->translator->trans(
                                '%1% trocou %2% pontos pelo modulo %3%.', array('%1%' => $this->link_to_user($user_from),
                            '%2%' => $module->getPoints(),
                            '%3%' => $this->link_to_module($module->getName())));
        }
    }

    /*
     * Link helper functions.
     */

    public function link_to_user($user) {
        return '<a href="' . $this->url_to_user($user) . '" title="' . $user->getName() . '">' . $user->getName() . '</a>';
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

    public function link_to_contest_photographers($contest) {
        return '<a href="' . $this->url_to_contest_photographers($contest) . '" title="' . $contest->getName() . '">' . $contest->getName() . '</a>';
    }

    public function link_to_contest_sponsors($contest) {
        return '<a href="' . $this->url_to_contest_sponsors($contest) . '" title="' . $contest->getName() . '">' . $contest->getName() . '</a>';
    }

    public function link_to_spot($spot, $location = NULL, $country = NULL) {
        return '<a href="' . $this->url_to_spot($spot, $location, $country) . '" title="' . $spot->getName() . '">' . $spot->getName() . '</a>';
    }

    public function link_to_location($location, $country = NULL) {
        return '<a href="' . $this->url_to_location($location, $country) . '" title="' . $location->getName() . '">' . $location->getName() . '</a>';
    }

    public function link_to_country($country) {
        return '<a href="' . $this->url_to_country($country) . '" title="' . $country . '">' . $country . '</a>';
    }

//    public function link_to_photo($photo) {
//        return '<a href="' . $this->url_to_photo($photo) . '" title="' . $photo->getTitle() . '"><img src="/' . $photo->getWebPath() . '" alt="' . $photo->getTitle() . '"></a>';
//    }

    public function link_to_photo($photo) {
        return '<a href="' . $this->url_to_photo($photo) . '" title="' . $photo->getTitle() . '">' . $photo->getTitle() . '</a>';
    }

    public function link_to_taxon($taxon) {
        return '<a href="' . $this->url_to_taxon($taxon) . '" title="' . $taxon->getName() . '">' . $taxon->getName() . '</a>';
    }

    public function link_to_identification() {
        return '<a href="' . $this->url_to_identification() . '" title="' . $module_name . '">' . $module_name . '</a>';
    }
    
    public function link_to_module($module_name) {
        return '<a href="' . $this->url_to_module($module_name) . '" title="' . $module_name . '">' . $module_name . '</a>';
    }

    public function link_to_message($message) {
        return '<a href="' . $this->url_to_message($message) . '" title="' . $message->getId() . '">' . $this->translator->trans('message') . '</a>';
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

    public function url_to_contest_photographers($contest) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'contests_photographers', array(
            'contest_slug' => Utils::slugify($contest->getName()),
        ));
    }

    public function url_to_contest_sponsors($contest) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'contests_sponsors', array(
            'contest_slug' => Utils::slugify($contest->getName()),
        ));
    }

    public function url_to_spot($spot, $location = NULL, $country = NULL) {
        $path_function = $this->getPathFunction();

        // Added Location and Country as an optional parameters
        // for reducing queries when necessary
        if ($location) {
            $l = $location;
        } else {
            $l = $spot->getLocation();
        }

        if ($country) {
            $c = $country;
        } else {
            $c = $l->getRegion()->getCountry();
        }

        return call_user_func($path_function, 'spot', array(
            'country' => Utils::slugify($c),
            'location' => Utils::slugify($l->getName()),
            'slug' => Utils::slugify($spot->getName())
        ));
    }

    public function url_to_location($location, $country = NULL) {
        $path_function = $this->getPathFunction();

        // Added Country as an optional parameter
        // for reducing queries when necessary
        if ($country) {
            $c = $country;
        } else {
            $c = $location->getRegion()->getCountry();
        }

        return call_user_func($path_function, 'location', array(
            'country' => Utils::slugify($c),
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

    public function url_to_module($module_name) {
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'criterias', array(
            'slug' => Utils::slugify($module_name)
        ));
    }

    public function url_to_message($message) {

        //$message = new \Skaphandrus\AppBundle\Entity\FosMessage();
        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'fos_message_thread_view', array(
            'threadId' => $message->getThread()->getId()
        ));
    }

    //como ainda não temos dashboard encaminha para a edição do perfil
    public function url_to_dashboard() {

        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'profile_admin_edit', array());
    }

    
    public function url_to_homepage() {

        $path_function = $this->getPathFunction();

        return call_user_func($path_function, 'index', array());
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
