<?php

include 'config/init.php';

use Helpers\Auth;
use Db\Category;

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  require 'config/init.php';
  $categoriesDb = new Category();
  $categoriesDb->delete($_GET['id']);
}

header("Location: categories.php");
