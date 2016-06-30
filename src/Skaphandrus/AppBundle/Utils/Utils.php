<?php

namespace Skaphandrus\AppBundle\Utils;

class Utils {

    public static function slugify($string) {
        $slug = str_replace(array(' ', '/'), array('-', '_'), $string);
        return $slug ? $slug : "-";
    }

    public static function unslugify($string) {
        //return str_replace(array('-', '_', '   '), array(' ', '/', ' - '), $string);
        return str_replace(array('-', '_', '+'), array(' ', '/', ' '), $string);
    }

    public static function taxonomyStructure() {
        return array(
            'phylum' => array('parent' => 'kingdom', 'next' => 'class', 'parent_plural' => 'kingdoms', 'next_plural' => 'classes'),
            'class' => array('parent' => 'phylum', 'next' => 'order', 'parent_plural' => 'phyla', 'next_plural' => 'orders'),
            'order' => array('parent' => 'class', 'next' => 'family', 'parent_plural' => 'classes', 'next_plural' => 'families'),
            'family' => array('parent' => 'order', 'next' => 'genus', 'parent_plural' => 'orders', 'next_plural' => 'genus'),
            'genus' => array('parent' => 'family', 'next' => 'species', 'parent_plural' => 'families', 'next_plural' => 'species'),
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
