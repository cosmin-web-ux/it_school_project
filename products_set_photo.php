<?php

include 'config/init.php';

use Helpers\Auth;
use Db\Product;

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

try {
  $productDb = new Product();
  $productDb->setPhoto($_GET['id'], $_GET['product_id']);
} catch (Exception $ex) {
  // log error
  // TODO add logging system
}

header("Location: products_edit.php?id=" . $_GET['product_id']);
