<?php

namespace Helpers;

class Debug
{
  public static function dump($var, $dump = false)
  {
    echo '<pre>';
    if ($dump) {
      var_dump($var);
    } else {
      print_r($var);
    }
    echo '</pre>';
  }

  public static function dumpDie($var, $dump = false)
  {
    Debug::dump($var, $dump);
    die();
  }
}
