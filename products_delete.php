<?php

include 'config/init.php';

use Helpers\Auth;
use Db\Product;

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  require 'config/init.php';

  $productDB = new Product();
  $productDB->delete($_GET['id']);
}

header("Location: products.php");
