<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function autoloader($fileName) // Student, Car, Human
{

    $fileName = strtolower($fileName); // student, car, human
    echo $fileName;

    $fileToInclude = 'db' . DIRECTORY_SEPARATOR . $fileName . ".php";
    if (file_exists($fileToInclude)) {
        require_once $fileToInclude;
    }

    $fileToInclude = 'helpers' . DIRECTORY_SEPARATOR . $fileName . ".php";
    if (file_exists($fileToInclude)) {
        require_once $fileToInclude;
    }
}

spl_autoload_register('autoloader');
