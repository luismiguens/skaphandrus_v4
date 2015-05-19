<?php

namespace Skaphandrus\AppBundle\Utils;

class Utils {
  public static function slugify($string) {
    return str_replace(' ', '-', $string);
  }

  public static function unslugify($string) {
    return str_replace('-', ' ', $string);
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
}
