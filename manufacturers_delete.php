<?php

include 'config/init.php';

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  require 'config/init.php';

  $manufacturersDb = new Manufacturer();
  $manufacturersDb->delete($_GET['id']);
}

header("Location: manufacturers.php");
