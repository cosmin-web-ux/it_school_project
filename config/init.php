<?php

require_once 'config.php';

session_start();

///////////////////////////////////////////////////////////////////
// setam afisarea/ascunderea erorilor in functie de mediul de lucru
///////////////////////////////////////////////////////////////////

if (ENVIRONMENT == "development") {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
} else {
  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
  error_reporting(E_ALL);
}

////////////////////
// setam timezone-ul
////////////////////
date_default_timezone_set(TIMEZONE);


//////////////////////////////////////////////////////////////////////////
// Inregistram functia care incarca automat fisiere cand facem 'new Class'
//////////////////////////////////////////////////////////////////////////
function autoloader($class)  // Student
{
  $classData = explode("\\", $class);

  $libDirectory = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR; // lib/
  $libDirectory .= strtolower($classData[0]) . DIRECTORY_SEPARATOR; // lib/db , lib/helpers
  $fileToInclude = $libDirectory . strtolower($classData[1]) . ".php"; // lib/db/category.php

  require_once $fileToInclude;
}

spl_autoload_register('autoloader');
