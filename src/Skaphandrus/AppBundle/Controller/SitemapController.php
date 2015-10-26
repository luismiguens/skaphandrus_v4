<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SitemapController extends Controller {

    public function sitemapAction($model) {

        $locale = $this->get('request')->getLocale();

        $str_begin = "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"  
        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"  
        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">";

        $str_end = "</urlset>";

        $str = "";
        $file = "";

        switch ($model) {
            case "SkCountry":
                $str = $this->generateCountries();
                $file = fopen("uploads/sitemaps/country_" . $locale . ".xml", "w") or die("Unable to open file!");

                break;

            case "SkLocation":
                //    $str = $this->generateCountries($em);
                //    $file = fopen("uploads/sitemaps/country_" . $locale . ".xml", "w") or die("Unable to open file!");

                break;

            default:
                break;
        }

        $str = $str_begin . $str . $str_end;

        if (fwrite($file, print_r($str, TRUE))) {
            return $this->render('SkaphandrusAppBundle:Sitemap:Sitemap.html.twig', array(
                        'str' => $str,
            ));
        } else {
            return "nok<br/>";
        }
    }

    public function generateCountries() {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('SkaphandrusAppBundle:SkCountry')->findAll();
        $str = "";

        foreach ($countries as $country) {
            $renderedTemplate = $this->get('twig')->render('SkaphandrusAppBundle:Sitemap:country.html.twig', array('country' => $country));
            $str = $str . $renderedTemplate;
        }

        return $str;
    }

}
