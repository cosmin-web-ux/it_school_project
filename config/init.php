<?php

require_once 'config.php';

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
  $classFilePathDB = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "db" . DIRECTORY_SEPARATOR . $class . ".php";
  if (file_exists($classFilePathDB)) {
    require_once $classFilePathDB;
  }

  $classFilePathHelpers = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . $class . ".php";
  if (file_exists($classFilePathHelpers)) {
    require_once $classFilePathHelpers;
  }
}

spl_autoload_register('autoloader');
