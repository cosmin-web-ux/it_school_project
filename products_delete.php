<?php

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  require 'config/init.php';

  $productDB = new Product();
  $productDB->delete($_GET['id']);
}

header("Location: products.php");
