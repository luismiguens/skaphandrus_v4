<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SitemapController extends Controller {

    public function sitemapAction($model) {

        $locale = $this->get('request')->getLocale();

        $str = "";
        $file = "";

        switch ($model) {
            case "SkCountry":
                $str = $this->generateCountry();
                $file = fopen("uploads/sitemaps/country.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkLocation":
                $str = $this->generateLocation();
                $file = fopen("uploads/sitemaps/location.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkSpot":
                $str = $this->generateSpot();
                $file = fopen("uploads/sitemaps/spot.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkPhoto":
                $str = $this->generatePhoto();
                $file = fopen("uploads/sitemaps/photo.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "FosUser":
                $str = $this->generateFosUser();
                $file = fopen("uploads/sitemaps/fosUser.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkSpecies":
                $limit = 30000;
                for ($i = 0; $i <= 7; $i++) {
                    ini_set('memory_limit', 3000000000);
                    ini_set('max_execution_time', 300);
                    $offset = $i * $limit;
                    $str = $this->generateSpecies($limit, $offset);
                    $file = fopen("uploads/sitemaps/specie_" . $i . ".xml", "w") or die("Unable to open file!");

                    $this->writeFile($str, $file);
                }
                break;

            case "SkKingdom":
                $str = $this->generateKingdom();
                $file = fopen("uploads/sitemaps/kingdom.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkPhylum":
                $str = $this->generatePhylum();
                $file = fopen("uploads/sitemaps/phylum.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkClass":
                $str = $this->generateClass();
                $file = fopen("uploads/sitemaps/class.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkOrder":
                $str = $this->generateOrder();
                $file = fopen("uploads/sitemaps/order.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkFamily":
                $str = $this->generateFamily();
                $file = fopen("uploads/sitemaps/family.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;

            case "SkGenus":
                $str = $this->generateGenus();
                $file = fopen("uploads/sitemaps/genus.xml", "w") or die("Unable to open file!");
                $this->writeFile($str, $file);
                break;
            default:
                break;
        }


        return $this->render('SkaphandrusAppBundle:Sitemap:Sitemap.html.twig', array(
                    'str' => 'str',));
    }

    public function writeFile($str, $file) {
        $str_begin = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
  xmlns:xhtml=\"http://www.w3.org/1999/xhtml\">";

        $str_end = "</urlset>";

        $str = $str_begin . $str . $str_end;

        if (fwrite($file, print_r($str, TRUE))) {
            echo "ok";
        } else {
            echo "nok";
        }
    }

    public function generateCountry() {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('SkaphandrusAppBundle:SkCountry')->findAll();
        $str = "";

        foreach ($countries as $country) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:country.html.twig', array(
                'country' => $country
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generateLocation() {
        $em = $this->getDoctrine()->getManager();
        $locations = $em->getRepository('SkaphandrusAppBundle:SkLocation')->findAll();
        $str = "";

        foreach ($locations as $location) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:location.html.twig', array(
                'location' => $location
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generateSpot() {
        $em = $this->getDoctrine()->getManager();
        $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->findAll();
        //$spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->findBy(array(), array(), 10000, 0);
        $str = "";

        foreach ($spots as $spot) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:spot.html.twig', array(
                'spot' => $spot
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generatePhoto() {
        $em = $this->getDoctrine()->getManager();
        $photos = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->findAll();
        $str = "";

        foreach ($photos as $photo) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:photo.html.twig', array(
                'photo' => $photo
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generateFosUser() {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('SkaphandrusAppBundle:FosUser')->findAllUsersLite();
        $str = "";

        foreach ($users as $user) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:user.html.twig', array(
                'user' => $user
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generateSpecies($limit, $offset) {
        $em = $this->getDoctrine()->getManager();
        $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->findAllSpeciesLite($limit, $offset);
        $str = "";

        foreach ($species as $specie) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:species.html.twig', array(
                'specie' => $specie
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generateKingdom() {
        $em = $this->getDoctrine()->getManager();
        $taxons = $em->getRepository('SkaphandrusAppBundle:SkKingdom')->findAll();
        $str = "";

        foreach ($taxons as $taxon) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:taxon.html.twig', array(
                'taxon' => $taxon
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generatePhylum() {
        $em = $this->getDoctrine()->getManager();
        $taxons = $em->getRepository('SkaphandrusAppBundle:SkPhylum')->findAll();
        $str = "";

        foreach ($taxons as $taxon) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:taxon.html.twig', array(
                'taxon' => $taxon
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generateClass() {
        $em = $this->getDoctrine()->getManager();
        $taxons = $em->getRepository('SkaphandrusAppBundle:SkClass')->findAll();
        $str = "";

        foreach ($taxons as $taxon) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:taxon.html.twig', array(
                'taxon' => $taxon
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generateOrder() {
        $em = $this->getDoctrine()->getManager();
        $taxons = $em->getRepository('SkaphandrusAppBundle:SkOrder')->findAll();
        $str = "";

        foreach ($taxons as $taxon) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:taxon.html.twig', array(
                'taxon' => $taxon
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

    public function generateFamily() {
        $em = $this->getDoctrine()->getManager();
        $taxons = $em->getRepository('SkaphandrusAppBundle:SkFamily')->findAll();
        $str = "";

        foreach ($taxons as $taxon) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:taxon.html.twig', array(
                'taxon' => $taxon
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }
    
    public function generateGenus() {
        $em = $this->getDoctrine()->getManager();
        $taxons = $em->getRepository('SkaphandrusAppBundle:SkGenus')->findAll();
        $str = "";

        foreach ($taxons as $taxon) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:taxon.html.twig', array(
                'taxon' => $taxon
            ));
            $str = $str . $renderedTemplate;
        }
        return $str;
    }

}
