<?php

include 'config/init.php';

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  require 'config/init.php';

  $usersDb = new User();
  $usersDb->delete($_GET['id']);
}

header("Location: users.php");
