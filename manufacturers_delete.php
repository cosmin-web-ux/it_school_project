<?php

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  require 'config/init.php';
  $manufacturersDb = new Manufacturer();
  $manufacturersDb->delete($_GET['id']);
}

header("location: manufacturers.php");
