<?php

include 'config/init.php';

use Helpers\Auth;
use Db\Manufacturer;

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  $manufacturersDb = new Manufacturer();
  $manufacturersDb->delete($_GET['id']);
}

header("Location: manufacturers.php");
