<?php

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  require 'config/init.php';
  $categoriesDb = new Category();
  $categoriesDb->delete($_GET['id']);
}

header("Location: categories.php");
