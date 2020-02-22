<?php

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

  require 'config/init.php';
  $usersDb = new User();
  $usersDb->delete($_GET['id']);
}

header("Location: users.php");
