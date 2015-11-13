<?php

namespace Skaphandrus\AppBundle\Utils;

class Utils {

    public static function slugify($string) {
        $slug = str_replace(array(' ', '/'), array('-', '_'), $string);
        return $slug ? $slug : "-";
    }

    public static function unslugify($string) {
        //return str_replace(array('-', '_', '   '), array(' ', '/', ' - '), $string);
        return str_replace(array('-', '_'), array(' ', '/'), $string);
    }

    public static function taxonomyStructure() {
        return array(
            'phylum' => array('parent' => 'kingdom', 'next' => 'class'),
            'class' => array('parent' => 'phylum', 'next' => 'order'),
            'order' => array('parent' => 'class', 'next' => 'family'),
            'family' => array('parent' => 'order', 'next' => 'genus'),
            'genus' => array('parent' => 'family', 'next' => 'species'),
        );
    }
    
    public static function isOwner($loggedUser, $owner) {
 
        if ($loggedUser === $owner){
            return true;
        } else {
            return false;
        }
        
    }
    
}
