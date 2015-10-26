<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SitemapController extends Controller {

    public function sitemapAction() {

        $em = $this->getDoctrine()->getManager();
        $teste = $em->getRepository('SkaphandrusAppBundle:SkCountry')->findAll();

        foreach ($teste as $test) {
//            $name = $test->getName();
            $id = $test->getId();
        }
        
        $myfile = fopen("newfile.xml", "w") or die("Unable to open file!");
        $txt = "
        <url>
            <loc>http://skaphandrus.com".skaphandrus::url_for_country($id)."</loc>  
            <lastmod>". date("Y-m-d") ."</lastmod>  
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
        ";

        if (fwrite($myfile, print_r($txt, TRUE))) {
            echo $myfile . " ok<br/>";
        } else {
            echo "<b>" . $myfile . "nok</b><br/>";
        }
    }

}
